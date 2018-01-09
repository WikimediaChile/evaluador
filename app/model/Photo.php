<?php

namespace model;

class Photo extends \DB\SQL\Mapper
{
    public function __construct()
    {
        parent::__construct(database::instance(), 'photo');
    }

    public static function instance()
    {
        return new self;
    }

    public static function createPhoto(array $data)
    {
        $Photo = self::instance();
        foreach ($data as $index => $value) {
            $Photo->{$index} = $value;
        }
        $Photo->insert();
    }

    public static function getNotEvaluated(int $user_id)
    {
        return self::instance()->find(['photo_id not in (select photo_id from cast_vote where user_id = ?)', $user_id]);
    }

    public function size()
    {
        $sizes = ['', 'K', 'M', 'G', 'T'];
        $size = $this->photo_size;
        for ($i = 1; ($size_return = $size / pow(1024, $i+1)) > 1; $i++);
        return round($size_return*1024, 2).' '.$sizes[$i].'B';
    }
}
