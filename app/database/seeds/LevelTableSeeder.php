<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 2/2/15
 * Time: 12:56 PM
 */

class LevelTableSeeder extends Seeder{

    public function run()
    {
        DB::table('levels')->insert(array(
                array("title" => "ND I", "description" => "National Diploma I"),
                array("title" => "ND II", "description" => "National Diploma II"),

                array("title" => "HND I", "description" => "Higher National Diploma I"),
                array("title" => "HND II", "description" => "Higher National Diploma II"),

            )

        );
    }

} 