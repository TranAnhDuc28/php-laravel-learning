<?php

return [
    'types' => [
        1 => [
            'key' => 'PL',
            'label' => 'Paid Leave', // Nghỉ phép
        ],
        2 => [
            'key' => 'UL',
            'label' => 'Unpaid Leave', // Nghỉ không lương
        ],
        3 => [
            'key' => 'PL_IA',
            'label' => 'Paid Leave in advance', // Nghỉ ứng phép
        ],
        4 => [
            'key' => 'CL',
            'label' => 'Compensation Leave', // Nghỉ bù
        ],
        5 => [
            'key' => 'SL',
            'label' => 'Special Leave', // Nghỉ việc riêng hưởng lương
        ],
        6 => [
            'key' => 'PPL',
            'label' => 'Planned Paid Leave', // Nghỉ phép có kế hoạch
        ],
        7 => [
            'key' => 'CBL',
            'label' => 'Child-Bearing Leave', // Nghỉ thai sản
        ],
//        8 => [
//            'key' => 'CO_PL',
//            'label' => 'Carried over Paid leave', // Chuyển phép
//        ],
//        9 => [
//            'key' => 'OTHER',
//            'label' => 'Other Leave', // Nghỉ khác
//        ],
    ],

    // Helper function để lấy label từ code
    'get_label' => function ($code) {
        return config('leave_types.types.' . $code . '.label', 'Unknown');
    },

    // Helper function để lấy key từ code
    'get_key' => function ($code) {
        return config('leave_types.types.' . $code . '.key', 'Unknown');
    },

    // Helper function để lấy tất cả types dưới dạng array cho select box
    'get_select_options' => function () {
        $options = [];
        foreach (config('leave_types.types') as $code => $type) {
            $options[$code] = $type['label'];
        }
        return $options;
    }
];
