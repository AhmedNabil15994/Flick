<?php

namespace Modules\Core\Packages\Influencer;

use Modules\Core\Packages\Influencer\Contracts\TiktokStatisticInterface;
use Modules\Core\Packages\Influencer\Contracts\YoutubeStatisticInterface;
use Modules\Core\Packages\Influencer\Contracts\InstagramStatisticInterface;

class InfluencerStatisticManger
{
    public $instagram;
    public $youtube;
    public $tiktok;


    public function __construct(InstagramStatisticInterface $instagram, YoutubeStatisticInterface $youtube, TiktokStatisticInterface $tiktok)
    {
        $this->instagram =  $instagram;
        $this->youtube =  $youtube;
        $this->tiktok =  $tiktok;
    }


    public function instagram()
    {
        return $this->instagram;
    }

    public function youtube()
    {
        return $this->youtube;
    }

    public function tiktok()
    {
        return $this->tiktok;
    }
}
