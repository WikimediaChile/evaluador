<?php

namespace controller;

use \model\User as UserModel;
use \helper\Flash;

class User extends Main
{
    public function login(\Base $fat)
    {
        if ($fat->get('POST.token') !== $fat->get('SESSION.csrf')) {
            Flash::set('message', 'Error en el token de validación');
            $fat->reroute('/');
        }
        if (UserModel::isPassword($fat->get('POST.user'), $fat->get('POST.password'))) {
            $User =  UserModel::getByUserName($fat->get('POST.user'));
            $fat->mset(['SESSION.is_logged' => true, 'SESSION.id' => $User->user_id, 'SESSION.is_admin' => !!$User->user_admin]);
            $fat->reroute('../vote');
        } else {
            Flash::set('message', 'Error en sus credenciales de ingreso');
            $fat->reroute('/');
        }
    }

    public function salir(\Base $fat)
    {
        $fat->clear('SESSION');
        $fat->reroute('/');
    }

    public static function register(\Base $fat)
    {
        $fat->route('POST /user/login', '\controller\User->login');
        $fat->route('GET /salir', '\controller\User->salir');

        return $fat;
    }
}
