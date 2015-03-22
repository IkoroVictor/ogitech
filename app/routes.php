<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	if(Auth::check())
    {
        return View::make('main');
    }
    return View::make('login');

});


Route::get('/page/class/{id}', 'PageController@getClassPage');

Route::get('/page/scores/', 'PageController@getScoresPage');

Route::get('/page/courses/', 'PageController@getCoursesPage');


Route::get('/page/class', 'PageController@getDefaultClassPage');

Route::get('/page/results', 'PageController@getResultsPage');


Route::post("/login", "UserController@login");

Route::get('level/{id}/students/{state_id}', "LevelController@getClassList");

Route::get('level/{id}/results/{state_id}', "LevelController@getClassResult");




//=====================COURSES=========================================//

Route::get('course/{id}/result/{state_id}', "CourseController@getScores");

Route::post('course/{id}/result', "CourseController@saveScores");

Route::post('course', "CourseController@addCourse");

Route::post('course/{id}/upload', "CourseController@saveScoresFromCSV");

Route::put('course/{id}', "CourseController@saveCourse");

Route::delete('course/{id}', "CourseController@deleteCourse");

Route::get('courses', "CourseController@getAllCourses");

Route::get('courses/{level_id}/{semester}', "CourseController@getCourses");

Route::get('courses/{level_id}/{semester}/{state_id}', "CourseController@getActiveCoursesWithStateID");


//=============================STATES================================//

Route::get('states', "SystemController@getStates");
Route::get('close-semester', "SystemController@closeSemester");
Route::post('results/upload', "SystemController@uploadResultCSV");


//==========================STUDENTS===============================//
Route::put('student/{id}', "StudentController@saveStudent");

Route::post('student', "StudentController@addStudent");