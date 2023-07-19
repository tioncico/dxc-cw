<?php
return [
    'SERVER_NAME' => "EasySwoole",
    'WEB'         => [ //web配置项
        'SSL'  => false,
        'HOST' => 'test.php20.cn',
    ],
    'MAIN_SERVER' => [
        'LISTEN_ADDRESS' => '0.0.0.0',
        'PORT'           => 9501,
        'SERVER_TYPE'    => EASYSWOOLE_WEB_SOCKET_SERVER, //可选为 EASYSWOOLE_SERVER  EASYSWOOLE_WEB_SERVER EASYSWOOLE_WEB_SOCKET_SERVER
        'SOCK_TYPE'      => SWOOLE_TCP,
        'RUN_MODEL'      => SWOOLE_PROCESS,
        'SETTING'        => [
            'worker_num'            => 8,
            'reload_async'          => true,
            'package_max_length'    => 1024 * 1024 * 200,
            'max_wait_time'         => 3,
            'document_root'         => EASYSWOOLE_ROOT . '/Static/',
            'enable_static_handler' => true,
        ],
        'TASK'           => [
            'workerNum'     => 4,
            'maxRunningNum' => 128,
            'timeout'       => 15
        ]
    ],
    'TEMP_DIR'    => null,
    'LOG_DIR'     => null,
    "MYSQL"       => [//mysql
        'host'     => 'admin.php20.cn',
        'port'     => 3300,
        'user'     => 'mwxz',
        'password' => 'mwxz123456',
        'database' => 'mwxz',
        'charset'  => 'utf8mb4',
    ],
    "REDIS"       => [//redis
        'host'      => '127.0.0.1',
        'port'      => 6379,
        'serialize' => \EasySwoole\Redis\Config\RedisConfig::SERIALIZE_PHP,
    ],
    "ALI_OSS"     => [//阿里云oss
        "KEY"       => '213',
        "BUCKET"    => 'fs-213',
        "SECRET"    => '213',
        "END_POINT" => 'oss-cn-beijing.aliyuncs.com',
        "REGION"    => 'cn-hangzhou',//sts相关配置
        "HOST"      => 'http://fs-123.oss-cn-beijing.aliyuncs.com',
        "ROLE_ARN"  => 'acs:ram::123:role/aliyunosstokengeneratorrole'//sts相关配置
    ],
];
