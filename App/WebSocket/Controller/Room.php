<?php


namespace App\WebSocket\Controller;


use App\Model\AuctionModel;
use App\Model\AuctionPriceLogModel;
use App\Model\BaseModel;
use App\Model\Script\PropModel;
use App\Model\Script\RoomModel;
use App\Model\Script\RoomPropModel;
use App\Model\Script\RoomUserModel;
use App\Model\Script\ScriptModel;
use App\WebSocket\Cache\RoomUserMap;
use App\WebSocket\Cache\UserFdMap;
use App\WebSocket\Command;
use App\WebSocket\MsgPushEvent;
use App\WebSocket\Push;
use EasySwoole\EasySwoole\ServerManager;
use EasySwoole\EasySwoole\Task\TaskManager;
use EasySwoole\Http\Message\Status;
use EasySwoole\Log\Logger;
use EasySwoole\Socket\AbstractInterface\Controller;
use EasySwoole\Socket\Bean\Response;
use function AlibabaCloud\Client\value;

class Room extends Controller
{
    const CODE = [


    ];

    public function test()
    {
        $this->pushAll([
            'msg' => '{"roomuser":[{"id":222,"room_id":175,"user_id":4,"is_create":1,"status":1,"create_time":1627550791,"vote_status":0,"vote_time":0,"to_user_id":0,"to_time":0,"room_status":1,"is_look":0,"req_time":1627551041},{"id":226,"room_id":175,"user_id":12,"is_create":0,"status":0,"create_time":1627551041,"vote_status":0,"vote_time":0,"to_user_id":0,"to_time":0,"room_status":1,"is_look":0,"req_time":1627551041}]}',
            'op'  => 'roomUserInfo',
        ]);
    }


    function pushAll($data)
    {
        $server = ServerManager::getInstance()->getSwooleServer();
        $fdList = $server->getClientList();
        foreach ($fdList as $value) {
            $server->push($value, json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        }
    }

    protected function setMessage($data)
    {
        $this->response()->setMessage(json_encode($data));
    }

    public function roomUserInfoNotify()
    {
        \EasySwoole\EasySwoole\Logger::getInstance()->log("roomUserInfoNotify");
        $action = 'roomUserInfo';
        $param = $this->caller()->getArgs();
        $roomId = $param['room_id'];
        $roomUserList = RoomUserModel::create()->with(['userInfo'], false)->order('create_time', 'ASC')->all(['room_id' => $roomId]);
        $roomInfo = RoomModel::create()->get($roomId);
        $scriptInfo = ScriptModel::create()->get($roomInfo->script_id);

        if ($param['user_id']==$roomInfo->create_id && !empty($param['room_page'])) {
            $roomInfo->update(['room_page'=>$param['room_page']]);
        }

        $userList = [];
        foreach ($roomUserList as $key => $user) {
            $value = $user->toArray();
            $userList[$key] = $value;
            $userList[$key]['head'] = $user->userInfo['avatarUrl'];
            $userList[$key]['name'] = $user->userInfo['nickName'];
        }
        foreach ($roomUserList as $roomUser) {
            MsgPushEvent::getInstance()->msgPush($action, $roomUser->user_id, ['roomuser' => $userList, 'room' => $roomInfo, 'script' => $scriptInfo]);
        }
//        'room'=>$room,'script'=>$script,'roomuser'=>$room_user
    }

    public function roomPropListNotify()
    {
        $param = $this->caller()->getArgs();
        $param['user_id'] = UserFdMap::getInstance()->getFdUserId($this->caller()->getClient()->getFd());
        $action = 'roomPropInfo';

        $model = RoomPropModel::create();
        // 我自己获取的道具
        $my_prop_list = $model->with(['propInfo'], false)->where("status = 1 and room_id = '{$param['room_id']}' and user_id = '{$param['user_id']}'")->order( 'create_time','DESC')->all();
        $public_prop_list =  $model->with(['propInfo'], false)->where("room_id = '{$param['room_id']}' and user_id <> '{$param['user_id']}'  and  is_open = 1")->order( 'create_time','desc')->all();

        $roomPropList = [];

        $propRegionList = [];
        foreach (array_merge($my_prop_list,$public_prop_list) as $v){
            $v = $v->toArray(null, false);
            $region_id = $v['propInfo']['region_id'];
            if (!isset($propList[$v['propInfo']['s_prop.id']])){
                if (empty($param['region_id'])){
                    $roomPropList[$v['propInfo']['s_prop.id']] = $v['propInfo'];
                }else{
                    if ($param['region_id']==$region_id) {
                        $roomPropList[$v['propInfo']['s_prop.id']] = $v['propInfo'];
                    }
                }
            }
            if (!isset($propRegionList[$region_id])){
                $propRegionList[$region_id] = [
                    'id'=>$region_id,
                    'title'=>$v['propInfo']['region_name'],
                    'self_num'=>1,
                    'all_num'=>PropModel::create()->where(['status'=>1,'region_id'=>$region_id])->count()
                ];
            }else{
                $propRegionList[$region_id]['self_num']++;
            }
        }
        $propRegionList = array_values($propRegionList);
        // 公开线索小喇叭
        $roomList = RoomPropModel::create()->with(['userInfo','propInfo'],false)->where("open_time > 0 and room_id ='{$param['room_id']}' ")->order('open_time', 'asc')->all();
        $message = [];
        if (count($roomList) > 0) {
            foreach ($roomList as $k => $v) {
                $message[$k] = $v->toArray();
                $message[$k]['username'] = $v->userInfo->nickName;
                $message[$k]['proptitle'] = $v->propInfo->title;
            }
        }
        \EasySwoole\EasySwoole\Logger::getInstance()->log(json_encode(['region' => $propRegionList, 'prop' => $roomPropList, 'message' => $message],JSON_UNESCAPED_UNICODE));
//        var_dump(json_encode(['region' => $propRegionList, 'prop' => $roomPropList, 'message' => $message],JSON_UNESCAPED_UNICODE));
        MsgPushEvent::getInstance()->msgPush($action, $param['user_id'], ['region' => $propRegionList, 'prop' => $roomPropList, 'message' => $message]);
    }

    /**
     * 房间加入请求
     * roomJoin
     * @author tioncico
     * Time: 4:14 下午
     */
    public function roomJoin()
    {
//        $action = 'roomJoinResponse';
//        $param = $this->caller()->getArgs();
//        $script_id = $param['script_id'];
//        $scriptInfo = ScriptModel::create()->get($script_id);
//        if (empty($scriptInfo)) {
//            $this->response()->setMessage(json_encode(['code'=>2,'action'=>$action,'msg'=>'剧本数据不存在']));
//        }
//
//        $userId = UserFdMap::getInstance()->getFdUserId($this->caller()->getClient()->getFd());
//        // is_stranger
//        // 首先遍历 未满 未消亡 允许陌生人进入的房间
//        $where['s_room.status'] = 1; // 房间状态 1未满 2已满 3 游戏中4 消亡
//        $where['s_room.is_stranger'] = 1;
//        $where['s_room.script_id'] = $script_id;
//        //查询人数未满并且房间里没有用户的房间
//       $roomUserInfo =  RoomUserModel::create()->where($where)
//           ->join('s_room','s_room_user.room_id=s_room.id')
//           ->where('s_room_user.user_id <> '.$userId)
//           ->order('s_room.id','ASC')
//           ->get();
//
//        if (empty($roomUserInfo)) {
//            $this->response()->setMessage(json_encode(['code'=>2,'action'=>$action,'msg'=>'暂无未满房间可加入']));
//            return;
//        }
//        $room_user = [];
//        $room_user['user_id'] = $userId;
//        $room_user['room_id'] =$roomUserInfo->room_id;
//        $room_user['create_time'] = time();
//        $room_user['req_time'] = time();
//        RoomUserModel::create($room_user)->save();
//        if (RoomUserModel::create()->where('room_id',$roomUserInfo['room_id'])->count()>=$scriptInfo->number){
//            RoomModel::create()->where('room_id',$roomUserInfo['room_id'])->update( ['status'=>2]);
//        }
//        $this->response()->setMessage(json_encode(['code'=>2,'action'=>$action,'room_id'=>$roomUserInfo['room_id']]));
    }
}
