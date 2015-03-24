<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 2/2/15
 * Time: 2:23 PM
 */


class CourseController extends BaseController{

    public function getScores($id, $state_id)
    {
        $res = Result::where("state_id", "=", $state_id)->where("course_id", "=", $id)->select();
        $results = $res->with("student")->get();
        foreach($results as $r)
        {
           $r->setAppends(array('studentstate'));
        }


        return Response::json($results);
    }

    public function getAllCourses()
    {
        return Response::json(Course::all());
    }

    public function getCourses($level_id, $semester)
    {
       if($semester == 0)
           return Response::json(Course::where("level_id", "=", $level_id)->get());
       else
           return Response::json(Course::where("level_id", "=", $level_id)->where("semester", "=", $semester)->get());


    }

    public function saveCourse($course_id)
    {
        $payload = json_decode(Input::get("data"));
        $c_state = State::getCurrentState();
        $course = Course::find($course_id);
        $course->title = $payload->title;
        $course->units = $payload->units;
        $course->code = $payload->code;
        $course->level_id = $payload->level_id;
        $course->semester  = $payload->semester;
        $course->status  = $payload->status;
        if($course->save())
        {
            return Response::json(array("success" => true));
        }
        return Response::json(array("success" => false));

    }


    public function addCourse()
    {
        $payload = json_decode(Input::get("data"));
        $c_state = State::getCurrentState();
        $course = new Course();
        $course->title = $payload->title;
        $course->units = $payload->units;
        $course->code = $payload->code;
        $course->level_id = $payload->level_id;
        $course->semester  = $payload->semester;
        $course->status  = $payload->status;
        $course->state_id = $c_state->id;
        if($course->save())
        {
            return Response::json(array("success" => true, "course" => $course));
        }
        return Response::json(array("success" => false));

    }

    public function deleteCourse($id)
    {
        $c = Course::find($id);
        $state = State::getCurrentState();
        if(intval($c->state_id) == intval($state->id))
        {
            Result::where("state_id", "=", $c->state_id)->where("course_id", "=", $c->id)->delete();
            $c->delete();
            return Response::json(array("success" => true));
        }
        else
        {
            $res = Result::where("state_id", "<>", $c->state_id)->where("course_id", "=", $c->id);
            if($res->count() == 0)
            {
                $res->delete();
                return Response::json(array("success" => true));
            }
        }
        return Response::json(array("success" => false));

    }




    public function saveScores($course_id)
    {
        $payload = json_decode(Input::get("data"));
        print_r(json_last_error_msg());
        $c_state = State::getCurrentState();
        foreach($payload as $p)
        {

           $res = Result::where("id", "=", $p->id)->where("state_id", "=", $c_state->id)->first();
           if($res->exists())
           {
               $gpa = Gpa::where("student_id", "=", $p->student_id)->where("state_id","=",$c_state->id)->first();

               $rpoint = GradeHelper::getGradePoint($res->total, $res->course_id);
               $ppoint = GradeHelper::getGradePoint($p->total, $res->course_id);
               $gpa->gp = ($gpa->gp - $rpoint) + $ppoint;
               $gpa->cgp = ($gpa->cgp - $rpoint) + $ppoint;
               $gpa->gpa =  ($gpa->gp / $gpa->tcl);
               $gpa->cgpa = ($gpa->cgp / $gpa->ctcl);
               $gpa->save();

               $res->total = $p->total;
               $res->save();
           }
        }

    }

    public function getActiveCoursesWithStateID($level_id, $semester, $state_id)
    {

        //TODO filter courses available during a particular state_id

        if($semester == 0)
            return Response::json(Course::where("level_id", "=", $level_id)->where("status", "=", 1)->get());
        else
            return Response::json(Course::where("level_id", "=", $level_id)->where("semester", "=", $semester)->where("status", "=", 1)->get());


    }


    public function saveScoresFromCSV($id)
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

            $rpoint = GradeHelper::getGradePoint($result->total, $result->course_id);
            $ppoint = GradeHelper::getGradePoint($scores[4], $result->course_id);
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

    public static  function getGradePoint($score, $course_id)
    {

        $course = Course::find($course_id);
        if ($score < 20)
            return 0;
        if ($score < 25)
            return $course->units;
        if ($score < 30)
            return ($course->units * 1.25);
        if ($score < 35)
            return ($course->units * 1.5);
        if ($score < 40)
            return ($course->units * 1.75);
        if ($score < 45)
            return ($course->units * 2);
        if ($score < 50)
            return ($course->units * 2.25);
        if ($score < 55)
            return ($course->units * 2.5);

        if ($score < 60)
            return ($course->units * 2.75);
        if ($score < 65)
            return ($course->units * 3);
        if ($score < 70)
            return ($course->units * 3.25);
        if ($score < 75)
            return ($course->units * 3.5);
        if ($score <= 100)
            return ($course->units * 4);

        return 0;
    }

    function rebuildScores()
    {


        $levels = Level::all();
        $state = State::getCurrentState();

        Result::where("state_id", "=", $state->id)->delete(); //delete all results for this session;

        foreach ($levels as $level) {

            $students = StudentState::where("state_id", "=", $state->id)->where("level_id", "=", $level->id)->get();
            foreach ($students as $std) {
                $tcl = 0;
                $student = Student::find($std->student_id);
                if (!$student->status) //skip suspended students
                    continue;
                $prv_state = State::where("session", "=", ($state->session - 1))->where("semester", "=", $state->semester);
                if ($prv_state->exists()) {
                    $carryovers = Result::where("student_id", "=", $student->id)->where("state_id", "=", $prv_state->id)->where("total", "<", "40.0")->get();
                    foreach ($carryovers as $carry) {
                        $res = new Result();
                        $c = Course::find($carry->course_id);
                        $res->course_id = $carry->course_id;
                        $res->student_id = $carry->student_id;
                        $res->state_id = $state->id;
                        $res->ca = 0.0;
                        $res->exam = 0.0;
                        $res->total = 0.0;
                        $res->in_use = 1;
                        $res->save();
                        $tcl += $c->units;
                    }
                }

                if (!$std->is_extra_year) //Register default courses  for non-extra year students
                {
                    $courses = Course::where("semester", "=", $state->semester)->where("status", "=", 1)->where("level_id", "=", $level->id)->get();
                    foreach ($courses as $c) {
                        $res = new Result();
                        $res->course_id = $c->id;
                        $res->student_id = $student->id;
                        $res->state_id = $state->id;
                        $res->ca = 0.0;
                        $res->exam = 0.0;
                        $res->total = 0.0;
                        $res->in_use = 1;
                        $res->save();
                        $tcl += $c->units;

                    }

                }

                $new_gpa = Gpa::where("student_id", "=", $student->id)->where("state_id", "=", $state->id)->first();
                $new_gpa->tcl = $tcl;
                $new_gpa->ctcl = intval($new_gpa->ctcl) + intval($tcl);
                $new_gpa->save();

            }

        }

    }
}
