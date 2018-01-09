<?php

namespace model;

class User extends \DB\SQL\Mapper
{
    public function __construct()
    {
        parent::__construct(database::instance(), 'user');
    }

    public static function instance()
    {
        return new self;
    }

    public static function getByID(int $user_id)
    {
        return self::instance()->findone(['user_id = ?', $user_id]);
    }

    public static function getByUserName(string $user_name)
    {
        return self::instance()->findone(['user_name = ?', $user_name]);
    }

    public static function isPassword(string $user_name, string $password) : bool
    {
        $User = self::getByUserName($user_name);
        return password_verify($password, $User->user_password);
    }
}
