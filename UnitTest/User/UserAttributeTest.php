<?php

namespace UnitTest\User;

use UserAttributeModel;

/**
 * UserAttributeTest
 * Class UserAttributeTest
 * Create With ClassGeneration
 */
class UserAttributeTest extends UserBaseTestCase
{
	public $modelName = 'UserAttribute';


	public function testAdd()
	{
		$data = [];
		$data['level'] = '78957';
		$data['exp'] = '19945';
		$data['hp'] = '69504';
		$data['mp'] = '15205';
		$data['attack'] = '93872';
		$data['defense'] = '66510';
		$data['endurance'] = '25909';
		$data['intellect'] = '37384';
		$data['strength'] = '55289';
		$data['enduranceQualification'] = '64684';
		$data['intellectQualification'] = '42174';
		$data['strengthQualification'] = '15154';
		$data['criticalRate'] = '30455';
		$data['criticalStrikeDamage'] = '11980';
		$data['hitRate'] = '31043';
		$data['penetrate'] = '14622';
		$data['attackSpeed'] = '83573';
		$data['userElement'] = '31134';
		$data['attackElement'] = '33797';
		$data['jin'] = '97570';
		$data['mu'] = '44636';
		$data['tu'] = '64225';
		$data['sui'] = '10071';
		$data['huo'] = '36489';
		$data['light'] = '31522';
		$data['dark'] = '98889';
		$data['luck'] = '86877';
		$data['physicalStrength'] = '26899';
		$response = $this->request('add',$data);
		$model = new UserAttributeModel();
		$model->destroy($response->result->userId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['level'] = '68952';
		$data['exp'] = '82517';
		$data['hp'] = '95478';
		$data['mp'] = '21054';
		$data['attack'] = '80242';
		$data['defense'] = '20554';
		$data['endurance'] = '61702';
		$data['intellect'] = '77578';
		$data['strength'] = '78616';
		$data['enduranceQualification'] = '51012';
		$data['intellectQualification'] = '54138';
		$data['strengthQualification'] = '85314';
		$data['criticalRate'] = '96307';
		$data['criticalStrikeDamage'] = '36335';
		$data['hitRate'] = '98994';
		$data['penetrate'] = '47591';
		$data['attackSpeed'] = '60907';
		$data['userElement'] = '94740';
		$data['attackElement'] = '49067';
		$data['jin'] = '28264';
		$data['mu'] = '96030';
		$data['tu'] = '59277';
		$data['sui'] = '81114';
		$data['huo'] = '16347';
		$data['light'] = '26519';
		$data['dark'] = '44383';
		$data['luck'] = '36590';
		$data['physicalStrength'] = '94253';
		$model = new UserAttributeModel();
		$model->data($data)->save();

		$data = [];
		$data['userId'] = $model->userId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->userId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['level'] = '96334';
		$data['exp'] = '79093';
		$data['hp'] = '49138';
		$data['mp'] = '21439';
		$data['attack'] = '30725';
		$data['defense'] = '95405';
		$data['endurance'] = '82448';
		$data['intellect'] = '44995';
		$data['strength'] = '44697';
		$data['enduranceQualification'] = '22228';
		$data['intellectQualification'] = '74112';
		$data['strengthQualification'] = '57363';
		$data['criticalRate'] = '48119';
		$data['criticalStrikeDamage'] = '16031';
		$data['hitRate'] = '58371';
		$data['penetrate'] = '92398';
		$data['attackSpeed'] = '19917';
		$data['userElement'] = '52023';
		$data['attackElement'] = '80976';
		$data['jin'] = '58890';
		$data['mu'] = '32800';
		$data['tu'] = '27719';
		$data['sui'] = '60686';
		$data['huo'] = '33572';
		$data['light'] = '12967';
		$data['dark'] = '49243';
		$data['luck'] = '75224';
		$data['physicalStrength'] = '57451';
		$model = new UserAttributeModel();
		$model->data($data)->save();

		$update = [];
		$update['userId'] = $model->userId;
		$update['level'] = '15734';
		$update['exp'] = '87661';
		$update['hp'] = '28568';
		$update['mp'] = '78718';
		$update['attack'] = '39561';
		$update['defense'] = '93519';
		$update['endurance'] = '83891';
		$update['intellect'] = '44737';
		$update['strength'] = '82043';
		$update['enduranceQualification'] = '30839';
		$update['intellectQualification'] = '77817';
		$update['strengthQualification'] = '46254';
		$update['criticalRate'] = '81414';
		$update['criticalStrikeDamage'] = '48269';
		$update['hitRate'] = '18143';
		$update['penetrate'] = '54675';
		$update['attackSpeed'] = '42118';
		$update['userElement'] = '94248';
		$update['attackElement'] = '51169';
		$update['jin'] = '78416';
		$update['mu'] = '15617';
		$update['tu'] = '53139';
		$update['sui'] = '88452';
		$update['huo'] = '76991';
		$update['light'] = '83773';
		$update['dark'] = '99141';
		$update['luck'] = '67714';
		$update['physicalStrength'] = '42866';
		$response = $this->request('update',$update);
		$model->destroy($model->userId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new UserAttributeModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['level'] = '12006';
		$data['exp'] = '19769';
		$data['hp'] = '28994';
		$data['mp'] = '57157';
		$data['attack'] = '30857';
		$data['defense'] = '48538';
		$data['endurance'] = '95800';
		$data['intellect'] = '80732';
		$data['strength'] = '75563';
		$data['enduranceQualification'] = '55977';
		$data['intellectQualification'] = '66217';
		$data['strengthQualification'] = '66737';
		$data['criticalRate'] = '91785';
		$data['criticalStrikeDamage'] = '18255';
		$data['hitRate'] = '50353';
		$data['penetrate'] = '58870';
		$data['attackSpeed'] = '49244';
		$data['userElement'] = '84845';
		$data['attackElement'] = '94034';
		$data['jin'] = '21999';
		$data['mu'] = '93199';
		$data['tu'] = '60000';
		$data['sui'] = '32054';
		$data['huo'] = '99375';
		$data['light'] = '67562';
		$data['dark'] = '66982';
		$data['luck'] = '96257';
		$data['physicalStrength'] = '27663';
		$model = new UserAttributeModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userId'] = $model->userId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

