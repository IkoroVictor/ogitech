<?php

/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 1/26/15
 * Time: 2:39 PM
 */
class SystemController extends BaseController
{

    public function closeSemester()
    {
        $levels = Level::all();
        $state = State::getCurrentState();
        $new_state = State::toNextSemester();

        if ($state->semester == 1) //for first semester
        {
            foreach ($levels as $level) {

                $students = StudentState::where("state_id", "=", $state->id)->where("level_id", "=", $level->id)->get();
                foreach ($students as $std) {
                    $tcl = 0;
                    $student = Student::find($std->student_id);
                    if (!$student->status) //skip suspended students
                        continue;
                    $prv_state = State::where("session", "=", ($state->session - 1))->where("semester", "=", $new_state->semester);
                    if ($prv_state->exists()) {
                        $carryovers = Result::where("student_id", "=", $student->id)->where("state_id", "=", $prv_state->id)->where("total", "<", "40.0")->get();
                        foreach ($carryovers as $carry) {
                            $res = new Result();
                            $c = Course::find($carry->course_id);
                            $res->course_id = $carry->course_id;
                            $res->student_id = $carry->student_id;
                            $res->state_id = $new_state->id;
                            $res->ca = 0.0;
                            $res->exam = 0.0;
                            $res->total = 0.0;
                            $res->in_use = $carry->in_use;
                            $res->save();
                            $tcl += $c->units;
                        }
                    }

                    if (!$std->is_extra_year) //Register default courses  for non-extra year students
                    {
                        $courses = Course::where("semester", "=", $new_state->semester)->where("status", "=", 1)->where("level_id", "=", $level->id)->get();
                        foreach ($courses as $c) {
                            $res = new Result();
                            $res->course_id = $c->id;
                            $res->student_id = $student->id;
                            $res->state_id = $new_state->id;
                            $res->ca = 0.0;
                            $res->exam = 0.0;
                            $res->total = 0.0;
                            $res->in_use = 1;
                            $res->save();
                            $tcl += $c->units;

                        }

                    }

                    $gpa = Gpa::where("student_id", "=", $student->id)->where("state_id", "=", $state->id)->first();
                    $new_gpa = new Gpa();
                    $new_gpa->level_id = $level->id;
                    $new_gpa->student_id = $student->id;
                    $new_gpa->state_id = $new_state->id;
                    $new_gpa->tcl = $tcl;
                    $new_gpa->prev_tcl = $gpa->tcl;
                    $new_gpa->prev_ctcl = $gpa->ctcl;
                    $new_gpa->prev_cgp = $gpa->cgp;
                    $new_gpa->cgp = $gpa->cgp;
                    $new_gpa->prev_cgpa = $gpa->cgpa;
                    $new_gpa->prev_gp = $gpa->gp;
                    $new_gpa->prev_gpa = $gpa->gpa;

                    $new_gpa->ctcl = intval($gpa->ctcl) + intval($tcl);
                    $new_gpa->save();


                    $stdstate = new StudentState();

                    $stdstate->level_id = $level->id;
                    $stdstate->student_id = $student->id;
                    $stdstate->state_id = $new_state->id;
                    $stdstate->is_extra_year = StudentState::where("student_id", "=", $student->id)->where("state_id", "=", $state->id)->first()->is_extra_year;
                    $stdstate->save();
                }

            }


        }
        else{

        }

        return Redirect::to("/");
    }


    public function getStates()
    {
        return Response::json(State::orderBy("id","desc")->get());
    }


    public function uploadResultCSV()
    {
        $op = Input::file("data")->openFile();
        // if(!$op->eof() )
        //  $op->fgetcsv();
        $details = array('errors'=>array() );
        $state = State::getCurrentState();

        while(!$op->eof())
        {

            $scores = $op->fgetcsv();


            if(((count($scores) % 6) > 0) || (floor((count($scores) / 6)) < 1) )
            {
                $details['errors'][] = "[ERROR:] Line " . ($op->key() + 1) . " could not be parsed." ;
                continue;
            }

            if(!is_numeric($scores[0]) || !is_numeric($scores[4])) continue; //Skip the table headers


            $student = Student::where('matric_no', '=', trim($scores[2]))->first();
            if(!is_object($student))  //doesn't exist
            {
                $details['errors'][] = "[ERROR:] Student " . trim($scores[2]). " doesn't exist";
                continue;
            }

            $result = Result::where('student_id', '=', $student->id)
                ->where('course_id', '=', $id)
                ->where('state_id', '=', State::getCurrentState()->id)->first();

            if(!is_object($result))  // not registered exist
            {
                $details['errors'][] = "[ERROR:] Student " . trim($scores[2]). " did not register this course.";
                continue;
            }



            $gpa = Gpa::where("student_id", "=", $student->id)->where("state_id","=",$state->id)->first();

            $rpoint = $this->getGradePoint($result->total, $result->course_id);
            $ppoint = $this->getGradePoint($scores[4], $result->course_id);
            $gpa->gp = ($gpa->gp - $rpoint) + $ppoint;
            $gpa->cgp = ($gpa->cgp - $rpoint) + $ppoint;
            $gpa->gpa =  ($gpa->gp / $gpa->tcl);
            $gpa->cgpa = ($gpa->cgp / $gpa->ctcl);
            $gpa->save();

            $result->total = $scores[4];
            $result->save();
        }

        //Return the updated version of the scores data

        $res = Result::where("state_id", "=", State::getCurrentState()->id)->where("course_id", "=", $id)->select();
        $results = $res->with("student")->get();
        foreach($results as $r)
        {
            $r->setAppends(array('studentstate'));
        }
        $details['scores'] =  $results;




        return  Response::json($details);


    }
} 