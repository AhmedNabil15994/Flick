<?php

namespace Modules\Influencer\Enum;

class CampaignInfluencerStatus extends \SplEnum
{
    public const WAITING  = "waiting";


    public static function renderSelectedOptions()
    {
        return [
            "waiting" => self::WAITING
        ];
    }
}
