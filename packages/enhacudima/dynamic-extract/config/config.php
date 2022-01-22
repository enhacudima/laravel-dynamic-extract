<?php

return [
  #when you set true it require permissions can
  'auth' => false,
  #prefix your route name
  'prefix' => 'dynamic-extract',
  #set your permissions based on you table permissions
  'permissions'=>[
    'report-1',
    'report-2',
    'report-3',
  ],
  #set list for drop down filter
  'lists' =>[
      'group_1'=>[
            'group_name'=>'Group-1',
            'options'=>[
                        'option-1',
                        'option-2',
                        ]
            ],
      'group_2'=>[
            'group_name'=>'Group-2',
            'options'=>[
                        'option-3',
                        'option-4',
                        ]
            ]
    ],
  #set list for drop down filter
  'columuns' =>[
      'group_1'=>[
            'group_name'=>'Group-1',
            'options'=>[
                        'name',
                        'email',
                        ]
            ],
      'group_2'=>[
            'group_name'=>'Group-2',
            'options'=>[
                        'email_verified_at',
                        'created_at',
                        ]
            ]
    ]
];
