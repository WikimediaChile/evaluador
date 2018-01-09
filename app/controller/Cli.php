<?php

namespace controller;

use \model\Photo;

class Cli
{
    public static function load(\Base $fat)
    {
        $web = \Web::instance()->request('https://commons.wikimedia.org/w/api.php?action=query&format=json&prop=imageinfo&generator=categorymembers&iiprop=timestamp%7Cuser%7Csize%7Cdimensions%7Cmetadata&gcmtitle=Category%3AImages%20from%20Wiki%20Science%20Competition%202017%20in%20Chile&gcmtype=file&gcmlimit=max');
        $data = json_decode($web['body']);
        \model\database::instance()->log(false);
        foreach ((array)$data->query->pages as $index => $page) {
            $photo = ['photo_name' => $page->title, 'photo_author' => $page->imageinfo[0]->user, 'photo_height' => $page->imageinfo[0]->height
            , 'photo_width' => $page->imageinfo[0]->width, 'photo_size' => $page->imageinfo[0]->size];
            $id = Photo::createPhoto($photo);
            echo $page->title.PHP_EOL;
        }
    }

    public static function register($fat){
        $fat->route('GET /load', '\controller\Cli::load');
    }
}
