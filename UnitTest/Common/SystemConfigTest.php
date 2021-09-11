<?php
/**
 * Created by PhpStorm.
 * User: fushu
 * Date: 2021/4/15
 * Time: 17:50
 */

namespace UnitTest\Common;


class SystemConfigTest extends CommonBaseTest
{

    protected $modelName = 'SystemConfig';

    public function testGetWeddingGiftSetting()
    {
        $rs = $this->request('getWeddingGiftSetting');
//        var_dump($rs);
        var_dump(json_encode($rs, JSON_UNESCAPED_UNICODE));

    }
    public function testGetAppConfigSetting()
    {
        $rs = $this->request('getAppConfigSetting');
//        var_dump($rs);
        var_dump(json_encode($rs, JSON_UNESCAPED_UNICODE));

    }

    public function testGetWalletSetting()
    {
        $rs = $this->request('getWalletSetting');
//        var_dump($rs);
        var_dump(json_encode($rs, JSON_UNESCAPED_UNICODE));

    }
}
