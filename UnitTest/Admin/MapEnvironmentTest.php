<?php

namespace UnitTest\Admin;

use MapEnvironmentModel;

/**
 * MapEnvironmentTest
 * Class MapEnvironmentTest
 * Create With ClassGeneration
 */
class MapEnvironmentTest extends AdminBaseTestCase
{
	public $modelName = 'MapEnvironment';


	public function testAdd()
	{
		$data = [];
		$data['name'] = '测试文本biEDMn';
		$data['description'] = '测试文本juvbl2';
		$data['recommendedLevelValue'] = '测试文本zVlKtL';
		$data['isInstanceZone'] = '1';
		$response = $this->request('add',$data);
		$model = new MapEnvironmentModel();
		$model->destroy($response->result->mapEnvironmentId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = '测试文本wK9ZSv';
		$data['description'] = '测试文本iWepDM';
		$data['recommendedLevelValue'] = '测试文本amLw01';
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
		$data['name'] = '测试文本2yPhYI';
		$data['description'] = '测试文本oZJdAB';
		$data['recommendedLevelValue'] = '测试文本qNoUYf';
		$data['isInstanceZone'] = '1';
		$model = new MapEnvironmentModel();
		$model->data($data)->save();

		$update = [];
		$update['mapEnvironmentId'] = $model->mapEnvironmentId;
		$update['name'] = '测试文本2KUsDk';
		$update['description'] = '测试文本pwgQCE';
		$update['recommendedLevelValue'] = '测试文本9S6ANJ';
		$update['isInstanceZone'] = '3';
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
		$data['name'] = '测试文本4TbQ5x';
		$data['description'] = '测试文本GTghFx';
		$data['recommendedLevelValue'] = '测试文本BStk7V';
		$data['isInstanceZone'] = '1';
		$model = new MapEnvironmentModel();
		$model->data($data)->save();

		$delData = [];
		$delData['mapEnvironmentId'] = $model->mapEnvironmentId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

