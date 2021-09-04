<?php

namespace UnitTest\User;

use UserEquipmentBackpackModel;

/**
 * UserEquipmentBackpackTest
 * Class UserEquipmentBackpackTest
 * Create With ClassGeneration
 */
class UserEquipmentBackpackTest extends UserBaseTestCase
{
	public $modelName = 'UserEquipmentBackpack';


	public function testAdd()
	{
		$data = [];
		$data['backpackId'] = '45593';
		$data['userId'] = '99596';
		$data['goodsCode'] = '测试文本yTzIEr';
		$data['equipmentType'] = '0';
		$data['suitCode'] = '测试文本O1tHpG';
		$data['rarityLevel'] = '98905';
		$data['level'] = '20961';
		$data['hp'] = '95484';
		$data['mp'] = '64470';
		$data['attack'] = '52734';
		$data['defense'] = '97562';
		$data['endurance'] = '79673';
		$data['intellect'] = '45713';
		$data['strength'] = '34439';
		$data['enduranceQualification'] = '74751';
		$data['intellectQualification'] = '35728';
		$data['strengthQualification'] = '44335';
		$data['criticalRate'] = '27648';
		$data['criticalStrikeDamage'] = '54163';
		$data['hitRate'] = '47679';
		$data['penetrate'] = '67525';
		$data['attackSpeed'] = '53865';
		$data['userElement'] = '80967';
		$data['attackElement'] = '78116';
		$data['jin'] = '21292';
		$data['mu'] = '69285';
		$data['tu'] = '70953';
		$data['sui'] = '98281';
		$data['huo'] = '41215';
		$data['light'] = '77672';
		$data['dark'] = '58665';
		$data['luck'] = '47424';
		$data['physicalStrength'] = '28453';
		$response = $this->request('add',$data);
		$model = new UserEquipmentBackpackModel();
		$model->destroy($response->result->userEquipmentBackpackId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['backpackId'] = '75233';
		$data['userId'] = '58710';
		$data['goodsCode'] = '测试文本zHwOUh';
		$data['equipmentType'] = '3';
		$data['suitCode'] = '测试文本otc3Bv';
		$data['rarityLevel'] = '60468';
		$data['level'] = '69896';
		$data['hp'] = '11224';
		$data['mp'] = '58285';
		$data['attack'] = '82742';
		$data['defense'] = '95535';
		$data['endurance'] = '41311';
		$data['intellect'] = '77149';
		$data['strength'] = '14806';
		$data['enduranceQualification'] = '54346';
		$data['intellectQualification'] = '43455';
		$data['strengthQualification'] = '37779';
		$data['criticalRate'] = '71545';
		$data['criticalStrikeDamage'] = '40165';
		$data['hitRate'] = '17331';
		$data['penetrate'] = '85263';
		$data['attackSpeed'] = '35957';
		$data['userElement'] = '84385';
		$data['attackElement'] = '40017';
		$data['jin'] = '59878';
		$data['mu'] = '73477';
		$data['tu'] = '58803';
		$data['sui'] = '67907';
		$data['huo'] = '83613';
		$data['light'] = '76471';
		$data['dark'] = '70559';
		$data['luck'] = '17860';
		$data['physicalStrength'] = '44694';
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
		$data['backpackId'] = '99985';
		$data['userId'] = '73044';
		$data['goodsCode'] = '测试文本hOk9JM';
		$data['equipmentType'] = '1';
		$data['suitCode'] = '测试文本fcQ6pJ';
		$data['rarityLevel'] = '46091';
		$data['level'] = '95867';
		$data['hp'] = '37100';
		$data['mp'] = '85160';
		$data['attack'] = '94375';
		$data['defense'] = '49347';
		$data['endurance'] = '24916';
		$data['intellect'] = '63001';
		$data['strength'] = '22020';
		$data['enduranceQualification'] = '71090';
		$data['intellectQualification'] = '84165';
		$data['strengthQualification'] = '61047';
		$data['criticalRate'] = '93612';
		$data['criticalStrikeDamage'] = '48564';
		$data['hitRate'] = '59356';
		$data['penetrate'] = '15268';
		$data['attackSpeed'] = '57131';
		$data['userElement'] = '27829';
		$data['attackElement'] = '26416';
		$data['jin'] = '69018';
		$data['mu'] = '13321';
		$data['tu'] = '32735';
		$data['sui'] = '36646';
		$data['huo'] = '68084';
		$data['light'] = '89262';
		$data['dark'] = '61498';
		$data['luck'] = '25898';
		$data['physicalStrength'] = '26751';
		$model = new UserEquipmentBackpackModel();
		$model->data($data)->save();

		$update = [];
		$update['userEquipmentBackpackId'] = $model->userEquipmentBackpackId;
		$update['backpackId'] = '14181';
		$update['userId'] = '73998';
		$update['goodsCode'] = '测试文本VHia9b';
		$update['equipmentType'] = '3';
		$update['suitCode'] = '测试文本z0wK8b';
		$update['rarityLevel'] = '19420';
		$update['level'] = '93541';
		$update['hp'] = '59226';
		$update['mp'] = '99789';
		$update['attack'] = '62990';
		$update['defense'] = '64023';
		$update['endurance'] = '15705';
		$update['intellect'] = '72137';
		$update['strength'] = '47727';
		$update['enduranceQualification'] = '19023';
		$update['intellectQualification'] = '53697';
		$update['strengthQualification'] = '27895';
		$update['criticalRate'] = '57046';
		$update['criticalStrikeDamage'] = '51079';
		$update['hitRate'] = '90842';
		$update['penetrate'] = '24439';
		$update['attackSpeed'] = '44594';
		$update['userElement'] = '45776';
		$update['attackElement'] = '42656';
		$update['jin'] = '56461';
		$update['mu'] = '97232';
		$update['tu'] = '70981';
		$update['sui'] = '50276';
		$update['huo'] = '97400';
		$update['light'] = '37890';
		$update['dark'] = '52435';
		$update['luck'] = '26314';
		$update['physicalStrength'] = '98646';
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
		$data['backpackId'] = '27941';
		$data['userId'] = '47735';
		$data['goodsCode'] = '测试文本ahxJe9';
		$data['equipmentType'] = '0';
		$data['suitCode'] = '测试文本bfBc2z';
		$data['rarityLevel'] = '76416';
		$data['level'] = '30713';
		$data['hp'] = '91225';
		$data['mp'] = '74577';
		$data['attack'] = '55586';
		$data['defense'] = '22913';
		$data['endurance'] = '19866';
		$data['intellect'] = '58712';
		$data['strength'] = '17697';
		$data['enduranceQualification'] = '30567';
		$data['intellectQualification'] = '56834';
		$data['strengthQualification'] = '25078';
		$data['criticalRate'] = '36687';
		$data['criticalStrikeDamage'] = '75116';
		$data['hitRate'] = '53070';
		$data['penetrate'] = '41432';
		$data['attackSpeed'] = '67958';
		$data['userElement'] = '41798';
		$data['attackElement'] = '56804';
		$data['jin'] = '94027';
		$data['mu'] = '86545';
		$data['tu'] = '21131';
		$data['sui'] = '58198';
		$data['huo'] = '61807';
		$data['light'] = '87220';
		$data['dark'] = '44641';
		$data['luck'] = '20054';
		$data['physicalStrength'] = '80450';
		$model = new UserEquipmentBackpackModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userEquipmentBackpackId'] = $model->userEquipmentBackpackId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

