<?php

return [
    'tags' => [
        'routes'    => [
            'index'     => 'Tags',
            "create"    => "Create tag",
            "update"    => "Edit tag"
        ],
        'datatable' => [
            'title' => 'Title',
            'description' => 'Description',
            "status"  => "Status",
            'created_at' => 'Created At',
            'options' => 'Options',
        ],
        'form'      => [
            'title' => 'Title',
            'description' => 'Description',
            "status"  => "Status",
            'tabs'      => [
                'general'   => 'General Info.',
            ],
        ],

    ],
    "instagram"=> [
        'routes'    => [
            'index'     => "Instagram Accounts",
            "create"    => "Create Instagram Account",
            "update"    => "Edit Instagram Account" ,
            "show"      => "Show Instagram Account"

        ],
        'datatable' => [
            'influencer_id' => 'Influencer',
            'user_name' => 'User name',
            "account_id" => "Account Id",
            "latest_calling_at"=> "Latest Calling At",
            "workers"  => "Workers",
            "status"  => "Status",
            'created_at' => 'Created At',
            'options' => 'Options',
        ],
        'form'      => [
            'influencer_id' => 'Influencer',
            'user_name' => 'User name',
            "account_id" => "Account Id",
            "url"        => "Url",
            "latest_calling_at"=> "Latest Calling At",
            "workers"  => "Workers",
            "status"  => "Status",
            "url"        => "Profile Url",
            "followers" => "Flowers",
            "posts_count" => "Post Count",
            "avg_likes"  => "Avg Like ",
            "avg_views"  => "Avg view",
            "avg_reels_plays"=> "avg reels plays",
            "posts_with_hidden_likes_percentage"=> "posts with hidden likes percentage",
            "stat_history" =>"Stat history",
            "avg_comments"  => "Avg Comments" ,
            "audience_genders"=>"Audience genders",
            "audience_ages"   => "Audience ages",
            "audience_genders_per_age" =>"Audience genders per age",
            "engagement_rate"    => "Engagement rate",
            "engagements"        => "Engagements",
            "is_verified"       => "Is verified",
            "is_business"       => "Is Business",
            "is_hidden"         => "is_hidden",
            "audience_credibility"=> "Audience Credibility",
            "audience_types"   => "Audience Types" ,
            "api_info"          => "Api Ifo",
            'quality_score' => 'Quality Score',
            "msg"           => [
                "success" =>"Update completed successfully",
                "failed"  => "Unable to update, please check the  Account link"
            ],
            'tabs'      => [
                'general'   => 'General Info.',
                "statistic" => "Statistic",
            ],
        ],

    ],
    "influencers"=> [
        'routes'    => [
            'index'     => "Influencer's ",
            "create"    => "Create influencer",
            "update"    => "Edit influencer" ,
            "show"      => "Show Influencer"

        ],
        'datatable' => [
            'name' => 'Name',
            'bio' => 'Bio',
            "email"=> "Email",
            "image" => "image",
            "contact_number"=> "Contact number",
            "tags"  => "Tags",
            "website_url" => "Website url" ,
            "mobile"         => "Mobile",
            "instagram"=>"Instagram Accounts ",
            "youtube"=>"Youtube Accounts ",
            "tiktok" => "Tiktok Accounts",
            "country_id" => "Country",
            "status"  => "Status",
            'created_at' => 'Created At',
            'options' => 'Options',
            "filters" => [
                "type"   => "Type",
                'start'  => "From" ,
                "end"    => "To",
            ]
        ],
        'form'      => [
            'name' => 'Name',
            'bio' => 'Bio',
            "address_desc"=> "Address Description",
            "email"=> "Email",
            "mobile"         => "Mobile",
            "image" => "image",
            "contacts" => "Other Contacts",
            "gender"=> "Gender",
            "birth_date"=> "Birth Date",
            "age"       => "Age",
            "genders"=>[
                "male"=> "Male",
                "female"=> "Female"
            ],
            "nationality_id"=> "Nationality",
            "contact_number"=> "Contact number",
            "tags"  => "Tags",
            "website_url" => "Website url" ,
            "socials"=>"Socials Link",
            "city_id"=> "City",
            "state_id"=> "State",
            "country_id" => "Country",
            "status"  => "Status",
            'tabs'      => [
                'general'   => 'General Info.',
                "address" => "Address",
            ],
        ],

    ],
    "youtube"=> [
        'routes'    => [
            'index'     => "Youtube Accounts",
            "create"    => "Create Youtube Account",
            "update"    => "Edit Youtube Account" ,
            "show"      => "Show Youtube Account"

        ],
        'datatable' => [
            'influencer_id' => 'Influencer',
            'user_name' => 'User name',
            "account_id" => "Account Id",
            "latest_calling_at"=> "Latest Calling At",
            "workers"  => "Workers",
            "status"  => "Status",
            'created_at' => 'Created At',
            'options' => 'Options',
        ],
        'form'      => [
                'influencer_id' => 'Influencer',
                'user_name' => 'User name',
                "account_id" => "Account Id",
                "url"        => "Url",
                "latest_calling_at"=> "Latest Calling At",
                "avg_dislikes" => "Avg dislike",
                "total_views"  => "Total View ",
                "avg_comments"  => "Avg Comment",

                "workers"  => "Workers",
                "status"  => "Status",
                "url"        => "Profile Url",
                "followers" => "Flowers",
                "posts_count" => "Post Count",
                "avg_likes"  => "Avg Like ",
                "avg_views"  => "Avg view",
                "avg_reels_plays"=> "avg reels plays",
                "posts_with_hidden_likes_percentage"=> "posts with hidden likes percentage",
                "stat_history" =>"Stat history",
                "audience_genders"=>"Audience genders",
                "audience_ages"   => "Audience ages",
                "audience_genders_per_age" =>"Audience genders per age",
                "audience_genders_commenter"   => "Audience Commenter ages",
                "audience_genders_per_age_commenter" =>"Audience Commenter genders per age",
                "engagement_rate"    => "Engagement rate",
                "engagements"        => "Engagements",
                "is_verified"       => "Is verified",
                "is_hidden"         => "is_hidden",
                "api_info"          => "Api Ifo",
                "avg_comments"  => "Avg Comment",

                "msg"           => [
                    "success" =>"Update completed successfully",
                    "failed"  => "Unable to update, please check the  Account link"
                ],
                'tabs'      => [
                    'general'   => 'General Info.',
                    "statistic" => "Statistic",
                ],
            ],

    ],
    "twitch"=> [
        'routes'    => [
            'index'     => "Twitch Accounts",
            "create"    => "Create Twitch Account",
            "update"    => "Edit Twitch Account" ,
            "show"      => "Show Twitch Account"

        ],
        'datatable' => [
            'influencer_id' => 'Influencer',
            'user_name' => 'User name',
            "account_id" => "Account Id",
            "latest_calling_at"=> "Latest Calling At",
            "workers"  => "Workers",
            "status"  => "Status",
            'created_at' => 'Created At',
            'options' => 'Options',
        ],
        'form'      => [
            'influencer_id' => 'Influencer',
            'user_name' => 'User name',
            "account_id" => "Account Id",
            "latest_calling_at"=> "Latest Calling At",
            "workers"  => "Workers",
            "status"  => "Status",
            "status"  => "Status",
            'tabs'      => [
                'general'   => 'General Info.',
                "statistic" => "Statistic",
            ],
        ],

    ],
    "tiktok"=> [
        'routes'    => [
            'index'     => "Tiktok Accounts",
            "create"    => "Create Tiktok Account",
            "update"    => "Edit Tiktok Account" ,
            "show"      => "Show Tiktok Account"

        ],
        'datatable' => [
            'influencer_id' => 'Influencer',
            'user_name' => 'User name',
            "account_id" => "Account Id",
            "latest_calling_at"=> "Latest Calling At",
            "workers"  => "Workers",
            "status"  => "Status",
            'created_at' => 'Created At',
            'options' => 'Options',
        ],
        'form'      => [
            'influencer_id' => 'Influencer',
            'user_name' => 'User name',
            "account_id" => "Account Id",
            "url"        => "Url",
            "latest_calling_at"=> "Latest Calling At",
            "avg_dislikes" => "Avg dislike",
            "total_likes"  => "Total Likes ",
            "avg_comments"  => "Avg Comment",
            "workers"  => "Workers",
            "status"  => "Status",
            "url"        => "Profile Url",
            "followers" => "Flowers",
            "posts_count" => "Post Count",
            "avg_likes"  => "Avg Like ",
            "avg_views"  => "Avg view",
            "stat_history" =>"Stat history",
            "audience_genders"=>"Audience genders",
            "audience_ages"   => "Audience ages",
            "audience_genders_per_age" =>"Audience genders per age",
            "audience_reachability"   => "Audience reachability ",
            "engagement_rate"    => "Engagement rate",
            "engagements"        => "Engagements",
            "is_verified"       => "Is verified",
            "is_hidden"         => "is_hidden",
            "api_info"          => "Api Ifo",
            "avg_comments"  => "Avg Comment",

            "msg"           => [
                "success" =>"Update completed successfully",
                "failed"  => "Unable to update, please check the  Account link"
            ],
            'tabs'      => [
                'general'   => 'General Info.',
                "statistic" => "Statistic",
            ],
        ],

    ],
    'campaigns' => [
        'routes'    => [
            'index'     => 'Campaigns',
            "create"    => "Create campaigns",
            "update"    => "Edit campaigns"
        ],
        'datatable' => [
            'title' => 'Title',
            'description' => 'Description',
            "is_active"  => "Is Active",
            "company_id"    => "Owner",
            "status"  => "Status",
            "type" => "Type",
            "influencers"=> "influencers" ,
            "start_at"  => "Start At",
            "cover"     => "Cover",
            'created_at' => 'Created At',
            "end_at"     =>"End At",
            'options' => 'Options',
        ],
        'form'      => [
            'title' => 'Title',
            'description' => 'Description',
            "company_id"    => "Owner",
            "is_active"  => "Is Active",
            "cover"     => "Cover",
            "influencers"=> "influencers" ,
            "status"  => "Status",
            "start_at"  => "Start At",
            "end_at"     =>"End At",
            'tabs'      => [
                'general'   => 'General Info.',
                "influencers"=> "Influencers"
            ],
        ],

    ],
    'events' => [
        'routes'    => [
            'index'     => 'Groups',
            "create"    => "Create group",
            "update"    => "Edit group" ,
            "show"      => "Show group"
        ],
        'datatable' => [
            'title' => 'Title',
            'description' => 'Description',
            "campaign_id"    => "Campaign",
            "status"  => "Status",
            "influencers"=> "influencers" ,
            "start_at"  => "Start At",
            "invitations_count"=> "Invitations count",
            "invitations_accept_count"=> "Invitations accept count",
            "invitations_refused_count"=> "Invitations Refused count",
            "influencers_instagram"=> "Influencers instagram",
            "influencers_youtube"=> "Influencers youtube",
            "influencers_tiktok"=> "Influencers tiktok",
            'created_at' => 'Created At',
            "invitations"=> "invitations",
            "end_at"     =>"End At",
            'options' => 'Options',
            'invitations_statuses' => [
                \Modules\Influencer\Enum\InvitationStatus::WAITING  => 'Waiting',
                \Modules\Influencer\Enum\InvitationStatus::ACCEPT  => 'Accepted',
                \Modules\Influencer\Enum\InvitationStatus::REFUSED  => 'Apologies',
                \Modules\Influencer\Enum\InvitationStatus::ATTENDED  => 'Attended',
            ],
        ],
        'form'      => [
            'video' => 'Video',
            'show_video'    => 'Show Video',
            'title' => 'Title',
            'description' => 'Invitation Content',
            "campaign_id"    => "Campaign",
            "coverage_message" => "Coverage message",
            "location_desc"    => "Location Desc",
            "influencers"=> "influencers" ,
            "status"  => "Status",
            "mobile"         => "Mobile",
            "start_at"  => "Start At",
            "end_at"     =>"End At",
            "location"   => "Location Link",
            "location_desc"   => "Location Description",
            "helper_links"=> "Helper links",
            "add_influencers" => "Add Selected influencers",
            'campaign_url' => 'Campaign Url',
            "companions_count"=> "Companions count",
            'tabs'      => [
                'general'   => 'General Info.',
                "influencers"=> "Influencers"
            ],
            'invitation_status' => 'Invitation Status',
            'active' => "Active",
            'notActive' => 'Not Active',
            'update_status' => 'Update Status',
        ],

        'select_status' => 'Please Select Status',
    ],
];
