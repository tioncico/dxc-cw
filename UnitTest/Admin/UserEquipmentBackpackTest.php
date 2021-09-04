<?php

namespace UnitTest\Admin;

use UserEquipmentBackpackModel;

/**
 * UserEquipmentBackpackTest
 * Class UserEquipmentBackpackTest
 * Create With ClassGeneration
 */
class UserEquipmentBackpackTest extends AdminBaseTestCase
{
	public $modelName = 'UserEquipmentBackpack';


	public function testAdd()
	{
		$data = [];
		$data['backpackId'] = '65540';
		$data['userId'] = '58930';
		$data['goodsCode'] = '测试文本XJYl0x';
		$data['equipmentType'] = '1';
		$data['suitCode'] = '测试文本MvFndi';
		$data['rarityLevel'] = '65913';
		$data['level'] = '59502';
		$data['hp'] = '71454';
		$data['mp'] = '98665';
		$data['attack'] = '63855';
		$data['defense'] = '56380';
		$data['endurance'] = '14365';
		$data['intellect'] = '39620';
		$data['strength'] = '37069';
		$data['enduranceQualification'] = '58842';
		$data['intellectQualification'] = '51581';
		$data['strengthQualification'] = '29742';
		$data['criticalRate'] = '63305';
		$data['criticalStrikeDamage'] = '74540';
		$data['hitRate'] = '98776';
		$data['penetrate'] = '52987';
		$data['attackSpeed'] = '84491';
		$data['userElement'] = '53206';
		$data['attackElement'] = '17549';
		$data['jin'] = '51496';
		$data['mu'] = '66799';
		$data['tu'] = '53180';
		$data['sui'] = '64534';
		$data['huo'] = '85915';
		$data['light'] = '30243';
		$data['dark'] = '36669';
		$data['luck'] = '87752';
		$data['physicalStrength'] = '25379';
		$response = $this->request('add',$data);
		$model = new UserEquipmentBackpackModel();
		$model->destroy($response->result->userEquipmentBackpackId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['backpackId'] = '80884';
		$data['userId'] = '87687';
		$data['goodsCode'] = '测试文本cTGmSu';
		$data['equipmentType'] = '1';
		$data['suitCode'] = '测试文本KbY3I5';
		$data['rarityLevel'] = '44799';
		$data['level'] = '43242';
		$data['hp'] = '35452';
		$data['mp'] = '92752';
		$data['attack'] = '87782';
		$data['defense'] = '96844';
		$data['endurance'] = '66094';
		$data['intellect'] = '29930';
		$data['strength'] = '73402';
		$data['enduranceQualification'] = '79453';
		$data['intellectQualification'] = '88145';
		$data['strengthQualification'] = '24839';
		$data['criticalRate'] = '30718';
		$data['criticalStrikeDamage'] = '59660';
		$data['hitRate'] = '14723';
		$data['penetrate'] = '51453';
		$data['attackSpeed'] = '33774';
		$data['userElement'] = '23219';
		$data['attackElement'] = '15590';
		$data['jin'] = '97656';
		$data['mu'] = '71733';
		$data['tu'] = '59810';
		$data['sui'] = '18950';
		$data['huo'] = '50128';
		$data['light'] = '71633';
		$data['dark'] = '77839';
		$data['luck'] = '95670';
		$data['physicalStrength'] = '20947';
		$model = new UserEquipmentBackpackModel();
		$model->data($data)->save();

		$data = [];
		$data['userEquipmentBackpackId'] = $model->userEquipmentBackpackId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->userEquipmentBackpackId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['backpackId'] = '54703';
		$data['userId'] = '33037';
		$data['goodsCode'] = '测试文本VA2uN8';
		$data['equipmentType'] = '0';
		$data['suitCode'] = '测试文本oVfPvI';
		$data['rarityLevel'] = '78124';
		$data['level'] = '45555';
		$data['hp'] = '86983';
		$data['mp'] = '20883';
		$data['attack'] = '97357';
		$data['defense'] = '62552';
		$data['endurance'] = '49672';
		$data['intellect'] = '55352';
		$data['strength'] = '31786';
		$data['enduranceQualification'] = '12839';
		$data['intellectQualification'] = '24024';
		$data['strengthQualification'] = '19727';
		$data['criticalRate'] = '22750';
		$data['criticalStrikeDamage'] = '72696';
		$data['hitRate'] = '82299';
		$data['penetrate'] = '28552';
		$data['attackSpeed'] = '99893';
		$data['userElement'] = '38729';
		$data['attackElement'] = '73038';
		$data['jin'] = '13185';
		$data['mu'] = '73476';
		$data['tu'] = '72985';
		$data['sui'] = '87396';
		$data['huo'] = '19913';
		$data['light'] = '50387';
		$data['dark'] = '28702';
		$data['luck'] = '38595';
		$data['physicalStrength'] = '72240';
		$model = new UserEquipmentBackpackModel();
		$model->data($data)->save();

		$update = [];
		$update['userEquipmentBackpackId'] = $model->userEquipmentBackpackId;
		$update['backpackId'] = '61097';
		$update['userId'] = '34270';
		$update['goodsCode'] = '测试文本Cg7ISb';
		$update['equipmentType'] = '1';
		$update['suitCode'] = '测试文本ywH12l';
		$update['rarityLevel'] = '83053';
		$update['level'] = '50280';
		$update['hp'] = '48151';
		$update['mp'] = '58624';
		$update['attack'] = '57962';
		$update['defense'] = '47381';
		$update['endurance'] = '24851';
		$update['intellect'] = '10695';
		$update['strength'] = '84314';
		$update['enduranceQualification'] = '25989';
		$update['intellectQualification'] = '24708';
		$update['strengthQualification'] = '27649';
		$update['criticalRate'] = '33742';
		$update['criticalStrikeDamage'] = '28121';
		$update['hitRate'] = '50044';
		$update['penetrate'] = '51355';
		$update['attackSpeed'] = '75626';
		$update['userElement'] = '65278';
		$update['attackElement'] = '63882';
		$update['jin'] = '81684';
		$update['mu'] = '41786';
		$update['tu'] = '87856';
		$update['sui'] = '25019';
		$update['huo'] = '90039';
		$update['light'] = '73973';
		$update['dark'] = '33401';
		$update['luck'] = '15960';
		$update['physicalStrength'] = '75980';
		$response = $this->request('update',$update);
		$model->destroy($model->userEquipmentBackpackId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new UserEquipmentBackpackModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['backpackId'] = '33209';
		$data['userId'] = '29517';
		$data['goodsCode'] = '测试文本PdCnBK';
		$data['equipmentType'] = '1';
		$data['suitCode'] = '测试文本6qod0s';
		$data['rarityLevel'] = '56198';
		$data['level'] = '60250';
		$data['hp'] = '59292';
		$data['mp'] = '53337';
		$data['attack'] = '92274';
		$data['defense'] = '70730';
		$data['endurance'] = '75029';
		$data['intellect'] = '99433';
		$data['strength'] = '28859';
		$data['enduranceQualification'] = '59178';
		$data['intellectQualification'] = '44043';
		$data['strengthQualification'] = '93147';
		$data['criticalRate'] = '99573';
		$data['criticalStrikeDamage'] = '91490';
		$data['hitRate'] = '92461';
		$data['penetrate'] = '18532';
		$data['attackSpeed'] = '46488';
		$data['userElement'] = '26826';
		$data['attackElement'] = '54631';
		$data['jin'] = '74482';
		$data['mu'] = '73895';
		$data['tu'] = '77442';
		$data['sui'] = '65710';
		$data['huo'] = '43621';
		$data['light'] = '13951';
		$data['dark'] = '57138';
		$data['luck'] = '39127';
		$data['physicalStrength'] = '56865';
		$model = new UserEquipmentBackpackModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userEquipmentBackpackId'] = $model->userEquipmentBackpackId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

