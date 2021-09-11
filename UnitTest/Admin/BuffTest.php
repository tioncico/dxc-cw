<?php

namespace UnitTest\Admin;

use BuffModel;

/**
 * BuffTest
 * Class BuffTest
 * Create With ClassGeneration
 */
class BuffTest extends AdminBaseTestCase
{
	public $modelName = 'Buff';


	public function testAdd()
	{
		$data = [];
		$data['name'] = '测试文本H5kye7';
		$data['isDeBuff'] = '3';
		$data['code'] = '测试文本76HudZ';
		$data['stackLayer'] = '73017';
		$data['entryCode'] = '测试文本xdFXIw';
		$data['param'] = '测试文本p2D8oW';
		$data['type'] = '54966';
		$data['description'] = '测试文本om1MsF';
		$data['expireType'] = '18546';
		$data['expireTime'] = '29159';
		$response = $this->request('add',$data);
		$model = new BuffModel();
		$model->destroy($response->result->buffId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = '测试文本9uxeOX';
		$data['isDeBuff'] = '3';
		$data['code'] = '测试文本PxsXe9';
		$data['stackLayer'] = '27395';
		$data['entryCode'] = '测试文本nZiQEw';
		$data['param'] = '测试文本UHJG7V';
		$data['type'] = '53436';
		$data['description'] = '测试文本tZd9De';
		$data['expireType'] = '53857';
		$data['expireTime'] = '20326';
		$model = new BuffModel();
		$model->data($data)->save();

		$data = [];
		$data['buffId'] = $model->buffId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->buffId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['name'] = '测试文本PaQcRy';
		$data['isDeBuff'] = '1';
		$data['code'] = '测试文本AxuiST';
		$data['stackLayer'] = '60219';
		$data['entryCode'] = '测试文本iyXRjG';
		$data['param'] = '测试文本lj6NJd';
		$data['type'] = '65583';
		$data['description'] = '测试文本VJ25Lm';
		$data['expireType'] = '80303';
		$data['expireTime'] = '68939';
		$model = new BuffModel();
		$model->data($data)->save();

		$update = [];
		$update['buffId'] = $model->buffId;
		$update['name'] = '测试文本cfh4u0';
		$update['isDeBuff'] = '3';
		$update['code'] = '测试文本J8LdoA';
		$update['stackLayer'] = '15850';
		$update['entryCode'] = '测试文本8h0eSZ';
		$update['param'] = '测试文本7EU81l';
		$update['type'] = '32569';
		$update['description'] = '测试文本vKyrUl';
		$update['expireType'] = '41410';
		$update['expireTime'] = '94241';
		$response = $this->request('update',$update);
		$model->destroy($model->buffId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new BuffModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['name'] = '测试文本NkBYJX';
		$data['isDeBuff'] = '1';
		$data['code'] = '测试文本pL1mqk';
		$data['stackLayer'] = '89567';
		$data['entryCode'] = '测试文本R2zHLB';
		$data['param'] = '测试文本RfqoF4';
		$data['type'] = '59239';
		$data['description'] = '测试文本awyvdz';
		$data['expireType'] = '23761';
		$data['expireTime'] = '47492';
		$model = new BuffModel();
		$model->data($data)->save();

		$delData = [];
		$delData['buffId'] = $model->buffId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

