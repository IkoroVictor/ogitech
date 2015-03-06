<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 2/2/15
 * Time: 1:04 PM
 */

class StudentStateTableSeeder extends Seeder{

    public function run()
    {
        DB::table('studentstates')->insert(array(
            array("student_id" => "1", "state_id" => "1", "level_id" => "1"),
            array("student_id" => "2", "state_id" => "1", "level_id" => "1")
        ));

    }
} 