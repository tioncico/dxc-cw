<?php

namespace UnitTest\Common\Task;

use App\Model\Game\Task\UserGameTaskMasterCompleteModel;
use EasySwoole\Utility\Random;
use UnitTest\Common\CommonBaseTest;

/**
 * UserGameTaskMasterCompleteTest
 * Class UserGameTaskMasterCompleteTest
 * Create With ClassGeneration
 */
class UserGameTaskMasterCompleteTest extends CommonBaseTest
{
	public $modelName = '/Api/Common/Task/UserGameTaskMasterComplete';


	public function testAdd()
	{
		$data = [];
		$data['taskMasterId'] = mt_rand(10000, 99999);
		$data['nowTaskId'] = mt_rand(10000, 99999);
		$response = $this->request('add',$data);
		$model = new UserGameTaskMasterCompleteModel();
		$model->destroy($response->result->userId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['taskMasterId'] = mt_rand(10000, 99999);
		$data['nowTaskId'] = mt_rand(10000, 99999);
		$model = new UserGameTaskMasterCompleteModel();
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
		$data['taskMasterId'] = mt_rand(10000, 99999);
		$data['nowTaskId'] = mt_rand(10000, 99999);
		$model = new UserGameTaskMasterCompleteModel();
		$model->data($data)->save();

		$update = [];
		$update['userId'] = $model->userId;
		$update['taskMasterId'] = mt_rand(10000, 99999);
		$update['nowTaskId'] = mt_rand(10000, 99999);
		$response = $this->request('update',$update);
		$model->destroy($model->userId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new UserGameTaskMasterCompleteModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['taskMasterId'] = mt_rand(10000, 99999);
		$data['nowTaskId'] = mt_rand(10000, 99999);
		$model = new UserGameTaskMasterCompleteModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userId'] = $model->userId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

