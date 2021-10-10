<?php

namespace UnitTest\User;

use EasySwoole\Utility\Random;
use UserPetModel;

/**
 * UserPetTest
 * Class UserPetTest
 * Create With ClassGeneration
 */
class UserPetTest extends UserBaseTestCase
{
	public $modelName = 'UserPet';


	public function testAdd()
	{
		$data = [];
		$data['petId'] = mt_rand(10000, 99999);
		$data['userId'] = mt_rand(10000, 99999);
		$data['name'] = "测试文本".Random::character(6);
		$data['type'] = "测试文本".Random::character(6);
		$data['isUse'] = mt_rand(10000, 99999);
		$data['description'] = "测试文本".Random::character(6);
		$data['level'] = mt_rand(10000, 99999);
		$data['exp'] = mt_rand(10000, 99999);
		$data['isBest'] = mt_rand(0, 3);
		$data['hp'] = mt_rand(10000, 99999);
		$data['mp'] = mt_rand(10000, 99999);
		$data['attack'] = mt_rand(10000, 99999);
		$data['defense'] = mt_rand(10000, 99999);
		$data['endurance'] = mt_rand(10000, 99999);
		$data['intellect'] = mt_rand(10000, 99999);
		$data['strength'] = mt_rand(10000, 99999);
		$data['enduranceQualification'] = mt_rand(10000, 99999);
		$data['intellectQualification'] = mt_rand(10000, 99999);
		$data['strengthQualification'] = mt_rand(10000, 99999);
		$data['criticalRate'] = mt_rand(10000, 99999);
		$data['criticalStrikeDamage'] = mt_rand(10000, 99999);
		$data['hitRate'] = mt_rand(10000, 99999);
		$data['dodgeRate'] = mt_rand(10000, 99999);
		$data['penetrate'] = mt_rand(10000, 99999);
		$data['attackSpeed'] = mt_rand(10000, 99999);
		$data['userElement'] = mt_rand(10000, 99999);
		$data['attackElement'] = mt_rand(10000, 99999);
		$data['jin'] = mt_rand(10000, 99999);
		$data['mu'] = mt_rand(10000, 99999);
		$data['tu'] = mt_rand(10000, 99999);
		$data['sui'] = mt_rand(10000, 99999);
		$data['huo'] = mt_rand(10000, 99999);
		$data['light'] = mt_rand(10000, 99999);
		$data['dark'] = mt_rand(10000, 99999);
		$response = $this->request('add',$data);
		$model = new UserPetModel();
		$model->destroy($response->result->userPetId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['petId'] = mt_rand(10000, 99999);
		$data['userId'] = mt_rand(10000, 99999);
		$data['name'] = "测试文本".Random::character(6);
		$data['type'] = "测试文本".Random::character(6);
		$data['isUse'] = mt_rand(10000, 99999);
		$data['description'] = "测试文本".Random::character(6);
		$data['level'] = mt_rand(10000, 99999);
		$data['exp'] = mt_rand(10000, 99999);
		$data['isBest'] = mt_rand(0, 3);
		$data['hp'] = mt_rand(10000, 99999);
		$data['mp'] = mt_rand(10000, 99999);
		$data['attack'] = mt_rand(10000, 99999);
		$data['defense'] = mt_rand(10000, 99999);
		$data['endurance'] = mt_rand(10000, 99999);
		$data['intellect'] = mt_rand(10000, 99999);
		$data['strength'] = mt_rand(10000, 99999);
		$data['enduranceQualification'] = mt_rand(10000, 99999);
		$data['intellectQualification'] = mt_rand(10000, 99999);
		$data['strengthQualification'] = mt_rand(10000, 99999);
		$data['criticalRate'] = mt_rand(10000, 99999);
		$data['criticalStrikeDamage'] = mt_rand(10000, 99999);
		$data['hitRate'] = mt_rand(10000, 99999);
		$data['dodgeRate'] = mt_rand(10000, 99999);
		$data['penetrate'] = mt_rand(10000, 99999);
		$data['attackSpeed'] = mt_rand(10000, 99999);
		$data['userElement'] = mt_rand(10000, 99999);
		$data['attackElement'] = mt_rand(10000, 99999);
		$data['jin'] = mt_rand(10000, 99999);
		$data['mu'] = mt_rand(10000, 99999);
		$data['tu'] = mt_rand(10000, 99999);
		$data['sui'] = mt_rand(10000, 99999);
		$data['huo'] = mt_rand(10000, 99999);
		$data['light'] = mt_rand(10000, 99999);
		$data['dark'] = mt_rand(10000, 99999);
		$model = new UserPetModel();
		$model->data($data)->save();

		$data = [];
		$data['userPetId'] = $model->userPetId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->userPetId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['petId'] = mt_rand(10000, 99999);
		$data['userId'] = mt_rand(10000, 99999);
		$data['name'] = "测试文本".Random::character(6);
		$data['type'] = "测试文本".Random::character(6);
		$data['isUse'] = mt_rand(10000, 99999);
		$data['description'] = "测试文本".Random::character(6);
		$data['level'] = mt_rand(10000, 99999);
		$data['exp'] = mt_rand(10000, 99999);
		$data['isBest'] = mt_rand(0, 3);
		$data['hp'] = mt_rand(10000, 99999);
		$data['mp'] = mt_rand(10000, 99999);
		$data['attack'] = mt_rand(10000, 99999);
		$data['defense'] = mt_rand(10000, 99999);
		$data['endurance'] = mt_rand(10000, 99999);
		$data['intellect'] = mt_rand(10000, 99999);
		$data['strength'] = mt_rand(10000, 99999);
		$data['enduranceQualification'] = mt_rand(10000, 99999);
		$data['intellectQualification'] = mt_rand(10000, 99999);
		$data['strengthQualification'] = mt_rand(10000, 99999);
		$data['criticalRate'] = mt_rand(10000, 99999);
		$data['criticalStrikeDamage'] = mt_rand(10000, 99999);
		$data['hitRate'] = mt_rand(10000, 99999);
		$data['dodgeRate'] = mt_rand(10000, 99999);
		$data['penetrate'] = mt_rand(10000, 99999);
		$data['attackSpeed'] = mt_rand(10000, 99999);
		$data['userElement'] = mt_rand(10000, 99999);
		$data['attackElement'] = mt_rand(10000, 99999);
		$data['jin'] = mt_rand(10000, 99999);
		$data['mu'] = mt_rand(10000, 99999);
		$data['tu'] = mt_rand(10000, 99999);
		$data['sui'] = mt_rand(10000, 99999);
		$data['huo'] = mt_rand(10000, 99999);
		$data['light'] = mt_rand(10000, 99999);
		$data['dark'] = mt_rand(10000, 99999);
		$model = new UserPetModel();
		$model->data($data)->save();

		$update = [];
		$update['userPetId'] = $model->userPetId;
		$update['petId'] = mt_rand(10000, 99999);
		$update['userId'] = mt_rand(10000, 99999);
		$update['name'] = "测试文本".Random::character(6);
		$update['type'] = "测试文本".Random::character(6);
		$update['isUse'] = mt_rand(10000, 99999);
		$update['description'] = "测试文本".Random::character(6);
		$update['level'] = mt_rand(10000, 99999);
		$update['exp'] = mt_rand(10000, 99999);
		$update['isBest'] = mt_rand(0, 3);
		$update['hp'] = mt_rand(10000, 99999);
		$update['mp'] = mt_rand(10000, 99999);
		$update['attack'] = mt_rand(10000, 99999);
		$update['defense'] = mt_rand(10000, 99999);
		$update['endurance'] = mt_rand(10000, 99999);
		$update['intellect'] = mt_rand(10000, 99999);
		$update['strength'] = mt_rand(10000, 99999);
		$update['enduranceQualification'] = mt_rand(10000, 99999);
		$update['intellectQualification'] = mt_rand(10000, 99999);
		$update['strengthQualification'] = mt_rand(10000, 99999);
		$update['criticalRate'] = mt_rand(10000, 99999);
		$update['criticalStrikeDamage'] = mt_rand(10000, 99999);
		$update['hitRate'] = mt_rand(10000, 99999);
		$update['dodgeRate'] = mt_rand(10000, 99999);
		$update['penetrate'] = mt_rand(10000, 99999);
		$update['attackSpeed'] = mt_rand(10000, 99999);
		$update['userElement'] = mt_rand(10000, 99999);
		$update['attackElement'] = mt_rand(10000, 99999);
		$update['jin'] = mt_rand(10000, 99999);
		$update['mu'] = mt_rand(10000, 99999);
		$update['tu'] = mt_rand(10000, 99999);
		$update['sui'] = mt_rand(10000, 99999);
		$update['huo'] = mt_rand(10000, 99999);
		$update['light'] = mt_rand(10000, 99999);
		$update['dark'] = mt_rand(10000, 99999);
		$response = $this->request('update',$update);
		$model->destroy($model->userPetId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$data = [];
		$response = $this->request('getList',$data);

		var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['petId'] = mt_rand(10000, 99999);
		$data['userId'] = mt_rand(10000, 99999);
		$data['name'] = "测试文本".Random::character(6);
		$data['type'] = "测试文本".Random::character(6);
		$data['isUse'] = mt_rand(10000, 99999);
		$data['description'] = "测试文本".Random::character(6);
		$data['level'] = mt_rand(10000, 99999);
		$data['exp'] = mt_rand(10000, 99999);
		$data['isBest'] = mt_rand(0, 3);
		$data['hp'] = mt_rand(10000, 99999);
		$data['mp'] = mt_rand(10000, 99999);
		$data['attack'] = mt_rand(10000, 99999);
		$data['defense'] = mt_rand(10000, 99999);
		$data['endurance'] = mt_rand(10000, 99999);
		$data['intellect'] = mt_rand(10000, 99999);
		$data['strength'] = mt_rand(10000, 99999);
		$data['enduranceQualification'] = mt_rand(10000, 99999);
		$data['intellectQualification'] = mt_rand(10000, 99999);
		$data['strengthQualification'] = mt_rand(10000, 99999);
		$data['criticalRate'] = mt_rand(10000, 99999);
		$data['criticalStrikeDamage'] = mt_rand(10000, 99999);
		$data['hitRate'] = mt_rand(10000, 99999);
		$data['dodgeRate'] = mt_rand(10000, 99999);
		$data['penetrate'] = mt_rand(10000, 99999);
		$data['attackSpeed'] = mt_rand(10000, 99999);
		$data['userElement'] = mt_rand(10000, 99999);
		$data['attackElement'] = mt_rand(10000, 99999);
		$data['jin'] = mt_rand(10000, 99999);
		$data['mu'] = mt_rand(10000, 99999);
		$data['tu'] = mt_rand(10000, 99999);
		$data['sui'] = mt_rand(10000, 99999);
		$data['huo'] = mt_rand(10000, 99999);
		$data['light'] = mt_rand(10000, 99999);
		$data['dark'] = mt_rand(10000, 99999);
		$model = new UserPetModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userPetId'] = $model->userPetId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

