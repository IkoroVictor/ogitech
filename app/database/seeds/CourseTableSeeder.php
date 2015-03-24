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

            //FIRST SEMESTER ND I
            array("code" => "COM111", "units" => "3", "semester" => "1", "title" => "INTRODUCTION TO COMPUTING", "level_id" => "1", "status" => "1", "state_id" => '1'),
            array("code" => "COM112", "units" => "3", "semester" => "1", "title" => "INTRODUCTION TO DIGITAL ELECTRONICS", "level_id" => "1", "status" => "1", "state_id" => '1'),
            array("code" => "COM113", "units" => "3", "semester" => "1", "title" => "INTRODUCTION TO PROGRAMMING", "level_id" => "1", "status" => "1", "state_id" => '1'),
            array("code" => "STA111", "units" => "2", "semester" => "1", "title" => "DESCRIPTIVE STATISTICS I", "level_id" => "1", "status" => "1", "state_id" => '1'),
            array("code" => "STA112", "units" => "2", "semester" => "1", "title" => "ELEMENTARY PROBABILITY THEORY", "level_id" => "1", "status" => "1", "state_id" => '1'),
            array("code" => "MTH111", "units" => "2", "semester" => "1", "title" => "LOGIC AND LINEAR ALGEBRA", "level_id" => "1", "status" => "1", "state_id" => '1'),
            array("code" => "MTH112", "units" => "2", "semester" => "1", "title" => "TRI. AND ANALYTICAL GEOMETRY", "level_id" => "1", "status" => "1", "state_id" => '1'),
            array("code" => "OTM112", "units" => "2", "semester" => "1", "title" => "TECHNICAL ENGLISH I", "level_id" => "1", "status" => "1", "state_id" => '1'),
            array("code" => "GNS117", "units" => "1", "semester" => "1", "title" => "USE OF LIBRARY", "level_id" => "1", "status" => "1", "state_id" => '1'),
            array("code" => "GNS111", "units" => "2", "semester" => "1", "title" => "CITIZENSHIP EDUCATION I", "level_id" => "1", "status" => "1", "state_id" => '1'),



            //SECOND SEMESTER ND I
            array("code" => "COM121", "units" => "3", "semester" => "2", "title" => "SCIENTIFIC PROG. LANG. Using OO JAVA ", "level_id" => "1", "status" => "1", "state_id" => '1'),
            array("code" => "COM122", "units" => "3", "semester" => "2", "title" => "INTRODUCTION TO INTERNET", "level_id" => "1", "status" => "1", "state_id" => '1'),
            array("code" => "COM123", "units" => "3", "semester" => "2", "title" => "COMP. APPLICATION PACKAGE I", "level_id" => "1", "status" => "1", "state_id" => '1'),
            array("code" => "COM124", "units" => "3", "semester" => "2", "title" => "DATA STRUCTURE & ALGORITHMS", "level_id" => "1", "status" => "1", "state_id" => '1'),
            array("code" => "COM125", "units" => "3", "semester" => "2", "title" => "INTRODUCTION TO SYSTEMS ANALYSIS", "level_id" => "1", "status" => "1", "state_id" => '1'),
            array("code" => "COM126", "units" => "2", "semester" => "2", "title" => "PC UPGRADE & MAINTENANCE", "level_id" => "1", "status" => "1", "state_id" => '1'),
            array("code" => "MTH124", "units" => "2", "semester" => "2", "title" => "CALCULUS", "level_id" => "1", "status" => "1", "state_id" => '1'),
            array("code" => "GNS121", "units" => "2", "semester" => "2", "title" => "CITIZENSHIP EDUCATION II", "level_id" => "1", "status" => "1", "state_id" => '1'),
            array("code" => "EED126", "units" => "2", "semester" => "2", "title" => "Entrepreneurship Development", "level_id" => "1", "status" => "1", "state_id" => '1'),
            array("code" => "GNS201", "units" => "2", "semester" => "2", "title" => "TECHNICAL ENGLISH II", "level_id" => "1", "status" => "1", "state_id" => '1'),


            //FIRST SEMESTER ND II
            array("code" => "COM211", "units" => "3", "semester" => "1", "title" => "COMPUTER PROGRAMMING  USING OO BASIC", "level_id" => "2", "status" => "1", "state_id" => '1'),
            array("code" => "COM212", "units" => "3", "semester" => "1", "title" => "INTRO TO SYSTEM PROGRAMMING", "level_id" => "2", "status" => "1", "state_id" => '1'),
            array("code" => "COM213", "units" => "3", "semester" => "1", "title" => "COMMERCIAL  PROGRAMMING  USING OO COBOL", "level_id" => "2", "status" => "1", "state_id" => '1'),
            array("code" => "COM214", "units" => "2", "semester" => "1", "title" => "FILE ORGANIZATION AND MANAGEMENT", "level_id" => "2", "status" => "1", "state_id" => '1'),
            array("code" => "COM215", "units" => "3", "semester" => "1", "title" => "COMPUTER PACKAGES II", "level_id" => "2", "status" => "1", "state_id" => '1'),
            array("code" => "COM216", "units" => "2", "semester" => "1", "title" => "COMPUTER TROUBLESHOOTING I", "level_id" => "2", "status" => "1", "state_id" => '1'),
            array("code" => "COM217", "units" => "2", "semester" => "1", "title" => "INTRODUCTION TO LINUX OS ", "level_id" => "2", "status" => "1", "state_id" => '1'),
            array("code" => "GNS211", "units" => "2", "semester" => "1", "title" => "INTRO. TO SOCIOLOGY", "level_id" => "2", "status" => "1", "state_id" => '1'),
            array("code" => "EED216", "units" => "2", "semester" => "1", "title" => "PRACTICE OF ENTREPRENEURSHIP", "level_id" => "2", "status" => "1", "state_id" => '1'),

            //SECOND SEMESTER ND II
            array("code" => "COM221", "units" => "3", "semester" => "2", "title" => "COMP. PROG USING OO FORTRAN", "level_id" => "2", "status" => "1", "state_id" => '1'),
            array("code" => "COM222", "units" => "2", "semester" => "2", "title" => "SEMINAR ON COMP. AND SOCIETY", "level_id" => "2", "status" => "1", "state_id" => '1'),
            array("code" => "COM223", "units" => "3", "semester" => "2", "title" => "BASIC HARDWARE MAINTENANCE", "level_id" => "2", "status" => "1", "state_id" => '1'),
            array("code" => "COM224", "units" => "3", "semester" => "2", "title" => "MANAGEMENT INFORMATION SYSTEM", "level_id" => "2", "status" => "1", "state_id" => '1'),
            array("code" => "COM225", "units" => "3", "semester" => "2", "title" => "WEB TECHNOLOGY", "level_id" => "2", "status" => "1", "state_id" => '1'),
            array("code" => "COM226", "units" => "2", "semester" => "2", "title" => "COMPUTER SYSTEMS TROUBLESHOOTING ", "level_id" => "2", "status" => "1", "state_id" => '1'),
            array("code" => "COM229", "units" => "4", "semester" => "2", "title" => "PROJECT", "level_id" => "2", "status" => "1", "state_id" => '1')


        ));

    }
} 