<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 1/26/15
 * Time: 12:54 PM
 */

class StudentState extends Eloquent{

    protected  $table = "studentstates";

    public function student()
    {
        return $this->belongsTo("Student", "student_id", "id");
    }

} 