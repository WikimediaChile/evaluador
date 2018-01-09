<?php

namespace helper;

class Flash
{
    public static function set(string $key, string $value)
    {
        \F3::set('SESSION.flash', [$key => $value]);
    }

    public static function get(string $key)
    {
        $flash = \F3::get('SESSION.flash');
        return isset($flash[$key]) ? $flash[$key] : null;
    }

    public static function remove()
    {
        \F3::clear('SESSION.flash');
    }
}
