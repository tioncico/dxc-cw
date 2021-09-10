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
		$data['petId'] = '87770';
		$data['name'] = '测试文本n1XW4B';
		$data['type'] = '测试文本z0RKp4';
		$data['isUse'] = '53417';
		$data['description'] = '测试文本N3xZQq';
		$data['level'] = '15537';
		$data['exp'] = '88049';
		$data['isBest'] = '0';
		$data['hp'] = '12393';
		$data['mp'] = '56767';
		$data['attack'] = '47494';
		$data['defense'] = '55381';
		$data['endurance'] = '43901';
		$data['intellect'] = '94020';
		$data['strength'] = '11831';
		$data['enduranceQualification'] = '90281';
		$data['intellectQualification'] = '18855';
		$data['strengthQualification'] = '55251';
		$data['criticalRate'] = '64856';
		$data['criticalStrikeDamage'] = '75643';
		$data['hitRate'] = '61408';
		$data['dodgeRate'] = '79849';
		$data['penetrate'] = '49067';
		$data['attackSpeed'] = '85106';
		$data['userElement'] = '94439';
		$data['attackElement'] = '33967';
		$data['jin'] = '94576';
		$data['mu'] = '95025';
		$data['tu'] = '38369';
		$data['sui'] = '65978';
		$data['huo'] = '18890';
		$data['light'] = '86735';
		$data['dark'] = '17810';
		$response = $this->request('add',$data);
		$model = new UserPetModel();
		$model->destroy($response->result->userPetId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['petId'] = '33631';
		$data['name'] = '测试文本jWk5UI';
		$data['type'] = '测试文本CNdK1Q';
		$data['isUse'] = '69661';
		$data['description'] = '测试文本GQsrm1';
		$data['level'] = '82987';
		$data['exp'] = '47292';
		$data['isBest'] = '0';
		$data['hp'] = '85783';
		$data['mp'] = '67338';
		$data['attack'] = '60224';
		$data['defense'] = '83734';
		$data['endurance'] = '44271';
		$data['intellect'] = '27105';
		$data['strength'] = '10799';
		$data['enduranceQualification'] = '49703';
		$data['intellectQualification'] = '91038';
		$data['strengthQualification'] = '44177';
		$data['criticalRate'] = '40856';
		$data['criticalStrikeDamage'] = '73038';
		$data['hitRate'] = '21765';
		$data['dodgeRate'] = '63060';
		$data['penetrate'] = '16112';
		$data['attackSpeed'] = '27104';
		$data['userElement'] = '62180';
		$data['attackElement'] = '49159';
		$data['jin'] = '39369';
		$data['mu'] = '35633';
		$data['tu'] = '21613';
		$data['sui'] = '74869';
		$data['huo'] = '53839';
		$data['light'] = '86763';
		$data['dark'] = '98789';
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
		$data['petId'] = '96027';
		$data['name'] = '测试文本fSBVyI';
		$data['type'] = '测试文本Q5CkDG';
		$data['isUse'] = '36921';
		$data['description'] = '测试文本bWUhcD';
		$data['level'] = '85378';
		$data['exp'] = '82386';
		$data['isBest'] = '2';
		$data['hp'] = '74990';
		$data['mp'] = '92695';
		$data['attack'] = '44047';
		$data['defense'] = '47400';
		$data['endurance'] = '76651';
		$data['intellect'] = '63795';
		$data['strength'] = '68264';
		$data['enduranceQualification'] = '23661';
		$data['intellectQualification'] = '93542';
		$data['strengthQualification'] = '15369';
		$data['criticalRate'] = '81078';
		$data['criticalStrikeDamage'] = '40494';
		$data['hitRate'] = '33805';
		$data['dodgeRate'] = '35273';
		$data['penetrate'] = '20203';
		$data['attackSpeed'] = '81911';
		$data['userElement'] = '14724';
		$data['attackElement'] = '22885';
		$data['jin'] = '77916';
		$data['mu'] = '93848';
		$data['tu'] = '82180';
		$data['sui'] = '75923';
		$data['huo'] = '63761';
		$data['light'] = '89709';
		$data['dark'] = '63002';
		$model = new UserPetModel();
		$model->data($data)->save();

		$update = [];
		$update['userPetId'] = $model->userPetId;
		$update['petId'] = '82292';
		$update['name'] = '测试文本GYODab';
		$update['type'] = '测试文本sPo8BD';
		$update['isUse'] = '32031';
		$update['description'] = '测试文本vagSbi';
		$update['level'] = '20114';
		$update['exp'] = '47811';
		$update['isBest'] = '1';
		$update['hp'] = '86194';
		$update['mp'] = '11614';
		$update['attack'] = '95452';
		$update['defense'] = '94933';
		$update['endurance'] = '59325';
		$update['intellect'] = '22696';
		$update['strength'] = '43560';
		$update['enduranceQualification'] = '59692';
		$update['intellectQualification'] = '39893';
		$update['strengthQualification'] = '25508';
		$update['criticalRate'] = '66512';
		$update['criticalStrikeDamage'] = '86713';
		$update['hitRate'] = '96241';
		$update['dodgeRate'] = '10825';
		$update['penetrate'] = '44299';
		$update['attackSpeed'] = '74493';
		$update['userElement'] = '87715';
		$update['attackElement'] = '58976';
		$update['jin'] = '34363';
		$update['mu'] = '99787';
		$update['tu'] = '77277';
		$update['sui'] = '72182';
		$update['huo'] = '45495';
		$update['light'] = '99851';
		$update['dark'] = '75151';
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
		$data['petId'] = '39835';
		$data['name'] = '测试文本F0lf6D';
		$data['type'] = '测试文本y5QVd6';
		$data['isUse'] = '34016';
		$data['description'] = '测试文本jhQIwr';
		$data['level'] = '65594';
		$data['exp'] = '49207';
		$data['isBest'] = '3';
		$data['hp'] = '95538';
		$data['mp'] = '89326';
		$data['attack'] = '68808';
		$data['defense'] = '56559';
		$data['endurance'] = '65003';
		$data['intellect'] = '18730';
		$data['strength'] = '55315';
		$data['enduranceQualification'] = '84304';
		$data['intellectQualification'] = '54781';
		$data['strengthQualification'] = '63808';
		$data['criticalRate'] = '79727';
		$data['criticalStrikeDamage'] = '91366';
		$data['hitRate'] = '59832';
		$data['dodgeRate'] = '67820';
		$data['penetrate'] = '43339';
		$data['attackSpeed'] = '93335';
		$data['userElement'] = '41124';
		$data['attackElement'] = '24096';
		$data['jin'] = '60655';
		$data['mu'] = '85086';
		$data['tu'] = '27430';
		$data['sui'] = '90396';
		$data['huo'] = '95125';
		$data['light'] = '28526';
		$data['dark'] = '14360';
		$model = new UserPetModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userPetId'] = $model->userPetId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

