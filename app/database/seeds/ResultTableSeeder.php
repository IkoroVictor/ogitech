<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 2/2/15
 * Time: 2:31 PM
 */

class ResultTableSeeder extends Seeder{

    public function run()
    {
        DB::table('results')->insert(array(
            array("course_id" => "1", "student_id" => "1", "state_id" => "1", "in_use" => "1", "ca" => "20", "exam" => "30", "total" => "43"),
            array("course_id" => "2", "student_id" => "1", "state_id" => "1", "in_use" => "1", "ca" => "13", "exam" => "46", "total" => "43"),
            array("course_id" => "1", "student_id" => "2", "state_id" => "1", "in_use" => "1", "ca" => "20", "exam" => "30", "total" => "43"),
            array("course_id" => "2", "student_id" => "2", "state_id" => "1", "in_use" => "1", "ca" => "13", "exam" => "46", "total" => "43"),

        ));

    }
} 