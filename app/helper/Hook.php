<?php

namespace helper;

class Hook
{
    const CSS = 1;
    const JS = 2;

    const css = '<link rel="stylesheet" href="%s">';
    const js = '<script type="text/javascript" src="%s"></script>';

    private static $store = [];

    public static function setHook(string $place, string $value, int $type = self::CSS)
    {
        self::$store[$place][$type][] = $value;
    }

    public static function run(string $place) : string{
        if(isset(self::$store[$place]) === false){
            return "";
        }
        $data = self::$store[$place];
        $include = [];
        foreach($data as $type => $asset){
            $base = $type === self::CSS ? self::css : self::js;
            $include = array_map(function($f) use($base){ return sprintf($base, $f); }, $asset);
        }
        return implode("\n", $include);
    }

}
