<?php
/**
 * Created by PhpStorm.
 * User: fushu
 * Date: 2021/4/15
 * Time: 17:50
 */

namespace UnitTest\Common;


use App\Utility\Sms;

class VerifyCodeTest extends CommonBaseTest
{

    protected $modelName = 'VerifyCode';

    public function testSmsVerifyCode()
    {
        $data = [
            'phone' => '18459537313'
        ];
        $data = $this->request('smsVerifyCode', $data);
        var_dump($data);
    }
}
