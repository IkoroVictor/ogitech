<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 2/8/15
 * Time: 1:18 PM
 */

class PageController extends  BaseController{

   public function getClassPage($id)
   {
       $state = State::getCurrentState();
       $list = Level::find($id)->students($state->id);
       return View::make('pages.class', ["list" => $list->toJson(), "states" => State::where('semester', '=',1)->get()]);
   }

    public function getDefaultClassPage()
    {
        $state = State::getCurrentState();
        $list = Level::find(1)->students($state->id);
        return View::make('pages.class', ["list" => $list->toJson(), "states" => State::all()]);
    }

    public function getScoresPage()
    {
        return View::make('pages.sheet');
    }
    public function getDashboardPage()
    {
        return View::make('pages.dashboard');
    }

    public function getCoursesPage()
    {
        return View::make('pages.courses');
    }
    public function getResultsPage()
    {
        return View::make('pages.results', ["states" => State::all()]);
    }
} 