<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 1/26/15
 * Time: 12:43 PM
 */

class State extends Eloquent{


    public static  function getCurrentState()
    {
        return State::where("active", "=", "1")->first();
    }


    public static  function toNextSemester()
    {
        $state =  State::getCurrentState();
        $new_state = new State();

        $new_state->active = 1;

        if(intval($state->semester) == 1)
        {
            $new_state->semester = 2;
            $new_state->session = $state->session;
        }
        else
        {
            $new_state->semester = 1;
            $new_state->session = intval($state->session )+ 1;
        }

        $new_state->save();
        $state->active = 0;
        $state->save();
        return $new_state;

    }




} 