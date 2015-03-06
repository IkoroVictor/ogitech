<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 1/26/15
 * Time: 2:33 PM
 */

class LevelController extends BaseController {

    public function getClassList($id, $state_id)
    {
        if(intval($state_id) == 0)
            $state_id = State::getCurrentState()->id;
        return Response::json(Level::find($id)->students($state_id));
    }

    public function getClassResult($id, $state_id)
    {
        if(intval($state_id) == 0)
            $state_id = State::getCurrentState()->id;


        $gpa = Gpa::where("state_id", "=", $state_id)->where("level_id", "=", $id)->get();

        foreach ($gpa as $g)
        {
            $g->setAppends(array('results'));
        }

        return Response::json($gpa);
    }



} 