<?php

use PhpAmqpLib\Connection\AMQPLazyConnection;
use PhpAmqpLib\Connection\AMQPLazySocketConnection;
use PhpAmqpLib\Connection\AMQPSocketConnection;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use Yetione\RabbitMQ\Constant\Connection as ConnectionEnum;

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
    'connections'=>[
        'default'=>[
            'insist'=>false,
            'login_method'=>ConnectionEnum::LOGIN_METHOD_AMQPPLAIN,
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
            'connection_type'=>ConnectionEnum::TYPE_STREAM_LAZY
        ],
        'consumer'=>[
            'insist'=>false,
            'login_method'=>ConnectionEnum::LOGIN_METHOD_AMQPPLAIN,
            'connection_timeout'=>3.0,
            'read_write_timeout'=>3.0,
            'heartbeat'=>0,
            'connection_type'=>ConnectionEnum::TYPE_STREAM_NORMAL
        ]
    ],
    'connection_types'=>[
        ConnectionEnum::TYPE_STREAM_NORMAL => AMQPStreamConnection::class,
        ConnectionEnum::TYPE_STREAM_LAZY => AMQPLazyConnection::class,
        ConnectionEnum::TYPE_SOCKET_NORMAL => AMQPSocketConnection::class,
        ConnectionEnum::TYPE_SOCKET_LAZY => AMQPLazySocketConnection::class
    ]
];