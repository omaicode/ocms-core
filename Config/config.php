<?php

return [
    'name'         => 'Core',
    'admin_prefix' => env('APP_ADMIN_PREFIX', 'admin'),
    'admin_layout' => 'default-master',
    'cache_menu'   => false,
    'email_templates' => [
        'reset_password' => [
            'title'   => __('core::email.reset_password.title'),
            'description'   => __('core::email.reset_password.description'),
            'subject' => __('core::email.reset_password.subject'), //Path: Modules/Core/Resources/lang/{locale}/email.php
            'content' => 'core::email_templates.reset_password' //Path: Modules/Core/Resources/views/email_templates/reset_password.blade.php
        ]
    ]
];
