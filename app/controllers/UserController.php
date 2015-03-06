<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 2/7/15
 * Time: 11:20 AM
 */

class UserController extends  BaseController{

    public function login()
    {
        $credentials = Input::all();
        if(Auth::attempt($credentials))
        {
           return Redirect::intended("/");
        }
        return Redirect::to("/");

    }
} 