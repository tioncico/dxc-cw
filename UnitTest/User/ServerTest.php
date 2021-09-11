<?php

namespace UnitTest\User;

use App\Model\ServerModel;

/**
 * ServerTest
 * Class ServerTest
 * Create With ClassGeneration
 */
class ServerTest extends UserBaseTestCase
{
	public $modelName = '/Api/User/Server';


	public function testAdd()
	{
		$data = [];
		$data['serverName'] = '测试文本FQOGfw';
		$data['isAllowRegister'] = '1';
		$data['serverHost'] = '测试文本Dzb2Gu';
		$response = $this->request('add',$data);
		$model = new ServerModel();
		$model->destroy($response->result->serverId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['serverName'] = '测试文本PW1BEG';
		$data['isAllowRegister'] = '0';
		$data['serverHost'] = '测试文本YV1Txy';
		$model = new ServerModel();
		$model->data($data)->save();

		$data = [];
		$data['serverId'] = $model->serverId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->serverId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['serverName'] = '测试文本GMbzHZ';
		$data['isAllowRegister'] = '1';
		$data['serverHost'] = '测试文本RnXsIq';
		$model = new ServerModel();
		$model->data($data)->save();

		$update = [];
		$update['serverId'] = $model->serverId;
		$update['serverName'] = '测试文本YaK2VI';
		$update['isAllowRegister'] = '1';
		$update['serverHost'] = '测试文本mM1lkS';
		$response = $this->request('update',$update);
		$model->destroy($model->serverId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new ServerModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['serverName'] = '测试文本572chz';
		$data['isAllowRegister'] = '2';
		$data['serverHost'] = '测试文本w3SsUE';
		$model = new ServerModel();
		$model->data($data)->save();

		$delData = [];
		$delData['serverId'] = $model->serverId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

