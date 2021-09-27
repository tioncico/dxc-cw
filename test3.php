<?php

/**
 * Created by PhpStorm.
 * User: tioncico
 * Date: 2020-05-20
 * Time: 10:26
 */
include "./vendor/autoload.php";
\EasySwoole\EasySwoole\Core::getInstance()->initialize();

use App\Actor\UserActor;
use App\Model\Game\GoodsEquipmentModel;
use App\Model\Game\Task\GameTaskMasterModel;
use \App\Service\Game\Attribute;
use \App\Service\Game\Fight\Fight;
use \App\Actor\MapActor;
use EasySwoole\Actor\Actor;

go(function () {

    $model = new GameTaskMasterModel();

    $data = $model->with(['userTaskCompleteInfo' => 1], false)->order('`order`','asc')->getList(1, 9999);

    /**
     * @var $masterInfo GameTaskMasterModel
     */
    foreach ($data['list'] as $key => $masterInfo) {
        $taskModel = new \App\Model\Game\Task\GameTaskModel();
        $taskList = $taskModel->with(['goodsList'], false)->order('`order`','asc')->where('taskMasterId',$masterInfo->taskMasterId)->all();
        $data['list'][$key]['taskList'] = json_decode(json_encode($taskList),1);
    }
    var_dump(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    \Swoole\Timer::clearAll();
});
