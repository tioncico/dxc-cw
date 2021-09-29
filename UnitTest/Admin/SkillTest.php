<?php

namespace UnitTest\Admin;

use EasySwoole\Utility\Random;
use SkillModel;

/**
 * SkillTest
 * Class SkillTest
 * Create With ClassGeneration
 */
class SkillTest extends AdminBaseTestCase
{
	public $modelName = 'Skill';


	public function testAdd()
	{
		$data = [];
		$data['name'] = "测试文本".Random::character(6);
		$data['level'] = mt_rand(10000, 99999);
		$data['type'] = mt_rand(0, 3);
		$data['rarityLevel'] = mt_rand(10000, 99999);
		$data['maxLevel'] = mt_rand(10000, 99999);
		$data['coolingTime'] = mt_rand(10000, 99999);
		$data['manaCost'] = "测试文本".Random::character(6);
		$data['entryCode'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['param'] = "测试文本".Random::character(6);
		$data['paramNum'] = mt_rand(10000, 99999);
		$response = $this->request('add',$data);
		$model = new SkillModel();
		$model->destroy($response->result->skillId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = "测试文本".Random::character(6);
		$data['level'] = mt_rand(10000, 99999);
		$data['type'] = mt_rand(0, 3);
		$data['rarityLevel'] = mt_rand(10000, 99999);
		$data['maxLevel'] = mt_rand(10000, 99999);
		$data['coolingTime'] = mt_rand(10000, 99999);
		$data['manaCost'] = "测试文本".Random::character(6);
		$data['entryCode'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['param'] = "测试文本".Random::character(6);
		$data['paramNum'] = mt_rand(10000, 99999);
		$model = new SkillModel();
		$model->data($data)->save();

		$data = [];
		$data['skillId'] = $model->skillId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->skillId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['name'] = "测试文本".Random::character(6);
		$data['level'] = mt_rand(10000, 99999);
		$data['type'] = mt_rand(0, 3);
		$data['rarityLevel'] = mt_rand(10000, 99999);
		$data['maxLevel'] = mt_rand(10000, 99999);
		$data['coolingTime'] = mt_rand(10000, 99999);
		$data['manaCost'] = "测试文本".Random::character(6);
		$data['entryCode'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['param'] = "测试文本".Random::character(6);
		$data['paramNum'] = mt_rand(10000, 99999);
		$model = new SkillModel();
		$model->data($data)->save();

		$update = [];
		$update['skillId'] = $model->skillId;
		$update['name'] = "测试文本".Random::character(6);
		$update['level'] = mt_rand(10000, 99999);
		$update['type'] = mt_rand(0, 3);
		$update['rarityLevel'] = mt_rand(10000, 99999);
		$update['maxLevel'] = mt_rand(10000, 99999);
		$update['coolingTime'] = mt_rand(10000, 99999);
		$update['manaCost'] = "测试文本".Random::character(6);
		$update['entryCode'] = "测试文本".Random::character(6);
		$update['description'] = "测试文本".Random::character(6);
		$update['param'] = "测试文本".Random::character(6);
		$update['paramNum'] = mt_rand(10000, 99999);
		$response = $this->request('update',$update);
		$model->destroy($model->skillId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new SkillModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['name'] = "测试文本".Random::character(6);
		$data['level'] = mt_rand(10000, 99999);
		$data['type'] = mt_rand(0, 3);
		$data['rarityLevel'] = mt_rand(10000, 99999);
		$data['maxLevel'] = mt_rand(10000, 99999);
		$data['coolingTime'] = mt_rand(10000, 99999);
		$data['manaCost'] = "测试文本".Random::character(6);
		$data['entryCode'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['param'] = "测试文本".Random::character(6);
		$data['paramNum'] = mt_rand(10000, 99999);
		$model = new SkillModel();
		$model->data($data)->save();

		$delData = [];
		$delData['skillId'] = $model->skillId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

