<?php

namespace UnitTest\User;

use App\Model\Game\SkillModel;
use EasySwoole\Utility\Random;

/**
 * SkillTest
 * Class SkillTest
 * Create With ClassGeneration
 */
class SkillTest extends UserBaseTestCase
{
	public $modelName = '/Api/User/Skill';


	public function testAdd()
	{
		$data = [];
		$data['name'] = "测试文本".Random::character(6);
		$data['level'] = mt_rand(10000, 99999);
		$data['triggerType'] = mt_rand(0, 3);
		$data['triggerRate'] = "测试文本".Random::character(6);
		$data['rarityLevel'] = mt_rand(10000, 99999);
		$data['maxLevel'] = mt_rand(10000, 99999);
		$data['coolingTime'] = mt_rand(10000, 99999);
		$data['manaCost'] = "测试文本".Random::character(6);
		$data['entryCode'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['effectParam'] = "测试文本".Random::character(6);
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
		$data['triggerType'] = mt_rand(0, 3);
		$data['triggerRate'] = "测试文本".Random::character(6);
		$data['rarityLevel'] = mt_rand(10000, 99999);
		$data['maxLevel'] = mt_rand(10000, 99999);
		$data['coolingTime'] = mt_rand(10000, 99999);
		$data['manaCost'] = "测试文本".Random::character(6);
		$data['entryCode'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['effectParam'] = "测试文本".Random::character(6);
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
		$data['triggerType'] = mt_rand(0, 3);
		$data['triggerRate'] = "测试文本".Random::character(6);
		$data['rarityLevel'] = mt_rand(10000, 99999);
		$data['maxLevel'] = mt_rand(10000, 99999);
		$data['coolingTime'] = mt_rand(10000, 99999);
		$data['manaCost'] = "测试文本".Random::character(6);
		$data['entryCode'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['effectParam'] = "测试文本".Random::character(6);
		$model = new SkillModel();
		$model->data($data)->save();

		$update = [];
		$update['skillId'] = $model->skillId;
		$update['name'] = "测试文本".Random::character(6);
		$update['level'] = mt_rand(10000, 99999);
		$update['triggerType'] = mt_rand(0, 3);
		$update['triggerRate'] = "测试文本".Random::character(6);
		$update['rarityLevel'] = mt_rand(10000, 99999);
		$update['maxLevel'] = mt_rand(10000, 99999);
		$update['coolingTime'] = mt_rand(10000, 99999);
		$update['manaCost'] = "测试文本".Random::character(6);
		$update['entryCode'] = "测试文本".Random::character(6);
		$update['description'] = "测试文本".Random::character(6);
		$update['effectParam'] = "测试文本".Random::character(6);
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
		$data['triggerType'] = mt_rand(0, 3);
		$data['triggerRate'] = "测试文本".Random::character(6);
		$data['rarityLevel'] = mt_rand(10000, 99999);
		$data['maxLevel'] = mt_rand(10000, 99999);
		$data['coolingTime'] = mt_rand(10000, 99999);
		$data['manaCost'] = "测试文本".Random::character(6);
		$data['entryCode'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['effectParam'] = "测试文本".Random::character(6);
		$model = new SkillModel();
		$model->data($data)->save();

		$delData = [];
		$delData['skillId'] = $model->skillId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

