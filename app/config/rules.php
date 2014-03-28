<?php

return [
    'auth' => [
        'register' => [
            'message' => [
                    'username.required' => 'Username cannot be empty',
                    'username.unique' => 'Username has been registered',
                    'fullname' => 'Fullname cannot less than 4 characters',
                    'password' => 'Password cannot less than 6 characters',
                    'email.required'    => 'Email cannot be empty',
                    'email.email'    => 'Email format is invalid',
                    'email.unique'    => 'Email has been registered'
            ],
            'rules' => [
                    'username' => 'required|unique:users|min:4',
                    'fullname' => 'required|min:4',
                    'password' => 'required|min:6',
                    'email' => 'required|email|unique:users'
            ],
        ],
        'manage_edit' => [
            'message' => [
                'fullname' => 'Fullname cannot less than 4 characters',
                'role.required' => 'Role cannot be empty',
                'role.alpha' => 'Role must be alphabetic characters',
                'status.required' => 'Status cannot be empty',
                'status.alpha' => 'Status must be alphabetic characters',
                'email.email'    => 'Email format is invalid',
                'email.required'    => 'Email cannot be empty'
            ],
            'rules' => [
                'fullname' => 'required|min:4',
                'email' => 'required|email'
            ]
        ],
    ]
]
;
