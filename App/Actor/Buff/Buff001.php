<?php


namespace App\Actor\Buff;


class Buff001 extends BuffBean
{
    protected $buffName = "感电";
    protected $buffCode = '0001';
    protected $isDeBuff = 1;
    protected $level = 1;
    protected $buffLayer = 1;
    protected $maxBuffLayer = 1;
    protected $triggerType = '0';
    protected $triggerRate = 0;
    protected $coolingTime;
    protected $description = "感电";
    protected $expireType = 1;
    protected $expireTime = 0;
    protected $isExpire = false;
}
