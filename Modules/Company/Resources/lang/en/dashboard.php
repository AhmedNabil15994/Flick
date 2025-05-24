<?php

return [
    "companies"=> [
        'routes'    => [
            'index'     => "Companies",
            "create"    => "Create Company",
            "update"    => "Edit Company" ,
            "show"      => "Show Company"

        ],
        'datatable' => [
            'name' => 'name',
            'description' => 'Description',
            "email"=> "Email",
            "logo" => "Logo",
            "manager_id"=> "Manager",
            "mobile"=> "Mobile number",
            "workers"  => "Workers",
            "status"  => "Status",
            'created_at' => 'Created At',
            'options' => 'Options',
        ],
        'form'      => [
            'name' => 'name',
            "tags"      => "Interests",
            'description' => 'Description',
            "email"=> "Email",
            "logo" => "Logo",
            "manager_id"=> "Manager",
            "mobile"=> "Mobile number",
            "workers"  => "Workers",
            "status"  => "Status",
            'tabs'      => [
                'general'   => 'General Info.',
                "subscriptions" => "subscriptions"

            ],
        ],
        "show" => [
            "subscriptions"=> [
              "current"  => "Current Subscriptions"  ,
              "package_id"  => "Package",
              "start_at" => "Start At",
              "end_at"   => "End At" ,
              "from_admin"=> "Added by admin",
              "transtions_id" => "Payment Transaction",
              "comment"   => "Comment", 
              "number_of_influencers" => "Number of influencers",
              "using_count" => "Number of using influencers",
              "price"         => "Price" ,
              "add"           => "Added New Subscription"
            ],
          ],

    ],
];
