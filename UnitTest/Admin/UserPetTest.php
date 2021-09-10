<?php

namespace UnitTest\Admin;

use UserPetModel;

/**
 * UserPetTest
 * Class UserPetTest
 * Create With ClassGeneration
 */
class UserPetTest extends AdminBaseTestCase
{
	public $modelName = 'UserPet';


	public function testAdd()
	{
		$data = [];
		$data['petId'] = '50239';
		$data['name'] = '测试文本kjopb1';
		$data['type'] = '测试文本NQ3K8Z';
		$data['isUse'] = '66920';
		$data['description'] = '测试文本BSUQOm';
		$data['level'] = '20980';
		$data['exp'] = '66448';
		$data['isBest'] = '1';
		$data['hp'] = '52513';
		$data['mp'] = '91550';
		$data['attack'] = '49899';
		$data['defense'] = '74954';
		$data['endurance'] = '78498';
		$data['intellect'] = '69260';
		$data['strength'] = '61629';
		$data['enduranceQualification'] = '16203';
		$data['intellectQualification'] = '21456';
		$data['strengthQualification'] = '12769';
		$data['criticalRate'] = '94286';
		$data['criticalStrikeDamage'] = '44612';
		$data['hitRate'] = '19331';
		$data['dodgeRate'] = '27659';
		$data['penetrate'] = '63034';
		$data['attackSpeed'] = '75424';
		$data['userElement'] = '93830';
		$data['attackElement'] = '46449';
		$data['jin'] = '58751';
		$data['mu'] = '12614';
		$data['tu'] = '52368';
		$data['sui'] = '63829';
		$data['huo'] = '77679';
		$data['light'] = '77905';
		$data['dark'] = '78255';
		$response = $this->request('add',$data);
		$model = new UserPetModel();
		$model->destroy($response->result->userPetId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['petId'] = '52750';
		$data['name'] = '测试文本loUghW';
		$data['type'] = '测试文本DEBH6F';
		$data['isUse'] = '72741';
		$data['description'] = '测试文本B0VeAd';
		$data['level'] = '28648';
		$data['exp'] = '95449';
		$data['isBest'] = '1';
		$data['hp'] = '90936';
		$data['mp'] = '98301';
		$data['attack'] = '41419';
		$data['defense'] = '56392';
		$data['endurance'] = '29206';
		$data['intellect'] = '27470';
		$data['strength'] = '47543';
		$data['enduranceQualification'] = '94507';
		$data['intellectQualification'] = '48510';
		$data['strengthQualification'] = '96101';
		$data['criticalRate'] = '33005';
		$data['criticalStrikeDamage'] = '21418';
		$data['hitRate'] = '62086';
		$data['dodgeRate'] = '69351';
		$data['penetrate'] = '90844';
		$data['attackSpeed'] = '20246';
		$data['userElement'] = '68294';
		$data['attackElement'] = '47836';
		$data['jin'] = '67888';
		$data['mu'] = '56953';
		$data['tu'] = '22342';
		$data['sui'] = '43790';
		$data['huo'] = '86813';
		$data['light'] = '79745';
		$data['dark'] = '80548';
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
		$data['petId'] = '81064';
		$data['name'] = '测试文本kO0zUN';
		$data['type'] = '测试文本uPnQML';
		$data['isUse'] = '97187';
		$data['description'] = '测试文本7FRz8u';
		$data['level'] = '54127';
		$data['exp'] = '59220';
		$data['isBest'] = '0';
		$data['hp'] = '54377';
		$data['mp'] = '20263';
		$data['attack'] = '46045';
		$data['defense'] = '39175';
		$data['endurance'] = '33347';
		$data['intellect'] = '32069';
		$data['strength'] = '26596';
		$data['enduranceQualification'] = '66830';
		$data['intellectQualification'] = '21062';
		$data['strengthQualification'] = '45252';
		$data['criticalRate'] = '92698';
		$data['criticalStrikeDamage'] = '20344';
		$data['hitRate'] = '26582';
		$data['dodgeRate'] = '32169';
		$data['penetrate'] = '90193';
		$data['attackSpeed'] = '45944';
		$data['userElement'] = '76991';
		$data['attackElement'] = '49134';
		$data['jin'] = '58158';
		$data['mu'] = '76504';
		$data['tu'] = '61163';
		$data['sui'] = '13205';
		$data['huo'] = '36047';
		$data['light'] = '39695';
		$data['dark'] = '65157';
		$model = new UserPetModel();
		$model->data($data)->save();

		$update = [];
		$update['userPetId'] = $model->userPetId;
		$update['petId'] = '23702';
		$update['name'] = '测试文本kdXOBI';
		$update['type'] = '测试文本gYZ1LU';
		$update['isUse'] = '90767';
		$update['description'] = '测试文本eXWcJw';
		$update['level'] = '23701';
		$update['exp'] = '21655';
		$update['isBest'] = '3';
		$update['hp'] = '54014';
		$update['mp'] = '90418';
		$update['attack'] = '15674';
		$update['defense'] = '30033';
		$update['endurance'] = '18168';
		$update['intellect'] = '57162';
		$update['strength'] = '84939';
		$update['enduranceQualification'] = '37303';
		$update['intellectQualification'] = '88636';
		$update['strengthQualification'] = '68760';
		$update['criticalRate'] = '67928';
		$update['criticalStrikeDamage'] = '51721';
		$update['hitRate'] = '70873';
		$update['dodgeRate'] = '88880';
		$update['penetrate'] = '90614';
		$update['attackSpeed'] = '37628';
		$update['userElement'] = '25047';
		$update['attackElement'] = '53742';
		$update['jin'] = '22165';
		$update['mu'] = '91819';
		$update['tu'] = '43899';
		$update['sui'] = '42426';
		$update['huo'] = '14160';
		$update['light'] = '92237';
		$update['dark'] = '63982';
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
		$data['petId'] = '27753';
		$data['name'] = '测试文本iWsR7g';
		$data['type'] = '测试文本MrVkEL';
		$data['isUse'] = '96229';
		$data['description'] = '测试文本4H1Qoi';
		$data['level'] = '10202';
		$data['exp'] = '50173';
		$data['isBest'] = '0';
		$data['hp'] = '38931';
		$data['mp'] = '87659';
		$data['attack'] = '84597';
		$data['defense'] = '90553';
		$data['endurance'] = '58627';
		$data['intellect'] = '44761';
		$data['strength'] = '65881';
		$data['enduranceQualification'] = '89595';
		$data['intellectQualification'] = '80451';
		$data['strengthQualification'] = '14077';
		$data['criticalRate'] = '86231';
		$data['criticalStrikeDamage'] = '99180';
		$data['hitRate'] = '55598';
		$data['dodgeRate'] = '46633';
		$data['penetrate'] = '77176';
		$data['attackSpeed'] = '86468';
		$data['userElement'] = '83546';
		$data['attackElement'] = '62344';
		$data['jin'] = '32072';
		$data['mu'] = '42715';
		$data['tu'] = '58970';
		$data['sui'] = '32133';
		$data['huo'] = '55472';
		$data['light'] = '20145';
		$data['dark'] = '43421';
		$model = new UserPetModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userPetId'] = $model->userPetId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

