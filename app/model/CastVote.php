<?php

namespace model;

class CastVote extends \DB\SQL\Mapper{

    public function __construct(){
        parent::__construct(database::instance(), 'cast_vote');
    }
    
}
