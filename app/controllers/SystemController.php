<?php
/**
 * Created by PhpStorm.
 * User: olaokenyi
 * Date: 1/26/15
 * Time: 2:39 PM
 */

class SystemController extends BaseController{

    public function close()
    {
        $state = State::orderBy("id", "desc")->first();

    }
} 