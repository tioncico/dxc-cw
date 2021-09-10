<?php

namespace UnitTest\Admin;

use UserSkillModel;

/**
 * UserSkillTest
 * Class UserSkillTest
 * Create With ClassGeneration
 */
class UserSkillTest extends AdminBaseTestCase
{
	public $modelName = 'UserSkill';


	public function testAdd()
	{
		$data = [];
		$data['userId'] = '47117';
		$data['skillId'] = '20663';
		$data['skillName'] = '测试文本y9m13j';
		$data['isUse'] = '0';
		$data['level'] = '40486';
		$data['type'] = '3';
		$data['rarityLevel'] = '78461';
		$data['maxLevel'] = '61653';
		$data['coolingTime'] = '89587';
		$data['manaCostQualification'] = '38785';
		$data['entryCode'] = '测试文本4PQDx6';
		$data['description'] = '测试文本T3MArh';
		$data['param'] = '测试文本NOieSp';
		$data['qualification'] = '测试文本gs0tJ1';
		$data['manaCost'] = '83929';
		$response = $this->request('add',$data);
		$model = new UserSkillModel();
		$model->destroy($response->result->userSkillId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['userId'] = '84063';
		$data['skillId'] = '10564';
		$data['skillName'] = '测试文本kX6mhL';
		$data['isUse'] = '3';
		$data['level'] = '94413';
		$data['type'] = '0';
		$data['rarityLevel'] = '90129';
		$data['maxLevel'] = '39167';
		$data['coolingTime'] = '82260';
		$data['manaCostQualification'] = '33629';
		$data['entryCode'] = '测试文本sBvn10';
		$data['description'] = '测试文本lsNMLt';
		$data['param'] = '测试文本fIE9u1';
		$data['qualification'] = '测试文本OmCUcw';
		$data['manaCost'] = '90781';
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
		$data['userId'] = '50141';
		$data['skillId'] = '53157';
		$data['skillName'] = '测试文本l6a70g';
		$data['isUse'] = '1';
		$data['level'] = '76307';
		$data['type'] = '2';
		$data['rarityLevel'] = '97103';
		$data['maxLevel'] = '35155';
		$data['coolingTime'] = '11100';
		$data['manaCostQualification'] = '90838';
		$data['entryCode'] = '测试文本qrSuVn';
		$data['description'] = '测试文本F0XUW1';
		$data['param'] = '测试文本B7LJvT';
		$data['qualification'] = '测试文本K68Tj3';
		$data['manaCost'] = '46243';
		$model = new UserSkillModel();
		$model->data($data)->save();

		$update = [];
		$update['userSkillId'] = $model->userSkillId;
		$update['userId'] = '96197';
		$update['skillId'] = '52268';
		$update['skillName'] = '测试文本9rqHcQ';
		$update['isUse'] = '3';
		$update['level'] = '87860';
		$update['type'] = '2';
		$update['rarityLevel'] = '67480';
		$update['maxLevel'] = '14778';
		$update['coolingTime'] = '48245';
		$update['manaCostQualification'] = '87733';
		$update['entryCode'] = '测试文本49tP1f';
		$update['description'] = '测试文本KTrloW';
		$update['param'] = '测试文本Z9GSdk';
		$update['qualification'] = '测试文本TiQR5g';
		$update['manaCost'] = '28968';
		$response = $this->request('update',$update);
		$model->destroy($model->userSkillId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new UserSkillModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['userId'] = '31780';
		$data['skillId'] = '41678';
		$data['skillName'] = '测试文本eNOU5A';
		$data['isUse'] = '1';
		$data['level'] = '81085';
		$data['type'] = '2';
		$data['rarityLevel'] = '47013';
		$data['maxLevel'] = '24283';
		$data['coolingTime'] = '97547';
		$data['manaCostQualification'] = '96697';
		$data['entryCode'] = '测试文本jrz3Bf';
		$data['description'] = '测试文本ceXFA0';
		$data['param'] = '测试文本RK0gQd';
		$data['qualification'] = '测试文本agisuK';
		$data['manaCost'] = '34390';
		$model = new UserSkillModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userSkillId'] = $model->userSkillId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

