<?php

return [

    [
        'name' => 'Categories',
        'permissions' => [
            ['key' => 'categories.add', 'value' => 'Can Add Categories'],
            ['key' => 'categories.edit', 'value' => 'Can Edit Categories'],
            ['key' => 'categories.view', 'value' => 'Can View Categories'],
            ['key' => 'categories.delete', 'value' => 'Can Delete Categories'],
        ]
    ],
    [
        'name' => 'Sub Categories',
        'permissions' => [
            ['key' => 'sub_categories.add', 'value' => 'Can Add Sub Categories'],
            ['key' => 'sub_categories.edit', 'value' => 'Can Edit Sub Categories'],
            ['key' => 'sub_categories.view', 'value' => 'Can View Sub Categories'],
            ['key' => 'sub_categories.delete', 'value' => 'Can Delete Sub Categories'],
        ]
    ],
    [
        'name' => 'Sources',
        'permissions' => [
            ['key' => 'sources.add', 'value' => 'Can Add Sources'],
            ['key' => 'sources.edit', 'value' => 'Can Edit Sources'],
            ['key' => 'sources.view', 'value' => 'Can View Sources'],
            ['key' => 'sources.delete', 'value' => 'Can Delete Sources'],
        ]
    ],
    [
        'name' => 'Posts',
        'permissions' => [
            ['key' => 'posts.add', 'value' => 'Can Add Posts'],
            ['key' => 'posts.edit', 'value' => 'Can Edit Posts'],
            ['key' => 'posts.view', 'value' => 'Can View Posts'],
            ['key' => 'posts.delete', 'value' => 'Can Delete Posts'],
        ]
    ],
    [
        'name' => 'Tags',
        'permissions' => [
            ['key' => 'tags.view', 'value' => 'Can View Tags'],
            ['key' => 'tags.delete', 'value' => 'Can Delete Tags'],
        ]
    ],
    [
        'name' => 'Ratings',
        'permissions' => [
            ['key' => 'ratings.view', 'value' => 'Can View Ratings'],
            ['key' => 'ratings.delete', 'value' => 'Can Delete Ratings'],
        ]
    ],
    [
        'name' => 'Pages',
        'permissions' => [
            ['key' => 'pages.add', 'value' => 'Can Add Pages'],
            ['key' => 'pages.edit', 'value' => 'Can Edit Pages'],
            ['key' => 'pages.view', 'value' => 'Can View Pages'],
            ['key' => 'pages.delete', 'value' => 'Can Delete Pages'],
        ]
    ],
    [
        'name' => 'Users',
        'permissions' => [
            ['key' => 'users.add', 'value' => 'Can Add Users'],
            ['key' => 'users.edit', 'value' => 'Can Edit Users'],
            ['key' => 'users.view', 'value' => 'Can View Users'],
            ['key' => 'users.delete', 'value' => 'Can Delete Users'],
        ]
    ],
    [
        'name' => 'Ads Sections',
        'permissions' => [
            ['key' => 'ad_sections.add', 'value' => 'Can Add Ad Sections'],
            ['key' => 'ad_sections.edit', 'value' => 'Can Edit Ad Sections'],
            ['key' => 'ad_sections.view', 'value' => 'Can View Ad Sections'],
            ['key' => 'ad_sections.delete', 'value' => 'Can Delete Ad Sections'],
        ]
    ],
    [
        'name' => 'Statistics',
        'permissions' => [
            ['key' => 'statistics.view', 'value' => 'Can View Statistics'],
        ]
    ],
    [
        'name' => 'Cron Logs',
        'permissions' => [
            ['key' => 'crons.run', 'value' => 'Can Add Crons'],
            ['key' => 'crons.view', 'value' => 'Can View Specific Crons'],
            ['key' => 'crons.all', 'value' => 'Can View All Cron'],
            ['key' => 'crons.delete', 'value' => 'Can Delete Crons'],
        ]
    ],
    [
        'name' => 'User Roles',
        'permissions' => [
            ['key' => 'roles.add', 'value' => 'Can Add User Roles'],
            ['key' => 'roles.edit', 'value' => 'Can Edit User Roles'],
            ['key' => 'roles.view', 'value' => 'Can View User Roles'],
            ['key' => 'roles.delete', 'value' => 'Can Delete User Roles'],
        ]
    ],
    [
        'name' => 'Settings',
        'permissions' => [
            ['key' => 'settings.general', 'value' => 'Can Update General Settings'],
            ['key' => 'settings.seo', 'value' => 'Can Update SEO Settings'],
            ['key' => 'settings.comments', 'value' => 'Can Update Comments Settings'],
            ['key' => 'settings.socials', 'value' => 'Can Update Socials Settings'],
            ['key' => 'settings.custom_js', 'value' => 'Can Update Custom JS Settings'],
            ['key' => 'settings.custom_css', 'value' => 'Can Update Custom CSS Settings'],
            ['key' => 'settings.view', 'value' => 'Can View Settings'],
        ]
    ]

];
