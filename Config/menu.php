<?php
return [
    [
        'id' => 'ocms-menu-dashboard',
        'priority' => 0,
        'parent_id' => null,
        'name' => 'core::menu.dashboard',
        'icon' => 'fas fa-tachometer',
        'url' => route('admin.dashboard')        
    ],
    [
        'id' => 'ocms-menu-settings',
        'priority' => 98,
        'parent_id' => null,
        'name' => 'core::menu.settings',
        'icon' => 'fas fa-cog',
        'url' => '#',
        'permissions' => ['setting.view']        
    ],
    [
        'id' => 'ocms-menu-settings-general',
        'priority' => 0,
        'parent_id' => 'ocms-menu-settings',
        'name' => 'core::menu.settings.general',
        'url' => route('admin.settings.general'),
        'permissions' => ['setting.general'],         
    ],
    [
        'id' => 'ocms-menu-settings-email',
        'priority' => 1,
        'parent_id' => 'ocms-menu-settings',
        'name' => 'core::menu.settings.email',
        'url' => route('admin.settings.email'),
        'permissions' => ['setting.email'],          
    ],
    [
        'id' => 'ocms-menu-system',
        'priority' => 99,
        'parent_id' => null,
        'name' => 'core::menu.system',
        'icon' => 'fas fa-server',
        'url' => '#',
        'permissions' => ['system.view'],          
    ],
    [
        'id' => 'ocms-menu-system-administrators',
        'priority' => 0,
        'parent_id' => 'ocms-menu-system',
        'name' => 'core::menu.system.administrators',
        'url' => route('admin.system.administrators.index'),
        'permissions' => ['system.admins.view'],           
    ],
    [
        'id' => 'ocms-menu-system-roles',
        'priority' => 1,
        'parent_id' => 'ocms-menu-system',
        'name' => 'core::menu.system.roles',
        'url' => route('admin.system.roles.index'),
        'permissions' => ['system.roles.view'],           
    ],
    [
        'id' => 'ocms-menu-system-information',
        'priority' => 2,
        'parent_id' => 'ocms-menu-system',
        'name' => 'core::menu.system.information',
        'url' => route('admin.system.information'),
        'permissions' => ['system.information.view'],           
    ],
    [
        'id' => 'ocms-menu-system-activities',
        'priority' => 3,
        'parent_id' => 'ocms-menu-system',
        'name' => 'core::menu.system.activities',
        'url' => route('admin.system.activities'),
        'permissions' => ['system.activity.view'],        
    ],
    [
        'id' => 'ocms-menu-system-log',
        'priority' => 4,
        'parent_id' => 'ocms-menu-system',
        'name' => 'core::menu.system.logs',
        'url' => route('admin.system.logs'),
        'permissions' => ['system.error_log.view'],        
    ],
];