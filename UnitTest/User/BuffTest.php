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
		$data['name'] = '测试文本S6C7Lg';
		$data['code'] = '测试文本V0DgG3';
		$data['stackLayer'] = '34495';
		$data['entryCode'] = '测试文本MXj9JR';
		$data['param'] = '测试文本N5TaSA';
		$data['description'] = '测试文本8igftD';
		$response = $this->request('add',$data);
		$model = new BuffModel();
		$model->destroy($response->result->buffId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = '测试文本HOLEbu';
		$data['code'] = '测试文本C42gc9';
		$data['stackLayer'] = '26419';
		$data['entryCode'] = '测试文本JmSWj9';
		$data['param'] = '测试文本rnPBGv';
		$data['description'] = '测试文本Wyd7te';
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
		$data['name'] = '测试文本bXqvyO';
		$data['code'] = '测试文本JUy9CM';
		$data['stackLayer'] = '90243';
		$data['entryCode'] = '测试文本pYeZn5';
		$data['param'] = '测试文本jreRTO';
		$data['description'] = '测试文本T1qanR';
		$model = new BuffModel();
		$model->data($data)->save();

		$update = [];
		$update['buffId'] = $model->buffId;
		$update['name'] = '测试文本4z7hHR';
		$update['code'] = '测试文本JLWbAZ';
		$update['stackLayer'] = '19594';
		$update['entryCode'] = '测试文本K8VaSl';
		$update['param'] = '测试文本7uaPfI';
		$update['description'] = '测试文本hJK30F';
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
		$data['name'] = '测试文本4UuoBT';
		$data['code'] = '测试文本igIp9G';
		$data['stackLayer'] = '30891';
		$data['entryCode'] = '测试文本wlYOhb';
		$data['param'] = '测试文本aNApMd';
		$data['description'] = '测试文本5a8eEA';
		$model = new BuffModel();
		$model->data($data)->save();

		$delData = [];
		$delData['buffId'] = $model->buffId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

