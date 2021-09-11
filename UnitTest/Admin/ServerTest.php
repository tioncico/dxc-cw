<?php

namespace UnitTest\Admin;

use App\Model\ServerModel;

/**
 * ServerTest
 * Class ServerTest
 * Create With ClassGeneration
 */
class ServerTest extends AdminBaseTestCase
{
	public $modelName = '/Api/Admin/Server';


	public function testAdd()
	{
		$data = [];
		$data['serverName'] = '测试文本7sdzRG';
		$data['isAllowRegister'] = '0';
		$data['serverHost'] = '测试文本oa2zKG';
		$response = $this->request('add',$data);
		$model = new ServerModel();
		$model->destroy($response->result->serverId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['serverName'] = '测试文本tAkxKq';
		$data['isAllowRegister'] = '0';
		$data['serverHost'] = '测试文本EDwygl';
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
		$data['serverName'] = '测试文本tS7fsc';
		$data['isAllowRegister'] = '2';
		$data['serverHost'] = '测试文本38vcCr';
		$model = new ServerModel();
		$model->data($data)->save();

		$update = [];
		$update['serverId'] = $model->serverId;
		$update['serverName'] = '测试文本DyQR2E';
		$update['isAllowRegister'] = '0';
		$update['serverHost'] = '测试文本3Yn1Ao';
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
		$data['serverName'] = '测试文本sozGnE';
		$data['isAllowRegister'] = '1';
		$data['serverHost'] = '测试文本f1jqF3';
		$model = new ServerModel();
		$model->data($data)->save();

		$delData = [];
		$delData['serverId'] = $model->serverId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

