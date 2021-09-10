<?php

namespace UnitTest\User;

use SkillModel;

/**
 * SkillTest
 * Class SkillTest
 * Create With ClassGeneration
 */
class SkillTest extends UserBaseTestCase
{
	public $modelName = 'Skill';


	public function testAdd()
	{
		$data = [];
		$data['name'] = '测试文本K5PD37';
		$data['level'] = '99863';
		$data['type'] = '3';
		$data['rarityLevel'] = '28263';
		$data['maxLevel'] = '44679';
		$data['coolingTime'] = '77109';
		$data['manaCost'] = '70338';
		$data['entryCode'] = '测试文本PGfeJj';
		$data['description'] = '测试文本uAUty1';
		$data['param'] = '测试文本nQOX1j';
		$data['qualification'] = '测试文本imGpEa';
		$data['manaCostQualification'] = '86543';
		$response = $this->request('add',$data);
		$model = new SkillModel();
		$model->destroy($response->result->skillId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = '测试文本NR1whx';
		$data['level'] = '86223';
		$data['type'] = '3';
		$data['rarityLevel'] = '44726';
		$data['maxLevel'] = '87594';
		$data['coolingTime'] = '96056';
		$data['manaCost'] = '97765';
		$data['entryCode'] = '测试文本2h97bK';
		$data['description'] = '测试文本K9gAzh';
		$data['param'] = '测试文本o6IiDc';
		$data['qualification'] = '测试文本nIZNDL';
		$data['manaCostQualification'] = '60099';
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
		$data['name'] = '测试文本e0WrGQ';
		$data['level'] = '82327';
		$data['type'] = '3';
		$data['rarityLevel'] = '61504';
		$data['maxLevel'] = '43303';
		$data['coolingTime'] = '54141';
		$data['manaCost'] = '30629';
		$data['entryCode'] = '测试文本TKFWpe';
		$data['description'] = '测试文本ogk9EL';
		$data['param'] = '测试文本JxacVq';
		$data['qualification'] = '测试文本EMJayH';
		$data['manaCostQualification'] = '96903';
		$model = new SkillModel();
		$model->data($data)->save();

		$update = [];
		$update['skillId'] = $model->skillId;
		$update['name'] = '测试文本ZX6Wj8';
		$update['level'] = '48852';
		$update['type'] = '0';
		$update['rarityLevel'] = '37502';
		$update['maxLevel'] = '12622';
		$update['coolingTime'] = '16088';
		$update['manaCost'] = '46786';
		$update['entryCode'] = '测试文本eRlhVn';
		$update['description'] = '测试文本ERZ15V';
		$update['param'] = '测试文本h07KRv';
		$update['qualification'] = '测试文本z3KjAf';
		$update['manaCostQualification'] = '48130';
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
		$data['name'] = '测试文本Hf5K3W';
		$data['level'] = '56158';
		$data['type'] = '1';
		$data['rarityLevel'] = '60006';
		$data['maxLevel'] = '24334';
		$data['coolingTime'] = '23061';
		$data['manaCost'] = '34078';
		$data['entryCode'] = '测试文本4E7H5s';
		$data['description'] = '测试文本v3pxVy';
		$data['param'] = '测试文本DG9R6r';
		$data['qualification'] = '测试文本aW9sHR';
		$data['manaCostQualification'] = '21105';
		$model = new SkillModel();
		$model->data($data)->save();

		$delData = [];
		$delData['skillId'] = $model->skillId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

