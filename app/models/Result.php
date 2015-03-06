<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 1/26/15
 * Time: 12:51 PM
 */

class Result extends Eloquent{


    protected $with = array('course');

    public function student()
    {
        return $this->belongsTo("Student", "student_id", "id");
    }

    public function course()
    {
        return $this->hasOne("Course", "id", "course_id");
    }

    public function getStudentStateAttribute()
    {
        return StudentState::where("student_id", "=", $this->student_id)->where("state_id", "=", $this->state_id)->first();
    }

    public function setWith(array $arr)
    {
        $this->with = $arr;
    }


} 