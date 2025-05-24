<?php

namespace Modules\Core\Packages\Influencer;
use Illuminate\Support\Facades\Facade;
use Modules\Core\Packages\Influencer\InfluencerStatisticManger;


class InfluencerStatistic extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return InfluencerStatisticManger::class; }
}