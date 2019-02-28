<?php

return [
    'sections' => [
        'app' => [
            'login' => [
                'route_login' => 'app.login',
                'show_login_form' => 'auth.login',
                'logged_out' => '/app/login',
                'guard' => 'app_web',
                'redirect_login' => '/app/dashboard'
            ],
            'password' => [
                'route_email' => 'app.password.email',
                'route_request' => 'app.password.request',
                'route_update' => 'app.password.update',
            ],
            'layout' => 'layouts.app'
        ],
        'admin' => [
            'login' => [
                'route_login' => 'admin.login',
                'show_login_form' => 'auth.login',
                'logged_out' => '/admin/login',
                'guard' => 'admin_web',
                'redirect_login' => '/admin/dashboard'
            ],
            'password' => [
                'route_email' => 'admin.password.email',
                'route_request' => 'admin.password.request',
                'route_update' => 'admin.password.update',
            ],
            'layout' => 'layouts.admin'
        ]
    ]
];