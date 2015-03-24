<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 3/24/15
 * Time: 11:28 AM
 */

class DegreeTableSeeder extends Seeder{

    public function run()
    {
        DB::table('degrees')->insert(array(

            array("title" => "Distinction", "lower" => 3.50, "upper" => 4.00),
            array("title" => "Upper Credit", "lower" => 3.00, "upper" => 3.49),
            array("title" => "Lower Credit", "lower" => 2.50, "upper" => 2.99),
            array("title" => "Pass", "lower" => 2.00, "upper" => 2.49),
            array("title" => "Fail", "lower" => 0.00, "upper" => 1.99)


        ));
    }

} 