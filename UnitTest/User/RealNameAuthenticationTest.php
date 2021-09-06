<?php

namespace UnitTest\User;

use RealNameAuthenticationModel;

/**
 * RealNameAuthenticationTest
 * Class RealNameAuthenticationTest
 * Create With ClassGeneration
 */
class RealNameAuthenticationTest extends UserBaseTestCase
{
	public $modelName = 'RealNameAuthentication';


	public function testAdd()
	{
		$data = [];
		$data['idCard'] = '测试文本1XRMfz';
		$data['realName'] = '测试文本4bUCjm';
		$response = $this->request('add',$data);
		$model = new RealNameAuthenticationModel();
		$model->destroy($response->result->userId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['idCard'] = '测试文本TtkfLQ';
		$data['realName'] = '测试文本qEhMSL';
		$model = new RealNameAuthenticationModel();
		$model->data($data)->save();

		$data = [];
		$data['userId'] = $model->userId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->userId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['idCard'] = '测试文本3ckAyB';
		$data['realName'] = '测试文本C3QiqE';
		$model = new RealNameAuthenticationModel();
		$model->data($data)->save();

		$update = [];
		$update['userId'] = $model->userId;
		$update['idCard'] = '测试文本eNpUW2';
		$update['realName'] = '测试文本wgJYZp';
		$response = $this->request('update',$update);
		$model->destroy($model->userId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new RealNameAuthenticationModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['idCard'] = '测试文本5i76BQ';
		$data['realName'] = '测试文本DsCv1M';
		$model = new RealNameAuthenticationModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userId'] = $model->userId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

