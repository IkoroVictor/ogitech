<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 2/2/15
 * Time: 2:32 PM
 */

class CourseTableSeeder extends Seeder{

    public function run()
    {
        DB::table('courses')->insert(array(
            array("code" => "COM111", "units" => "3", "semester" => "1", "title" => "Introduction to Computer Science", "level_id" => "1", "status" => "1"),
            array("code" => "COM112", "units" => "1", "semester" => "1", "title" => "Introduction to Computer Science II", "level_id" => "1", "status" => "1"),

        ));

    }
} 