<?php

namespace UnitTest\User;

use BuffModel;

/**
 * BuffTest
 * Class BuffTest
 * Create With ClassGeneration
 */
class BuffTest extends UserBaseTestCase
{
	public $modelName = 'Buff';


	public function testAdd()
	{
		$data = [];
		$data['name'] = '测试文本PG8dLr';
		$data['code'] = '测试文本VFYdW1';
		$data['stackLayer'] = '60306';
		$data['entryCode'] = '测试文本bHZICy';
		$data['param'] = '测试文本mUk2dz';
		$data['type'] = '31245';
		$data['description'] = '测试文本kFctZ3';
		$response = $this->request('add',$data);
		$model = new BuffModel();
		$model->destroy($response->result->buffId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = '测试文本VUuC7D';
		$data['code'] = '测试文本t6Egp9';
		$data['stackLayer'] = '62219';
		$data['entryCode'] = '测试文本FI2LVT';
		$data['param'] = '测试文本fiyGJd';
		$data['type'] = '54324';
		$data['description'] = '测试文本Z6P9eH';
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
		$data['name'] = '测试文本VzM0mF';
		$data['code'] = '测试文本FNepl1';
		$data['stackLayer'] = '26140';
		$data['entryCode'] = '测试文本8Y4rzl';
		$data['param'] = '测试文本O5YDUP';
		$data['type'] = '17871';
		$data['description'] = '测试文本ngmUBM';
		$model = new BuffModel();
		$model->data($data)->save();

		$update = [];
		$update['buffId'] = $model->buffId;
		$update['name'] = '测试文本raM1Bc';
		$update['code'] = '测试文本PVioO2';
		$update['stackLayer'] = '61723';
		$update['entryCode'] = '测试文本5rfiNX';
		$update['param'] = '测试文本hJIRc0';
		$update['type'] = '65106';
		$update['description'] = '测试文本AlnD5z';
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
		$data['name'] = '测试文本VBsjlC';
		$data['code'] = '测试文本GRVdFp';
		$data['stackLayer'] = '80327';
		$data['entryCode'] = '测试文本TZBfFX';
		$data['param'] = '测试文本0LJGTE';
		$data['type'] = '25624';
		$data['description'] = '测试文本dIBPVR';
		$model = new BuffModel();
		$model->data($data)->save();

		$delData = [];
		$delData['buffId'] = $model->buffId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

