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
            foreach ($levels as $level)
            {

                $students = StudentState::where("state_id", "=", $state->id)->where("level_id", "=", $level->id)->get();
                foreach ($students as $std) {
                    $tcl = 0;
                    $student = Student::find($std->student_id);
                    if (!$student->status) //skip suspended students
                        continue;
                    $prv_state = State::where("session", "=", ($state->session - 1))->where("semester", "=", $new_state->semester)->first();

                    if (is_object($prv_state)) {
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

                    if($std->is_extra_year)
                    {
                        $ref_count = 0;
                        $s1 = State::where("session", "=", ($state->session - 1))->where("semester", "=", 2)->first();
                        $s2 = State::where("session", "=", ($state->session))->where("semester", "=", 1)->first();
                        if(is_object($s1))
                        {
                            $ref_count += Result::where("student_id", "=", $student->id)->where("state_id", "=", $s1->id)->where("total", "<", 40)->count();
                        }
                        if(is_object($s2))
                        {
                            $ref_count += Result::where("student_id", "=", $student->id)->where("state_id", "=", $s2->id)->where("total", "<", 40)->count();
                        }

                        if(!$ref_count)
                        {
                            //Save student as graduate
                            $gpa = Gpa::where("student_id", "=", $student->id)->where("state_id", "=", $state->id)->first();
                            $grad = new Graduate();
                            $grad->degree_class = GradeHelper::getDegreeClass($gpa->cgpa);
                            $grad->degree_type = intval($level->id/ 2); // 1 for OND, 2 for HND
                            $grad->state_id = $state->id;
                            $grad->student_id = $student->id;
                            $grad->save();
                            continue; //move to next student;
                        }
                        else
                        {
                            //add gpa for next semester for student
                        }


                       // Result::where("student_id", "=", $student->id)->where("state_id", "=", $prv_state->id)->where("total", "<", "40.0"
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
                    $new_gpa->cgpa = intval($new_gpa->cgp)/ intval($new_gpa->ctcl);
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

            $has_carry = 0;
            $has_extra_year = 0;
            foreach ($levels as $level)
            {

                $students = StudentState::where("state_id", "=", $state->id)->where("level_id", "=", $level->id)->get();
                foreach ($students as $std)
                {
                    $tcl = 0;
                    $student = Student::find($std->student_id);
                    if (!$student->status) //skip suspended students
                        continue;
                    $prv_state = State::where("session", "=", ($state->session))->where("semester", "=", $new_state->semester)->first();
                    if (is_object($prv_state)) {
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
                        $has_carry = count($carryovers);
                    }

                    if(($level->id % 2)  == 0)
                    {
                        //get failed courses for the current semester
                        $failed = Result::where("student_id", "=", $student->id)->where("state_id", "=", $state->id)->where("total", "<", "40.0")->get();

                        if(!$has_carry && !count($failed))
                        {

                            $failed = Result::where("student_id", "=", $student->id)->where("state_id", "=", $prv_state->id)->where("total", "<", "40.0")->get();

                            //Save student as graduate
                            $gpa = Gpa::where("student_id", "=", $student->id)->where("state_id", "=", $state->id)->first();
                            $grad = new Graduate();
                            $grad->degree_class = GradeHelper::getDegreeClass($gpa->cgpa);
                            $grad->degree_type = intval($level->id/ 2); // 1 for OND, 2 for HND
                            $grad->state_id = $state->id;
                            $grad->student_id = $student->id;
                            $grad->save();
                            continue; //move to next student;
                        }
                        else
                        {
                            $has_extra_year = 1; //student has extra year
                        }
                    }

                    //PLEASE REVISIT THIS LINE AND FIX...
                    if (!$std->is_extra_year && !$has_extra_year) //Register default courses  for non-extra year students.
                    {
                        $courses = Course::where("semester", "=", $new_state->semester)->where("status", "=", 1)
                            ->where("level_id", "=", ($level->id + 1))->get();
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
                    $new_gpa->level_id = ($level->id+ 1);
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
                    $new_gpa->cgpa = intval($new_gpa->cgp)/ intval($new_gpa->ctcl);

                    $new_gpa->save();


                    $stdstate = new StudentState();

                    if(($level->id % 2)  > 0)
                        $stdstate->level_id = ($level->id + 1);
                    else
                        $stdstate->level_id = $level->id ;

                    $stdstate->student_id = $student->id;
                    $stdstate->state_id = $new_state->id;
                    $stdstate->is_extra_year = $has_extra_year; //NOT SURE ABOUT THIS!!!??!!!
                    $stdstate->save();
                }

            }
        }

        return Redirect::to("/");
    }


    public function getStates()
    {
        return Response::json(State::orderBy("id","desc")->get());
    }

    public function getDashboardData()
    {
        $state = State::getCurrentState();
        $data = array();
        $levels = Level::all();
        foreach($levels as $level)
        {
            $level_data = new stdClass();
            $level_data->info = $level;
            $level_data->all = StudentState::where("state_id", "=", $state->id)->where("level_id", "=", $level->id);



            $chart_data_cgpa = array();

            $level_data->top5_cgpa = Gpa::where("state_id","=", $state->id)->where("level_id", "=", $level->id)->orderBy("cgpa", "desc")->limit(5)->get();
            $level_data->top5_gpa = Gpa::where("state_id", $state->id)->orderBy("gpa", "desc")->limit(5)->get();

            //Distinction
            $chart_data_cgpa[] = array("Distinction", Gpa::where("state_id","=", $state->id)->where("level_id", "=", $level->id)->where("cgpa", ">", "3.49")->where("cgpa", "<", "4.01")->count());

           //Upper Credit
            $chart_data_cgpa[] = array("Upper Credit", Gpa::where("state_id","=", $state->id)->where("level_id", "=", $level->id)->where("cgpa", ">", "2.99")->where("cgpa", "<", "3.50")->count());

            //Lower Credit
            $chart_data_cgpa[] = array("Lower Credit", Gpa::where("state_id","=", $state->id)->where("level_id", "=", $level->id)->where("cgpa", ">", "2.49")->where("cgpa", "<", "3.00")->count());

            //Pass
            $chart_data_cgpa[] = array("Pass", Gpa::where("state_id","=", $state->id)->where("level_id", "=", $level->id)->where("cgpa", ">", "1.99")->where("cgpa", "<", "2.50")->count());

            //Fail
            $chart_data_cgpa[] = array("Fail", Gpa::where("state_id","=", $state->id)->where("level_id", "=", $level->id)->where("cgpa", "<", "2.00")->count());

            $level_data->chart_cgpa = $chart_data_cgpa;


            $data[] = $level_data;

        }
        return Response::json($data);
    }


    public function uploadResultCSV()
    {
        $op = Input::file("data")->openFile();
        // if(!$op->eof() )
        //  $op->fgetcsv();
        $details = array('errors'=>array() );
        $state = State::getCurrentState();

        $courses = array();
        $c_indexes = array();
        $h_switch =  0; //"header processed" flag
        $offset = 3; //course code columns offset

        while(!$op->eof())
        {

            $row = $op->fgetcsv();


            if(count($row) < ($offset + 1))  //invalid result csv file
            {
                $details['errors'][] = "[ERROR:] Line " . ($op->key() + 1) . " could not be parsed. ---- INVALID CSV" ;
                break;
            }

            if(!$h_switch) //if the table headers haven't been parsed
            {
                $temp_courses = array_slice($row, $offset);
                foreach($temp_courses as $i => $t)
                {
                    $c = Course::where("code", "=", trim($t))->where("status", "=", 1)->first();
                    if(!is_object($c))
                    {
                        $details['errors'][] = "[ERROR:] Course code '". $t."' not found."  ;
                        continue;
                    }

                    $courses[$c->code] = $c ;
                    $c_indexes[$c->code] = $i;
                }
                $h_switch = 1; //done parsing headers
            }
            else
            {
                if(strlen(trim($row[2])) < 1) // Skip empty rows.
                    continue;


                $student = Student::where("matric_no", "=", trim($row[2]))->first();
                if(!is_object($student)) //student didn't register the course
                {
                    $details['errors'][] = "[ERROR:] Matric No. '". $row[2]."' doesn't exist "  ;
                    continue;
                }
                foreach($courses as $course)
                {



                    $score = trim($row[$offset + $c_indexes[$course->code]]);
                    //$details[]= $score; //REMOVE!!!!

                    if(strlen($score) > 0 && is_numeric($score)) // score exists on the sheet
                    {
                        $result = Result::where('student_id', '=', $student->id)
                            ->where('course_id', '=', $course->id)
                            ->where('state_id', '=', State::getCurrentState()->id)->first();

                        if(!is_object($result))  // not registered exist
                        {
                            $details['errors'][] = "[ERROR:] Student " . trim($row[2]). " did not register ". $course->code . "." ;
                            continue;
                        }

                        $gpa = Gpa::where("student_id", "=", $student->id)->where("state_id","=",$state->id)->first();

                        $rpoint = CourseController::getGradePoint($result->total, $result->course_id);
                        $ppoint = CourseController::getGradePoint($score, $result->course_id);
                        $gpa->gp = ($gpa->gp - $rpoint) + $ppoint;
                        $gpa->cgp = ($gpa->cgp - $rpoint) + $ppoint;
                        $gpa->gpa =  ($gpa->gp / $gpa->tcl);
                        $gpa->cgpa = ($gpa->cgp / $gpa->ctcl);
                        $gpa->save();

                        $result->total = $score;
                        $result->save();
                    }

                }


            }









        }

        //TODO Return the updated version of the result data

        return  Response::json($details);


    }
} 