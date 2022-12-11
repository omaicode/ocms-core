<?php

return [
    'auth.sign_in'    => 'Sign In',
    'auth.username'   => 'Username',
    'auth.username_placeholder'   => 'Enter your username',
    'auth.email'      => 'Email',
    'auth.email_placeholder'   => 'Enter your email',
    'auth.password'   => 'Password',
    'auth.password_placeholder' => 'Enter your password',
    'auth.forgot_password' => 'Forgot password?',
    'auth.back_to_login' => 'Back to signin',
    'auth.reset_password' => 'Reset Password',
    'auth.reset_limit' => 'Please wait 5 minutes before you can send new request.',
    'auth.reset_sent' => "We've sent an mail with reset password link to your email, please check.",
    'auth.reset_invalid' => "Your password reset link is not valid or expired.",
    'auth.new_password' => "New Password",
    'auth.new_password_placeholder' => "Enter your new password",
    'auth.new_password_confirmation' => "New Password Confirmation",
    'auth.new_password_confirmation_placeholder' => "Re-peat your new password",
    'auth.reset_password_success' => "Your password has been changed successfully!",
    'general.backend' => 'Backend',
    'general.google_analytics' => 'Google Analytics',
    'general.maintenance' => 'Maintenance',
    'email.server' => 'Server',
    'email.templates' => 'Templates',
    'save_changes' => 'Save Changes',
    'saved'        => 'Saved changes successfully!',
    'email_error'  => "Oops! Send mail failed, please try again later.",
    'ajax_email_template_error' => "Can't load email template.",
    'cache_cleared' => "Cache cleared successfully!",
    'publish' => 'Publish',
    'save' => 'Save',
    'save_and_edit' => 'Save & Edit',
    'profile' => 'My Profile',
    'logout'  => 'Logout',
    'statistics' => 'Statistics',
    'admin' => [
        'deleting_yourself' => "You can't delete yourself",
        'new_administrator' => "New Administrator",
        'edit_administrator' => "Edit Administrator",
        'username' => 'Username',
        'email' => 'Email',
        'name' => 'Full name',
        'role' => 'Role',
        'password' => 'Password',
        'password_confirm' => 'Password confirmation',
        'username_placeholder' => 'Enter username',
        'email_placeholder' => 'Enter email address',
        'name_placeholder'  => 'Enter full name',
        'role_placeholder' => 'Select role',
        'password_placeholder' => 'Enter password',
        'password_confirm_placeholder' => 'Re-enter password',
        'username_help' => 'The username must have at least 6 characters and only contains characters a-z, A-Z, 0-9.',
        'password_help' => 'The password must have at least 8 characters.',
        'avatar' => 'Avatar'
    ],
    'dashboard' => [
        'total_admins'  => 'Total Admins',
        'total_modules' => 'Total Modules',
        'cms_version'   => 'CMS Version',
        'changelog'     => 'Changelog',
        'recent_activities' => 'Recent activities',
        'no_activities'   => 'There is no activities to show.',
        'total_visitors' => 'Total Visitors',
        'total_views'    => 'Total Views',
    ],
    'roles' => [
        'title' => 'Roles',
        'id' => 'ID',
        'name' => 'Name',
        'created_at' => 'Created at',
        'total_permissions' => 'Total permissions',
        'create' => 'Create',
        'edit'   => 'Edit',
        'permissions' => [
            'setting' => [
                'view' => 'View settings menu',
                'general' => 'Edit general settings',
                'email' => 'Edit email settings',
            ],
            'system' => [
                'view' => 'View system menu',
                'information' => [
                    'view' => 'System information'
                ],
                'activity' => [
                    'view' => 'Activity logs'
                ],
                'error_log' => [
                    'view' => 'Error logs'
                ],
                'admins' => [
                    'view'   => 'Administrators - view',
                    'edit'   => 'Administrators - edit',
                    'create' => 'Administrators - create',
                    'delete' => 'Administrators - delete'
                ],
                'roles' => [
                    'view'   => 'Roles - view',
                    'edit'   => 'Roles - edit',
                    'create' => 'Roles - create',
                    'delete' => 'Roles - delete'
                ],
            ]
        ]
    ]
];