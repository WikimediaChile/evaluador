<?php

namespace controller;

use \helper\Hook;

class Start extends Main
{
    public function index(\Base $fat)
    {
        if ($fat->exists('SESSION.is_logged') === false) {
            $fat->set('SESSION.csrf', md5(rand().time()));
            Hook::setHook('head', '/css/login.css');
            $fat->set('page.content', 'user/login.html');
        } else {
            $fat->reroute('./vote');
        }

        return $fat;
    }

    public static function register(\Base $fat)
    {
        $fat->route('GET /', '\controller\Start->index');
    }
}
