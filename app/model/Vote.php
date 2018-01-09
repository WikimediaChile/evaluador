<?php

namespace model;

class Vote extends \DB\SQL\Mapper
{
    public function __construct()
    {
        parent::__construct(database::instance(), 'vote');
    }

    public static function setVote(array $params) : bool
    {
        $Find = (new self)->count(['vote_user = ? and vote_photo = ?', $params['vote_user'], $params['vote_photo']]);
        if ($Find > 0) {
            return false;
        }
        $Vote = (new self);
        $Vote->copyFrom($params);
        $Vote->save();
        return true;
    }
}
