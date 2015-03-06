<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 2/2/15
 * Time: 12:34 PM
 */

class UserTableSeeder extends Seeder{

    public  function run()
    {

            DB::table('users')->insert(array(
                    array("firstname" => "Perfect", "lastname" => "Kanu", "othername" => "Junior", "sex" => "M","username" => "perfectkanu", "password" => Hash::make("password"), "email" => "perfectkanu@gmail.com"),
                    array("firstname" => "George", "lastname" => "Ikoro", "othername" => "Mosul", "sex" => "M","username" => "georgeikoro", "password" => Hash::make("password"), "email" => "g.ikoro@gmail.com"),
                    array("firstname" => "Jane", "lastname" => "Okenyi", "othername" => "Ijeoma", "sex" => "F", "username" => "janeokenyi", "password" => Hash::make("password"), "email" => "j.okenyi@gmail.com"),
                    array("firstname" => "Victor", "lastname" => "Ikoro", "othername" => "Ahan", "sex" => "M", "username" => "victorikoro", "password" => Hash::make("password"), "email" => "v.ikoro@gmail.com"),

        ));
    }
} 