<?php

return [
    /**
     * Welcome email
     */
    'welcome_email' => [
        'welcome' => 'Welcome, :name',
        'successfull_registration' => 'You have registered correctly',
        'successfull_registration_activate' => 'Before you start using ' . env('APP_NAME') .' you must activate your account',
        'activate_your_account' => 'Activate your account',
    ],
    /**
     * Reset password
     */
    'reset_password' => [
        'you_are_receiving' => 'You are receiving this email because we received a password reset request for your account.',
        'if_you_did_not_request' => 'If you did not request a password reset, no further action is required.',
        'reset_password' => 'Reset Password'
    ]

];
