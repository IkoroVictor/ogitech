<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 2/2/15
 * Time: 1:14 PM
 */

class StudentTableSeeder extends Seeder{

    public function run()
    {
         DB::table('students')->insert(array(
            array("user_id" => "1", "matric_no" => "OG/1234546" ),
            array("user_id" => "2", "matric_no" => "OG/1234888" )
        ));


    }

} 