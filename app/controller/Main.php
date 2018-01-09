<?php

namespace controller;

use \helper\Flash;

abstract class Main
{
    public function beforeroute(\Base $fat)
    {
        $fat->set('page.title', 'Servicio de Evaluación');
    }

    public function afterroute(\Base $fat)
    {
        if ($fat->get('AJAX') === false) {
            echo \Template::instance()->render('layout.html');
        }
        Flash::remove();
    }

    abstract public static function register(\Base $fat);
}
