<?php use Yetione\RabbitMQAdapter\Producers\BatchProducer;
use Yetione\RabbitMQAdapter\Producers\SingleProducer;

return [
    'credentials'=>[
        'default'=>[
            'username'=>'',
            'password'=>'',
            'vhost'=>'/'
        ]
    ],
    'nodes'=>[
        [
            'host'=>'',
            'port'=>5672,
            'credentials'=>'default'
        ]
    ],
    'connection_options'=>[
        'default'=>[
            'insist'=>false,
            'login_method'=>'AMQPLAIN',
            'login_response'=> null,
            'locale'=> 'en_US',
            'connection_timeout'=> 3.0,
            'read_write_timeout'=> 3.0,
            'context_options'=> null,
            'context_params'=> null,
            'keepalive'=> false,
            'heartbeat'=> 0,
            'channel_rpc_timeout'=> 0.0,
            'ssl_protocol'=> null
        ],
        'producer'=>[
            'connection_timeout'=>3.0,
            'read_write_timeout'=>3.0,
            'keepalive'=>false,
            'heartbeat'=>0,
            'connection_type'=>'lazy'
        ],
        'consumer'=>[
            'insist'=>false,
            'login_method'=>'AMQPLAIN',
            'connection_timeout'=>3.0,
            'read_write_timeout'=>3.0,
            'heartbeat'=>0,
            'connection_type'=>'normal'
        ]
    ],
    'producers_types'=>[
        'single'=> SingleProducer::class,
        'batch'=> BatchProducer::class
    ]
];