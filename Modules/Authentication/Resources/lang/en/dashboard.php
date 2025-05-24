<?php

return [
    'login' => [
        'form'          => [
            'btn'       => [
                'login' => 'Login Now',
            ],
            'name'     => 'Name',
            'email'     => 'ِEmail',
            'mobile'     => 'Mobile',
            'country'      => 'Country',
            'coumpany'     => 'Coumpany',
            'password'  => 'Password',
            'new_password'    => 'New Password',
            'confirm_password'=> 'Confirm Password',
            'current_password'=> 'Current Password',
            'dont_have_acccount'=> "Don't have an account?",
            'create_free_account'=> "Create an account for free",
            'by_creating_this_account'=> "By creating this account you accept our ",
            'privacy_policy'=> " Privacy Policy",
            'have_account'=> "You already have an account?",
            'sign_in'=> "Sign In",
            'create_account'=> "Create Account",
            
        ],
        'routes'        => [
            'index' => 'Login',
        ],
        'validations'   => [
            'email'     => [
                'email'     => 'Please add correct email format',
                'required'  => 'Please add your email address',
            ],
            'failed'    => 'These credentials do not match our records.',
            'password'  => [
                'min'       => 'Password must be more than 6 characters',
                'required'  => 'The password field is required',
            ],
        ],
    ],
];
