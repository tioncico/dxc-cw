<?php
/**
 * Created by PhpStorm.
 * User: fushu
 * Date: 2021/4/15
 * Time: 17:50
 */

namespace UnitTest\Common;


class AreaTest extends CommonBaseTest
{

    protected $modelName = 'Area';

    public function testGetAll()
    {
        $data = [

        ];
        $this->request('getArea', $data);
    }

    public function testExport()
    {
        $data = [

        ];
        $this->request('export', $data);
    }
    public function testGetNameByCode()
    {
        $data = [
            'code'=>'350203'
        ];
        $rs =$this->request('getNameByCode', $data);
        var_dump($rs);
    }

}