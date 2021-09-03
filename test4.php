<?php

/**
 * Created by PhpStorm.
 * User: tioncico
 * Date: 2020-05-20
 * Time: 10:26
 */
include "./vendor/autoload.php";
\EasySwoole\EasySwoole\Core::getInstance()->initialize();

use \App\Service\Game\Attribute;
use \App\Service\Game\Fight\Fight;
use \App\Actor\MapActor;

go(function () {
    $data = [
        'action'  => 'accessMap',
        'content' => [
            'mapId' => 1,
        ],
    ];
    echo json_encode($data);

    \Swoole\Timer::clearAll();
});
