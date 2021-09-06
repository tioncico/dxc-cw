<?php

namespace UnitTest\Admin;

use RealNameAuthenticationModel;

/**
 * RealNameAuthenticationTest
 * Class RealNameAuthenticationTest
 * Create With ClassGeneration
 */
class RealNameAuthenticationTest extends AdminBaseTestCase
{
	public $modelName = 'RealNameAuthentication';


	public function testAdd()
	{
		$data = [];
		$data['idCard'] = '测试文本IeDB7K';
		$data['realName'] = '测试文本FqBjxP';
		$response = $this->request('add',$data);
		$model = new RealNameAuthenticationModel();
		$model->destroy($response->result->userId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['idCard'] = '测试文本W8aKV4';
		$data['realName'] = '测试文本w2YbPG';
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
		$data['idCard'] = '测试文本f4IT8K';
		$data['realName'] = '测试文本BTF823';
		$model = new RealNameAuthenticationModel();
		$model->data($data)->save();

		$update = [];
		$update['userId'] = $model->userId;
		$update['idCard'] = '测试文本epoj7b';
		$update['realName'] = '测试文本fpLsMT';
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
		$data['idCard'] = '测试文本ireIZq';
		$data['realName'] = '测试文本gtYEVa';
		$model = new RealNameAuthenticationModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userId'] = $model->userId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

