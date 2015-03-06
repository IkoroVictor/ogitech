<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 1/26/15
 * Time: 2:28 PM
 */

class StudentController extends BaseController{


    public function saveStudent($student_id)
    {
        $payload = json_decode(Input::get("data"));
        $student = Student::find($student_id);
        $user =    User::find($student->user_id);

        $user->firstname =  $payload->user->firstname;
        $user->lastname =  $payload->user->lastname;
        $user->othername =  $payload->user->othername;
        $user->save();

        $student->matric_no =  $payload->matric_no;
        $student->save();
        return Response::json(array("success" => true));

    }

    public function addStudent($student_id)
    {
        $payload = json_decode(Input::get("data"));
        $student = Student::find($student_id);
        $user =    User::find($student->user_id);

        $user->firstname =  $payload->user->firstname;
        $user->lastname =  $payload->user->lastname;
        $user->othername =  $payload->user->othername;
        $user->save();

        $student->matric_no =  $payload->matric_no;
        $student->save();
        return Response::json(array("success" => true));

    }

} 