<?php

namespace UnitTest\User;

use MapEnvironmentModel;

/**
 * MapEnvironmentTest
 * Class MapEnvironmentTest
 * Create With ClassGeneration
 */
class MapEnvironmentTest extends UserBaseTestCase
{
	public $modelName = 'MapEnvironment';


	public function testAdd()
	{
		$data = [];
		$data['name'] = '测试文本A83oTb';
		$data['description'] = '测试文本oBA7v1';
		$data['recommendedLevelValue'] = '测试文本8uOE4k';
		$data['isInstanceZone'] = '3';
		$response = $this->request('add',$data);
		$model = new MapEnvironmentModel();
		$model->destroy($response->result->mapEnvironmentId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = '测试文本xL3rA6';
		$data['description'] = '测试文本JSRG69';
		$data['recommendedLevelValue'] = '测试文本TEye93';
		$data['isInstanceZone'] = '3';
		$model = new MapEnvironmentModel();
		$model->data($data)->save();

		$data = [];
		$data['mapEnvironmentId'] = $model->mapEnvironmentId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->mapEnvironmentId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['name'] = '测试文本A8vBPT';
		$data['description'] = '测试文本WdOiLR';
		$data['recommendedLevelValue'] = '测试文本KFgHcJ';
		$data['isInstanceZone'] = '2';
		$model = new MapEnvironmentModel();
		$model->data($data)->save();

		$update = [];
		$update['mapEnvironmentId'] = $model->mapEnvironmentId;
		$update['name'] = '测试文本8beRpQ';
		$update['description'] = '测试文本Wpf8y2';
		$update['recommendedLevelValue'] = '测试文本gOnpF2';
		$update['isInstanceZone'] = '0';
		$response = $this->request('update',$update);
		$model->destroy($model->mapEnvironmentId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new MapEnvironmentModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['name'] = '测试文本XdWnN7';
		$data['description'] = '测试文本CFGMxN';
		$data['recommendedLevelValue'] = '测试文本e5v4Mj';
		$data['isInstanceZone'] = '1';
		$model = new MapEnvironmentModel();
		$model->data($data)->save();

		$delData = [];
		$delData['mapEnvironmentId'] = $model->mapEnvironmentId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

