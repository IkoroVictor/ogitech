<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 2/5/15
 * Time: 5:35 PM
 */

class GpaTableSeeder extends Seeder{

    public function run()
    {
        DB::table('gpas')->insert(array(
                array("student_id" => "1", "state_id" => "1","level_id" => "1", "gp" => "8.00",
                      "gpa" => "2.00", "cgp" => "8.00","cgpa" => "2.00","tcl" => "4.00",
                      "ctcl" => "4.00", "prev_gp" => "0.00", "prev_gpa" => "0.00","prev_cgp" => "0.00",
                      "prev_cgpa" => "0.00", "prev_tcl" => "0.00", "prev_ctcl" => "0.00"),
                array("student_id" => "2", "state_id" => "1","level_id" => "1", "gp" => "8.00",
                                      "gpa" => "2.00", "cgp" => "8.00","cgpa" => "2.00","tcl" => "4.00",
                                      "ctcl" => "4.00", "prev_gp" => "0.00", "prev_gpa" => "0.00","prev_cgp" => "0.00",
                                      "prev_cgpa" => "0.00", "prev_tcl" => "0.00", "prev_ctcl" => "0.00")

            )

        );
    }
} 