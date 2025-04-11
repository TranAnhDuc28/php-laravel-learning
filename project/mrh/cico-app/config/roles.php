<?php

return [
    'roles' => [
        0 => [
            'key' => '0',
            'label' => 'Administrator',
        ],
        1 => [
            'key' => '1',
            'label' => 'Member',
        ],
        2 => [
            'key' => '2',
            'label' => 'Moderator',
        ],
        9 => [
            'key' => '9',
            'label' => 'Power User',
        ],
    ],

    // Helper function để lấy label từ code
    'get_label' => function ($code) {
        return config('roles.roles.' . $code . '.label', 'Unknown');
    },

    // Helper function để lấy key từ code
    'get_key' => function ($code) {
        return config('roles.roles.' . $code . '.key', 'Unknown');
    },

    // Helper function để lấy tất cả types dưới dạng array cho select box
    'get_select_options' => function () {
        $options = [];
        foreach (config('roles.roles') as $code => $type) {
            $options[$code] = $type['label'];
        }
        return $options;
    }
];
