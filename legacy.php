<?php
return [
    'death_verification' => [
        'approval_required' => true,
        'lawyer_timeout_hours' => 48,
        'access_duration_days' => 30,
    ],
    'subscription' => [
        'trial_days' => 14,
        'plans' => [
            'individual' => ['price' => 299, 'assets' => 50],
            'family' => ['price' => 499, 'assets' => 200],
            'one_time' => ['price' => 999, 'assets' => -1],
        ],
    ],
    'security' => [
        '2fa_required' => true,
        'max_login_attempts' => 5,
    ],
];
