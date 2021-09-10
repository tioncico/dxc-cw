<?php

namespace UnitTest\User;

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
		$data['petId'] = '86525';
		$data['name'] = '测试文本bi4mzg';
		$data['type'] = '测试文本R0nqEh';
		$data['description'] = '测试文本KvSDXO';
		$data['level'] = '81382';
		$data['exp'] = '40100';
		$data['isBest'] = '0';
		$data['hp'] = '12261';
		$data['mp'] = '60133';
		$data['attack'] = '32140';
		$data['defense'] = '68127';
		$data['endurance'] = '22438';
		$data['intellect'] = '23954';
		$data['strength'] = '79584';
		$data['enduranceQualification'] = '57235';
		$data['intellectQualification'] = '23926';
		$data['strengthQualification'] = '20367';
		$data['criticalRate'] = '52871';
		$data['criticalStrikeDamage'] = '40515';
		$data['hitRate'] = '96540';
		$data['dodgeRate'] = '46099';
		$data['penetrate'] = '95173';
		$data['attackSpeed'] = '24997';
		$data['userElement'] = '28788';
		$data['attackElement'] = '98741';
		$data['jin'] = '27589';
		$data['mu'] = '86695';
		$data['tu'] = '15731';
		$data['sui'] = '21280';
		$data['huo'] = '20404';
		$data['light'] = '18653';
		$data['dark'] = '40992';
		$response = $this->request('add',$data);
		$model = new UserPetModel();
		$model->destroy($response->result->userPetId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['petId'] = '41874';
		$data['name'] = '测试文本pNEvZC';
		$data['type'] = '测试文本fuhjep';
		$data['description'] = '测试文本c8ikCo';
		$data['level'] = '66423';
		$data['exp'] = '76611';
		$data['isBest'] = '0';
		$data['hp'] = '38677';
		$data['mp'] = '82498';
		$data['attack'] = '74713';
		$data['defense'] = '14237';
		$data['endurance'] = '97689';
		$data['intellect'] = '55506';
		$data['strength'] = '63300';
		$data['enduranceQualification'] = '30820';
		$data['intellectQualification'] = '51190';
		$data['strengthQualification'] = '13566';
		$data['criticalRate'] = '92442';
		$data['criticalStrikeDamage'] = '92701';
		$data['hitRate'] = '63063';
		$data['dodgeRate'] = '61206';
		$data['penetrate'] = '78326';
		$data['attackSpeed'] = '50501';
		$data['userElement'] = '44868';
		$data['attackElement'] = '21787';
		$data['jin'] = '33770';
		$data['mu'] = '80373';
		$data['tu'] = '46925';
		$data['sui'] = '89432';
		$data['huo'] = '68804';
		$data['light'] = '29193';
		$data['dark'] = '36481';
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
		$data['petId'] = '55201';
		$data['name'] = '测试文本mwo8Sb';
		$data['type'] = '测试文本D8SxsO';
		$data['description'] = '测试文本cK6ew9';
		$data['level'] = '90056';
		$data['exp'] = '88157';
		$data['isBest'] = '2';
		$data['hp'] = '30453';
		$data['mp'] = '75312';
		$data['attack'] = '81458';
		$data['defense'] = '28449';
		$data['endurance'] = '49164';
		$data['intellect'] = '49425';
		$data['strength'] = '46830';
		$data['enduranceQualification'] = '85353';
		$data['intellectQualification'] = '47725';
		$data['strengthQualification'] = '47134';
		$data['criticalRate'] = '29234';
		$data['criticalStrikeDamage'] = '83683';
		$data['hitRate'] = '48512';
		$data['dodgeRate'] = '31309';
		$data['penetrate'] = '43063';
		$data['attackSpeed'] = '77987';
		$data['userElement'] = '80966';
		$data['attackElement'] = '31812';
		$data['jin'] = '88232';
		$data['mu'] = '55518';
		$data['tu'] = '60420';
		$data['sui'] = '24357';
		$data['huo'] = '10049';
		$data['light'] = '47630';
		$data['dark'] = '39567';
		$model = new UserPetModel();
		$model->data($data)->save();

		$update = [];
		$update['userPetId'] = $model->userPetId;
		$update['petId'] = '89688';
		$update['name'] = '测试文本s6AJYM';
		$update['type'] = '测试文本bTtAxf';
		$update['description'] = '测试文本jLbHhn';
		$update['level'] = '73332';
		$update['exp'] = '63210';
		$update['isBest'] = '1';
		$update['hp'] = '19836';
		$update['mp'] = '72921';
		$update['attack'] = '48903';
		$update['defense'] = '59168';
		$update['endurance'] = '92865';
		$update['intellect'] = '76427';
		$update['strength'] = '47114';
		$update['enduranceQualification'] = '50092';
		$update['intellectQualification'] = '67826';
		$update['strengthQualification'] = '96668';
		$update['criticalRate'] = '30120';
		$update['criticalStrikeDamage'] = '43268';
		$update['hitRate'] = '17038';
		$update['dodgeRate'] = '78830';
		$update['penetrate'] = '17208';
		$update['attackSpeed'] = '79312';
		$update['userElement'] = '85369';
		$update['attackElement'] = '27119';
		$update['jin'] = '10329';
		$update['mu'] = '77041';
		$update['tu'] = '53586';
		$update['sui'] = '67576';
		$update['huo'] = '29578';
		$update['light'] = '83783';
		$update['dark'] = '68923';
		$response = $this->request('update',$update);
		$model->destroy($model->userPetId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new UserPetModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['petId'] = '67145';
		$data['name'] = '测试文本zrEpPh';
		$data['type'] = '测试文本kJ5D7v';
		$data['description'] = '测试文本bSOFEc';
		$data['level'] = '70000';
		$data['exp'] = '80596';
		$data['isBest'] = '0';
		$data['hp'] = '97614';
		$data['mp'] = '67755';
		$data['attack'] = '57015';
		$data['defense'] = '42337';
		$data['endurance'] = '95925';
		$data['intellect'] = '61989';
		$data['strength'] = '56658';
		$data['enduranceQualification'] = '44073';
		$data['intellectQualification'] = '27089';
		$data['strengthQualification'] = '82125';
		$data['criticalRate'] = '92499';
		$data['criticalStrikeDamage'] = '29333';
		$data['hitRate'] = '71475';
		$data['dodgeRate'] = '79821';
		$data['penetrate'] = '16515';
		$data['attackSpeed'] = '10096';
		$data['userElement'] = '36000';
		$data['attackElement'] = '21538';
		$data['jin'] = '74303';
		$data['mu'] = '50431';
		$data['tu'] = '57728';
		$data['sui'] = '19115';
		$data['huo'] = '28779';
		$data['light'] = '13807';
		$data['dark'] = '31782';
		$model = new UserPetModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userPetId'] = $model->userPetId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

