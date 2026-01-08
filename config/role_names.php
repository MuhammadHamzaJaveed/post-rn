<?php

return [
    'roles' => [
        'super_admin'      => 'Super_Admin',
        'admin'      => 'Admin',
        'verification-team' => 'Verification_Team',
        'supervisory-team' => 'Supervisory_Team',
        'incharge-team' => 'Incharge_Team',
        'guest'      =>  'Guest',
        'college' => 'College'
    ],

    'permissions' => [
        'user.create',
        'user.view',
        'user.viewAny',
        'user.update',
        'user.delete',
        'user.deleteAny',
        'college.update',
        'college.delete',
        'college.deleteAny',
        'meritlistfromcollege.create',
        'meritlistfromcollege.view',
        'meritlistfromcollege.viewAny',
        'meritlistfromcollege.update',
        'meritlistfromcollege.delete',
        'meritlistfromcollege.deleteAny',

        'super_admin' => [
            'user.create',
            'user.view',
            'user.viewAny',
            'user.update',
            'user.delete',
            'user.deleteAny',
            'college.create',
            'college.view',
            'college.viewAny',
            'college.update',
            'college.delete',
            'college.deleteAny',
            'meritlistfromcollege.create',
            'meritlistfromcollege.view',
            'meritlistfromcollege.viewAny',
            'meritlistfromcollege.update',
            'meritlistfromcollege.delete',
            'meritlistfromcollege.deleteAny',
        ],
        'admin' => [
            'user.create',
            'user.view',
            'user.viewAny',
            'user.update'
        ],

        'verification-team' => [
            'user.view',
        ],

        'supervisory-team' => [
            'user.view',
            'user.update',
        ],

        'incharge-team' => [
            'user.view',
            'user.update',
        ],
        
        'college' => [
            'meritlistfromcollege.view',
            'meritlistfromcollege.update',
        ],
     ]
];
