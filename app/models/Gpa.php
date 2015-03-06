<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 1/26/15
 * Time: 12:53 PM
 */

class Gpa extends Eloquent{


    protected  $with =  array("student");

    public function student()
    {
        return $this->belongsTo("Student", "student_id", "id");
    }


    public function getResultsAttribute()
    {
        $res = Result::where("student_id", "=", $this->student_id)->where("state_id", "=", $this->state_id)->where("in_use", "=", 1)->get();

        //$res_with_course = array();
       // foreach($res as $r)
        //{
           // $res_with_course[] = $r->with('course')->get();
       // }
        //return $res_with_course;

        return $res;
    }



}