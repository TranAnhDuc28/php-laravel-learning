<?php

return [
    'teams' => [
        0 => [
            'key' => '0',
            'label' => 'Not Selected',
        ],
        1 => [
            'key' => '1',
            'label' => 'Manager',
        ],
        2 => [
            'key' => '2',
            'label' => 'Member',
        ],
    ],

    // Helper function để lấy label từ code
    'get_label' => function ($code) {
        return config('teams.teams.' . $code . '.label', 'Unknown');
    },

    // Helper function để lấy key từ code
    'get_key' => function ($code) {
        return config('teams.teams.' . $code . '.key', 'Unknown');
    },

    // Helper function để lấy tất cả types dưới dạng array cho select box
    'get_select_options' => function () {
        $options = [];
        foreach (config('teams.teams') as $code => $type) {
            $options[$code] = $type['label'];
        }
        return $options;
    }
];
