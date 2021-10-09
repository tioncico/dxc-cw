<?php

namespace UnitTest\Admin\Cdk;

use EasySwoole\Utility\Random;
use UnitTest\Admin\AdminBaseTestCase;
use UserCdkReceiveModel;

/**
 * UserCdkReceiveTest
 * Class UserCdkReceiveTest
 * Create With ClassGeneration
 */
class UserCdkReceiveTest extends AdminBaseTestCase
{
	public $modelName = 'UserCdkReceive';


	public function testAdd()
	{
		$data = [];
		$data['userId'] = mt_rand(10000, 99999);
		$data['cdkId'] = mt_rand(10000, 99999);
		$data['addTime'] = mt_rand(10000, 99999);
		$response = $this->request('add',$data);
		$model = new UserCdkReceiveModel();
		$model->destroy($response->result->receiveId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['userId'] = mt_rand(10000, 99999);
		$data['cdkId'] = mt_rand(10000, 99999);
		$data['addTime'] = mt_rand(10000, 99999);
		$model = new UserCdkReceiveModel();
		$model->data($data)->save();

		$data = [];
		$data['receiveId'] = $model->receiveId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->receiveId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['userId'] = mt_rand(10000, 99999);
		$data['cdkId'] = mt_rand(10000, 99999);
		$data['addTime'] = mt_rand(10000, 99999);
		$model = new UserCdkReceiveModel();
		$model->data($data)->save();

		$update = [];
		$update['receiveId'] = $model->receiveId;
		$update['userId'] = mt_rand(10000, 99999);
		$update['cdkId'] = mt_rand(10000, 99999);
		$update['addTime'] = mt_rand(10000, 99999);
		$response = $this->request('update',$update);
		$model->destroy($model->receiveId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new UserCdkReceiveModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['userId'] = mt_rand(10000, 99999);
		$data['cdkId'] = mt_rand(10000, 99999);
		$data['addTime'] = mt_rand(10000, 99999);
		$model = new UserCdkReceiveModel();
		$model->data($data)->save();

		$delData = [];
		$delData['receiveId'] = $model->receiveId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

