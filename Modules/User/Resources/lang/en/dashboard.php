<?php

return [
    'admins'            => [
        'create'    => [
            'form'  => [
                'confirm_password'  => 'Confirm Password',
                'email'             => 'Email',
                'general'           => 'General Info.',
                'image'             => 'Profile Image',
                'info'              => 'Info.',
                'mobile'            => 'Mobile',
                'name'              => 'Name',
                'password'          => 'Password',
                'roles'             => 'Roles',
            ],
            'title' => 'Create Admins',
        ],
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'email'         => 'Email',
            'image'         => 'Image',
            'mobile'        => 'Mobile',
            'name'          => 'Name',
            'options'       => 'Options',
        ],
        'index'     => [
            'title' => 'Admins',
        ],
        'update'    => [
            'form'  => [
                'confirm_password'  => 'Confirm Password',
                'email'             => 'Email',
                'general'           => 'General info.',
                'image'             => 'Profile Image',
                'mobile'            => 'Mobile',
                'name'              => 'Name',
                'password'          => 'Change Password',
                'roles'             => 'Roles',
            ],
            'title' => 'Update Admins',
        ],
        'validation'=> [
            'email'     => [
                'required'  => 'Please enter the email of admin',
                'unique'    => 'This email is taken before',
            ],
            'mobile'    => [
                'digits_between'    => 'Please add mobile number only 8 digits',
                'numeric'           => 'Please enter the mobile only numbers',
                'required'          => 'Please enter the mobile of admin',
                'unique'            => 'This mobile is taken before',
            ],
            'name'      => [
                'required'  => 'Please enter the name of admin',
            ],
            'password'  => [
                'min'       => 'Password must be more than 6 characters',
                'required'  => 'Please enter the password of admin',
                'same'      => 'The Password confirmation not matching',
            ],
            'roles'     => [
                'required'  => 'Please select the role of admin',
            ],
        ],
    ],
    'users'             => [
        'form'  => [
            'confirm_password'  => 'Confirm Password',
            'email'             => 'Email',
            'general'           => 'General Info.',
            'image'             => 'Profile Image',
            'info'              => 'Info.',
            'mobile'            => 'Mobile',
            'name'              => 'Name',
            'password'          => 'Password',
            "country_id"    => "Country",
            "admin_approved"    => "Admin approved",
            "is_verified"       => "is verified",

        ],
        'create'    => [
            
            'title' => 'Create Users',
        ],
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'email'         => 'Email',
            'image'         => 'Image',
            'mobile'        => 'Mobile',
            "admin_approved"=> "Admin approve status",
            "status"     => "Status",
            'name'          => 'Name',
            'options'       => 'Options',
        ],
        'index'     => [
            'title' => 'Users',
        ],
        'update'    => [
           
            'title' => 'Update User',
        ],
        "show" => [
            "title" => "Show Users" ,
            "tabs"  => [
                'general'           => 'General Info.',
                "subscriptions"     => "Subscriptions",
              ],
          ],
        'validation'=> [
            'email'     => [
                'required'  => 'Please enter the email of user',
                'unique'    => 'This email is taken before',
            ],
            'mobile'    => [
                'digits_between'    => 'Please add mobile number only 8 digits',
                'numeric'           => 'Please enter the mobile only numbers',
                'required'          => 'Please enter the mobile of user',
                'unique'            => 'This mobile is taken before',
            ],
            'name'      => [
                'required'  => 'Please enter the name of user',
            ],
            'password'  => [
                'min'       => 'Password must be more than 6 characters',
                'required'  => 'Please enter the password of user',
                'same'      => 'The Password confirmation not matching',
            ],
        ],
    ],
    'workers'             => [
        'form'  => [
            'confirm_password'  => 'Confirm Password',
            'email'             => 'Email',
            'general'           => 'General Info.',
            'image'             => 'Profile Image',
            'info'              => 'Info.',
            'mobile'            => 'Mobile',
            'name'              => 'Name',
            'password'          => 'Password',
            "country_id"    => "Country",
            "admin_approved"    => "Admin approved",
            "is_verified"       => "is verified",
            "type"              => "Type",
            "roles"             => "ٌRoles",
            "types"             => [
                "influencer_worker" => "Influencer Worker" ,
                "company_worker"    => "Company Worker"

            ]

        ],
        'create'    => [
            
            'title' => 'Create Worker',
        ],
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'email'         => 'Email',
            "type"              => "Type",
            'image'         => 'Image',
            'mobile'        => 'Mobile',
            "admin_approved"=> "Admin approve status",
            "status"     => "Status",
            'name'          => 'Name',
            'options'       => 'Options',
        ],
        'index'     => [
            'title' => 'Workers',
        ],
        'update'    => [
           
            'title' => 'Update Worker',
        ],
        "show" => [
            "title" => "Show Worker" ,
            "tabs"  => [
                'general'           => 'General Info.',
              ],
          ],

    ]
];
