<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2017/12/30
 * Time: 下午10:59
 */

return [
    "ENV" => "dev",
    'SERVER_NAME' => "EasySwoole",
    'MAIN_SERVER' => [
        'HOST' => '0.0.0.0',
        'PORT' => 9501,
        'SERVER_TYPE' => \EasySwoole\Core\Swoole\ServerManager::TYPE_WEB_SERVER,
        'SOCK_TYPE' => SWOOLE_TCP,//该配置项当为SERVER_TYPE值为TYPE_SERVER时有效
        'RUN_MODEL' => SWOOLE_PROCESS,
        'SETTING' => [
            'task_worker_num' => 8, //异步任务进程
            'task_max_request' => 10,
            'max_request' => 5000,//强烈建议设置此配置项
            'worker_num' => 8,
        ],
    ],
    'DEBUG' => true,
    'TEMP_DIR' => null,//若不配置，则默认框架初始化
    'LOG_DIR' => null,//若不配置，则默认框架初始化
    'EASY_CACHE' => [
        'PROCESS_NUM' => 1,//若不希望开启，则设置为0
        'PERSISTENT_TIME' => 0//如果需要定时数据落地，请设置对应的时间周期，单位为秒
    ],
    'CLUSTER' => [
        'enable' => false,
        'token' => null,
        'broadcastAddress' => ['255.255.255.255:9556'],
        'listenAddress' => '0.0.0.0',
        'listenPort' => '9556',
        'broadcastTTL' => 5,
        'nodeTimeout' => 10,
        'nodeName' => 'easySwoole',
        'nodeId' => null,
    ],

    #登录秘钥
    "SIGN" => [
        'secret' => 'LaravelChen',
        'iss' => 'http://127.0.0.1:9501',
        'aud' => 'http://localhost:3000',
        'exp' => time() + 60 * 60 * 60,
        'lose' => -1,
    ],
    'SALT' => "UmVwb3J0U2lnblZhbGlkYXRpb24=", #盐值（用于前后段分离的接口标识）
    'VERSION' => 'v1.0.0',  #接口版本

    #数据库
    'DATABASE' => [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'database' => 'swoole_framework',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
        'collation' => 'utf8_general_ci',
        'prefix' => '',
    ],
    'REDIS' => [
        'cluster' => false,
        'default' => [
            'host' => '127.0.0.1',
            'port' => 6379,
            'database' => 0,
        ],
    ],
];