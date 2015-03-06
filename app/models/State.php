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




} 