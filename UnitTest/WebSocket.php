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
    }

    public function getMapActorId()
    {
        $data = ['action' => 'getMapActorId'];
        $this->push($data);
    }

    public function fight()
    {
        $data = ['action' => 'fight'];
        $this->push($data);
    }

    public function mapInfo()
    {
        $data = ['action' => 'mapInfo'];
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

        $this->wsClient->push(json_encode($data));
    }

    public function recv()
    {
        go(function () {
            while (1) {
                $data = $this->wsClient->recv(0);
                echo $data . PHP_EOL;
            }
            \co::sleep(0.1);
        });
    }


}
