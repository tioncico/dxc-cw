<?php

namespace UnitTest\User;

use App\Model\Game\UserSkillModel;
use EasySwoole\Utility\Random;

/**
 * UserSkillTest
 * Class UserSkillTest
 * Create With ClassGeneration
 */
class UserSkillTest extends UserBaseTestCase
{
	public $modelName = 'UserSkill';


	public function testAdd()
	{
		$data = [];
		$data['userId'] = mt_rand(10000, 99999);
		$data['skillId'] = mt_rand(10000, 99999);
		$data['skillName'] = "测试文本".Random::character(6);
		$data['triggerType'] = mt_rand(0, 3);
		$data['triggerRate'] = "测试文本".Random::character(6);
		$data['isUse'] = mt_rand(0, 3);
		$data['level'] = mt_rand(10000, 99999);
		$data['rarityLevel'] = mt_rand(10000, 99999);
		$data['maxLevel'] = mt_rand(10000, 99999);
		$data['coolingTime'] = "测试文本".Random::character(6);
		$data['manaCost'] = "测试文本".Random::character(6);
		$data['entryCode'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['effectParam'] = "测试文本".Random::character(6);
		$response = $this->request('add',$data);
		$model = new UserSkillModel();
		$model->destroy($response->result->userSkillId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['userId'] = mt_rand(10000, 99999);
		$data['skillId'] = mt_rand(10000, 99999);
		$data['skillName'] = "测试文本".Random::character(6);
		$data['triggerType'] = mt_rand(0, 3);
		$data['triggerRate'] = "测试文本".Random::character(6);
		$data['isUse'] = mt_rand(0, 3);
		$data['level'] = mt_rand(10000, 99999);
		$data['rarityLevel'] = mt_rand(10000, 99999);
		$data['maxLevel'] = mt_rand(10000, 99999);
		$data['coolingTime'] = "测试文本".Random::character(6);
		$data['manaCost'] = "测试文本".Random::character(6);
		$data['entryCode'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['effectParam'] = "测试文本".Random::character(6);
		$model = new UserSkillModel();
		$model->data($data)->save();

		$data = [];
		$data['userSkillId'] = $model->userSkillId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->userSkillId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['userId'] = mt_rand(10000, 99999);
		$data['skillId'] = mt_rand(10000, 99999);
		$data['skillName'] = "测试文本".Random::character(6);
		$data['triggerType'] = mt_rand(0, 3);
		$data['triggerRate'] = "测试文本".Random::character(6);
		$data['isUse'] = mt_rand(0, 3);
		$data['level'] = mt_rand(10000, 99999);
		$data['rarityLevel'] = mt_rand(10000, 99999);
		$data['maxLevel'] = mt_rand(10000, 99999);
		$data['coolingTime'] = "测试文本".Random::character(6);
		$data['manaCost'] = "测试文本".Random::character(6);
		$data['entryCode'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['effectParam'] = "测试文本".Random::character(6);
		$model = new UserSkillModel();
		$model->data($data)->save();

		$update = [];
		$update['userSkillId'] = $model->userSkillId;
		$update['userId'] = mt_rand(10000, 99999);
		$update['skillId'] = mt_rand(10000, 99999);
		$update['skillName'] = "测试文本".Random::character(6);
		$update['triggerType'] = mt_rand(0, 3);
		$update['triggerRate'] = "测试文本".Random::character(6);
		$update['isUse'] = mt_rand(0, 3);
		$update['level'] = mt_rand(10000, 99999);
		$update['rarityLevel'] = mt_rand(10000, 99999);
		$update['maxLevel'] = mt_rand(10000, 99999);
		$update['coolingTime'] = "测试文本".Random::character(6);
		$update['manaCost'] = "测试文本".Random::character(6);
		$update['entryCode'] = "测试文本".Random::character(6);
		$update['description'] = "测试文本".Random::character(6);
		$update['effectParam'] = "测试文本".Random::character(6);
		$response = $this->request('update',$update);
		$model->destroy($model->userSkillId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new UserSkillModel();
		$data = [];
		$response = $this->request('getList',$data);

		var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['userId'] = mt_rand(10000, 99999);
		$data['skillId'] = mt_rand(10000, 99999);
		$data['skillName'] = "测试文本".Random::character(6);
		$data['triggerType'] = mt_rand(0, 3);
		$data['triggerRate'] = "测试文本".Random::character(6);
		$data['isUse'] = mt_rand(0, 3);
		$data['level'] = mt_rand(10000, 99999);
		$data['rarityLevel'] = mt_rand(10000, 99999);
		$data['maxLevel'] = mt_rand(10000, 99999);
		$data['coolingTime'] = "测试文本".Random::character(6);
		$data['manaCost'] = "测试文本".Random::character(6);
		$data['entryCode'] = "测试文本".Random::character(6);
		$data['description'] = "测试文本".Random::character(6);
		$data['effectParam'] = "测试文本".Random::character(6);
		$model = new UserSkillModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userSkillId'] = $model->userSkillId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

