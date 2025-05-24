<?php

view()->composer(
    [
        'influencer::dashboard.influencer_instagram.create', 'influencer::dashboard.influencer_instagram.edit' ,
        'influencer::dashboard.influencer_youtube.create', 'influencer::dashboard.influencer_youtube.edit' ,
        'influencer::dashboard.influencer_tiktok.create', 'influencer::dashboard.influencer_tiktok.edit' ,
        'influencer::dashboard.influencer_twitch.create', 'influencer::dashboard.influencer_twitch.edit' ,
        'influencer::dashboard.influencers.create', 'influencer::dashboard.influencers.edit' ,
        'company::dashboard.companies.create', 'company::dashboard.companies.edit' ,
    ],
    \Modules\Influencer\ViewComposers\Dashboard\TagComposer::class
);
