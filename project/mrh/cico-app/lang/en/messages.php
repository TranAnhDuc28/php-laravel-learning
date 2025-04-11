<?php

return [
    'team_name' => [
        'required' => 'Team name is required',
        'string' => 'Team name must be a string',
        'max' => 'Team name must not exceed 20 characters',
        'regex' => 'Team name must only contain letters',
        'not_regex' => 'Team name must not contain whitespace',
        'unique' => 'This team name already exists',
    ],
    'project_name' => [
        'required' => 'Project name is required',
        'string' => 'Project name must be a string',
        'max' => 'Project name must not exceed 20 characters',
        'regex' => 'Project name must only contain letters',
        'not_regex' => 'Project name must not contain whitespace',
        'unique' => 'This project name already exists',
    ],
    'mesError' => [
        'perDeny' => 'You do not have permission to access!',
    ],
    'appForm' => [
        'moreClear' => 'Please separate the leave form to make your leave request more clear.',
        'lessThan2hours' => 'Leave less than 2 hours please select "Unpaid Leave"',
        'default' => 'Not eligible for register Application Form (register Application Form ≤ 2 hours/day)'
    ],
//    __('messages.appForm.lessThan2hours')
];
