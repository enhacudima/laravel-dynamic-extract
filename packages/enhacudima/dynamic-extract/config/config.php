<?php

return [
  #when you set true it require permissions can
  'auth' => false,
  #middleware permission
  'middleware' =>[
      'config' => 'config', #all user must have this permission to make configurations
      'extract' => 'extract' #all user must have this permission to make extract
  ],
  #make it true if you plan to use queue process
  'queue' => false,
  #prefix your route name and folder name
  'prefix' => 'dynamic-extract',
  #set intervaler time of refresh table view of processed file in min milliseconds
  'interval' => 30000,
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
