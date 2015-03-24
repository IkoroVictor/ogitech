<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 3/24/15
 * Time: 9:17 AM
 */




class GradeHelper {

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

    public static  function getDegreeClass($gpa)
    {

        if ($gpa < 2.00)
            return 5; //"Fail";

        if ($gpa < 2.50)
            return 4; //"Pass";

        if ($gpa < 3.00)
            return 3; //"Lower Credit";

        if ($gpa < 3.50)
            return 2; //"Upper Credit";

        return 1; //"Distinction";
    }
} 