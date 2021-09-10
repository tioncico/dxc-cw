<?php

namespace UnitTest\User;

use UserSkillModel;

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
		$data['userId'] = '91706';
		$data['skillId'] = '84183';
		$data['skillName'] = '测试文本gwSp5K';
		$data['isUse'] = '1';
		$data['level'] = '69043';
		$data['type'] = '1';
		$data['rarityLevel'] = '55366';
		$data['maxLevel'] = '15593';
		$data['coolingTime'] = '99942';
		$data['manaCostQualification'] = '52158';
		$data['entryCode'] = '测试文本6WXqJm';
		$data['description'] = '测试文本LVoyti';
		$data['param'] = '测试文本ELQrfs';
		$data['qualification'] = '测试文本zlRq4f';
		$data['manaCost'] = '22845';
		$response = $this->request('add',$data);
		$model = new UserSkillModel();
		$model->destroy($response->result->userSkillId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['userId'] = '36307';
		$data['skillId'] = '79146';
		$data['skillName'] = '测试文本OEbaqL';
		$data['isUse'] = '3';
		$data['level'] = '76142';
		$data['type'] = '1';
		$data['rarityLevel'] = '24860';
		$data['maxLevel'] = '67335';
		$data['coolingTime'] = '40814';
		$data['manaCostQualification'] = '18086';
		$data['entryCode'] = '测试文本S2lCTw';
		$data['description'] = '测试文本jzOS65';
		$data['param'] = '测试文本QO4Wft';
		$data['qualification'] = '测试文本iD2nf4';
		$data['manaCost'] = '36931';
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
		$data['userId'] = '73917';
		$data['skillId'] = '98591';
		$data['skillName'] = '测试文本HVM7P4';
		$data['isUse'] = '0';
		$data['level'] = '69385';
		$data['type'] = '2';
		$data['rarityLevel'] = '71950';
		$data['maxLevel'] = '35636';
		$data['coolingTime'] = '96913';
		$data['manaCostQualification'] = '33350';
		$data['entryCode'] = '测试文本Spalrv';
		$data['description'] = '测试文本cky9jT';
		$data['param'] = '测试文本FoEnJs';
		$data['qualification'] = '测试文本LnOkKP';
		$data['manaCost'] = '91283';
		$model = new UserSkillModel();
		$model->data($data)->save();

		$update = [];
		$update['userSkillId'] = $model->userSkillId;
		$update['userId'] = '72216';
		$update['skillId'] = '11408';
		$update['skillName'] = '测试文本AE0wdG';
		$update['isUse'] = '1';
		$update['level'] = '42681';
		$update['type'] = '0';
		$update['rarityLevel'] = '83543';
		$update['maxLevel'] = '68348';
		$update['coolingTime'] = '43423';
		$update['manaCostQualification'] = '96589';
		$update['entryCode'] = '测试文本pafLws';
		$update['description'] = '测试文本Tp6fCr';
		$update['param'] = '测试文本fhjJ8W';
		$update['qualification'] = '测试文本orN5nk';
		$update['manaCost'] = '54692';
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
		$data['userId'] = '63693';
		$data['skillId'] = '77116';
		$data['skillName'] = '测试文本MFe2sy';
		$data['isUse'] = '1';
		$data['level'] = '64739';
		$data['type'] = '1';
		$data['rarityLevel'] = '38070';
		$data['maxLevel'] = '85909';
		$data['coolingTime'] = '13003';
		$data['manaCostQualification'] = '73470';
		$data['entryCode'] = '测试文本nwbsEl';
		$data['description'] = '测试文本wqFY8Z';
		$data['param'] = '测试文本NPXAU4';
		$data['qualification'] = '测试文本dqpFtj';
		$data['manaCost'] = '66077';
		$model = new UserSkillModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userSkillId'] = $model->userSkillId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

