<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 1/26/15
 * Time: 12:43 PM
 */

class Student extends Eloquent{

    protected $with = array('user');

    public  function user()
    {
        return $this->hasOne("User", "id", "user_id");
    }


} 