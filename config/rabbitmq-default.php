<?php
return [
    'defaults'=> [
        'connectable' => [
            'auto_reconnect'=>true,
            'reconnect_retries'=>5,
            'reconnect_delay'=>500000
        ],
        'producer'=>[
            'connection'=>'producer',
        ],
        'consumer'=>[
            'connection'=>'consumer'
        ]
    ],
];