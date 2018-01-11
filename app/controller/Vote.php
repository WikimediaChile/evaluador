<?php

namespace controller;

use \model\Photo;
use \model\User;
use \helper\Hook;

class Vote extends Main
{
    public function index(\Base $fat)
    {
        $Photos = Photo::getNotEvaluated($fat->get('SESSION.id'));
        $elements = [];
        shuffle($Photos);
        for ($i = 6; $i > 0; $i--) {
            $elements[] = array_pop($Photos);
        }
        $fat->set('User', User::getByID($fat->get('SESSION.id')));
        $fat->set('photos', $elements);
        $fat->set('page.content', 'vote/grid.html');
        Hook::setHook('body', 'https://code.jquery.com/jquery-2.2.4.min.js', Hook::JS);
        Hook::setHook('body', '/js/vote.js', Hook::JS);
    }

    public function vote_ajax(\Base $fat)
    {
        $data = [
            'vote_user' => $fat->get('SESSION.id'),
            'vote_photo' => $fat->get('POST.photo'),
            'vote_date' => date('YmdHis'),
            'vote_rand' => md5(date('YmdHis').$fat->get('POST.photo').$fat->get('SESSION.id')),
            'vote_artistic' => $fat->get('POST.artistico'),
            'vote_scientist' => $fat->get('POST.cientifico')
        ];
        if (\model\Vote::setVote($data) === false) {
            http_response_code(500);
        }
    }

    public function beforeroute(\Base $fat)
    {
        parent::beforeroute($fat);
        if ($fat->exists('SESSION.is_logged') === false) {
            $fat->reroute('/');
        }
    }

    public static function register(\Base $fat)
    {
        $fat->route('GET /vote', '\controller\Vote->index');
        $fat->route('POST /voting', '\controller\Vote->vote_ajax');
    }
}
