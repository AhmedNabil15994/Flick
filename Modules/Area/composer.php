<?php

//view()->composer(['area::dashboard.cities.*'], \Modules\Area\ViewComposers\Dashboard\CountryComposer::class);
//
//view()->composer([
//    'area::dashboard.states.*','company::dashboard.companies.*'
//], \Modules\Area\ViewComposers\Dashboard\CityComposer::class);
//
view()->composer(
    [
        'user::dashboard.users.create', 'user::dashboard.users.edit',
        'user::dashboard.workers.create', 'user::dashboard.workers.edit',
        'influencer::dashboard.influencers.create', 'influencer::dashboard.influencers.edit' ,'influencer::dashboard.influencers.index',
        'influencer::dashboard.influencer_instagram.create', 'influencer::dashboard.influencer_instagram.edit' ,"influencer::dashboard.influencers.address_filter",
        'influencer::dashboard.influencer_youtube.create', 'influencer::dashboard.influencer_youtube.edit' ,
        'influencer::dashboard.influencer_tiktok.create', 'influencer::dashboard.influencer_tiktok.edit' ,
        'influencer::dashboard.influencer_twitch.create', 'influencer::dashboard.influencer_twitch.edit' ,
    ],
    \Modules\Area\ViewComposers\Dashboard\CountryComposer::class
);
