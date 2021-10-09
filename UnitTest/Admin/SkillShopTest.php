<?php

namespace UnitTest\Admin;

use EasySwoole\Utility\Random;
use SkillShopModel;

/**
 * SkillShopTest
 * Class SkillShopTest
 * Create With ClassGeneration
 */
class SkillShopTest extends AdminBaseTestCase
{
	public $modelName = 'SkillShop';


	public function testAdd()
	{
		$data = [];
		$data['skillId'] = mt_rand(10000, 99999);
		$data['skillName'] = "测试文本".Random::character(6);
		$response = $this->request('add',$data);
		$model = new SkillShopModel();
		$model->destroy($response->result->skillShopId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['skillId'] = mt_rand(10000, 99999);
		$data['skillName'] = "测试文本".Random::character(6);
		$model = new SkillShopModel();
		$model->data($data)->save();

		$data = [];
		$data['skillShopId'] = $model->skillShopId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->skillShopId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['skillId'] = mt_rand(10000, 99999);
		$data['skillName'] = "测试文本".Random::character(6);
		$model = new SkillShopModel();
		$model->data($data)->save();

		$update = [];
		$update['skillShopId'] = $model->skillShopId;
		$update['skillId'] = mt_rand(10000, 99999);
		$update['skillName'] = "测试文本".Random::character(6);
		$response = $this->request('update',$update);
		$model->destroy($model->skillShopId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new SkillShopModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['skillId'] = mt_rand(10000, 99999);
		$data['skillName'] = "测试文本".Random::character(6);
		$model = new SkillShopModel();
		$model->data($data)->save();

		$delData = [];
		$delData['skillShopId'] = $model->skillShopId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

