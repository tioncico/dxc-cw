<?php

namespace UnitTest\Admin;

use EasySwoole\Utility\Random;
use GameVersionModel;

/**
 * GameVersionTest
 * Class GameVersionTest
 * Create With ClassGeneration
 */
class GameVersionTest extends AdminBaseTestCase
{
	public $modelName = 'GameVersion';


	public function testAdd()
	{
		$data = [];
		$data['versionId'] = mt_rand(10000, 99999);
		$data['description'] = "测试文本".Random::character(6);
		$data['addTime'] = mt_rand(10000, 99999);
		$data['url'] = "测试文本".Random::character(6);
		$response = $this->request('add',$data);
		$model = new GameVersionModel();
		$model->destroy($response->result->id);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['versionId'] = mt_rand(10000, 99999);
		$data['description'] = "测试文本".Random::character(6);
		$data['addTime'] = mt_rand(10000, 99999);
		$data['url'] = "测试文本".Random::character(6);
		$model = new GameVersionModel();
		$model->data($data)->save();

		$data = [];
		$data['id'] = $model->id;
		$response = $this->request('getOne',$data);
		$model->destroy($model->id);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['versionId'] = mt_rand(10000, 99999);
		$data['description'] = "测试文本".Random::character(6);
		$data['addTime'] = mt_rand(10000, 99999);
		$data['url'] = "测试文本".Random::character(6);
		$model = new GameVersionModel();
		$model->data($data)->save();

		$update = [];
		$update['id'] = $model->id;
		$update['versionId'] = mt_rand(10000, 99999);
		$update['description'] = "测试文本".Random::character(6);
		$update['addTime'] = mt_rand(10000, 99999);
		$update['url'] = "测试文本".Random::character(6);
		$response = $this->request('update',$update);
		$model->destroy($model->id);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new GameVersionModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['versionId'] = mt_rand(10000, 99999);
		$data['description'] = "测试文本".Random::character(6);
		$data['addTime'] = mt_rand(10000, 99999);
		$data['url'] = "测试文本".Random::character(6);
		$model = new GameVersionModel();
		$model->data($data)->save();

		$delData = [];
		$delData['id'] = $model->id;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

