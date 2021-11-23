<?php


namespace UnitTest;


use EasySwoole\HttpClient\HttpClient;
use Swoole\Coroutine\System;

class WebSocket
{
    protected $wsClient;

    public function __construct()
    {
        $this->wsClient = new HttpClient('127.0.0.1:9501');
        $this->wsClient->setUrl('ws://127.0.0.1:9501?userId=1');

        $this->wsClient->upgrade();
        $this->recv();
    }

    public function intoMap()
    {
        $data = [
            'action' => 'intoMap',
            'mapId'  => 1,
        ];
        $this->push($data);
        sleep(1);
//        $this->fight();
    }

    public function getMapActorId()
    {
        $data = ['action' => 'getMapActorId'];
        $this->push($data);
    }

    public function fight()
    {
        $data = ['action' => 'fight','x'=>0,'y'=>0];
        $this->push($data);
    }

    public function mapInfo()
    {
        $data = ['action' => 'mapInfo'];
        $this->push($data);
    }

    public function userInfo()
    {
        $data = ['action' => 'userInfo'];
        $this->push($data);
    }
    public function useGoods()
    {
        $data = ['action' => 'useGoods','goodsCode'=>'prop0001'];
        $this->push($data);
    }

    public function nextLevelMap()
    {
        $data = ['action' => 'nextLevelMap'];
        $this->push($data);
    }

    public function exitMap()
    {
        $data = ['action' => 'exitMap'];
        $this->push($data);
    }
    public function useSkill0002()
    {
        $data = ['action' => 'useSkill', 'skillCode' => '0007'];
        $this->push($data);
    }

    public function useSkill0003()
    {
        $data = ['action' => 'useSkill', 'skillCode' => '0003'];
        $this->push($data);
    }

    public function useSkill0004()
    {
        $data = ['action' => 'useSkill', 'skillCode' => '0004'];
        $this->push($data);
    }

    public function useSkill0005()
    {
        $data = ['action' => 'useSkill', 'skillCode' => '0005'];
        $this->push($data);
    }

    public function useSkill0006()
    {
        $data = ['action' => 'useSkill', 'skillCode' => '0006'];
        $this->push($data);
    }

    public function console()
    {
        while (1) {
            echo "请输入命令:";
            try {
                $line = trim(System::fread(STDIN));
                if (!empty($line)) {

                    $this->$line();
                }
            } catch (\Throwable $throwable) {
                echo $throwable->getMessage() . PHP_EOL;
            }
            \co::sleep(1);
        }

    }

    public function push($data)
    {
        $data['requestId'] = time();
        var_dump(json_encode($data));
        $this->wsClient->push(json_encode($data));
    }

    public function recv()
    {
        go(function () {
            while (1) {
                $response = $this->wsClient->recv(0);
                if ($response) {
                    echo json_encode(json_decode($response->data, true), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ) . PHP_EOL;
                }
                if ($response===false){
                    break;
                }
            }
            \co::sleep(0.1);
        });
    }


}
