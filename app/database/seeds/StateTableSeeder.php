<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 2/2/15
 * Time: 1:06 PM
 */

class StateTableSeeder extends  Seeder{

    public function run()
    {
        DB::table('states')->insert(array(
            array("session" => "2014", "semester" => "1", "settings" => "{}", "active" => '1' )
        ));

    }
}