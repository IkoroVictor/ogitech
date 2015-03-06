<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 1/26/15
 * Time: 12:54 PM
 */

class Level extends  Eloquent{



    public function students($state_id)
    {
        return StudentState::where("state_id", "=", $state_id)->where("level_id", "=", $this->id)->with("student")->get();
    }








} 