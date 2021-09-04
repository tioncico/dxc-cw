<?php

namespace UnitTest\User;

use GoodsEquipmentModel;

/**
 * GoodsEquipmentTest
 * Class GoodsEquipmentTest
 * Create With ClassGeneration
 */
class GoodsEquipmentTest extends UserBaseTestCase
{
	public $modelName = 'GoodsEquipment';


	public function testAdd()
	{
		$data = [];
		$data['goodsCode'] = '测试文本NLvTgq';
		$data['equipmentType'] = '0';
		$data['suitCode'] = '测试文本zBxrfb';
		$data['rarityLevel'] = '39869';
		$data['level'] = '91701';
		$data['hp'] = '32936';
		$data['mp'] = '15348';
		$data['attack'] = '71478';
		$data['defense'] = '34051';
		$data['endurance'] = '73993';
		$data['intellect'] = '97660';
		$data['strength'] = '35421';
		$data['enduranceQualification'] = '83713';
		$data['intellectQualification'] = '28445';
		$data['strengthQualification'] = '44982';
		$data['criticalRate'] = '55858';
		$data['criticalStrikeDamage'] = '82645';
		$data['hitRate'] = '47401';
		$data['penetrate'] = '22407';
		$data['attackSpeed'] = '39945';
		$data['userElement'] = '96556';
		$data['attackElement'] = '81683';
		$data['jin'] = '98885';
		$data['mu'] = '59235';
		$data['tu'] = '75096';
		$data['sui'] = '24927';
		$data['huo'] = '26221';
		$data['light'] = '51538';
		$data['dark'] = '68132';
		$data['luck'] = '11573';
		$response = $this->request('add',$data);
		$model = new GoodsEquipmentModel();
		$model->destroy($response->result->goodsEquipmentId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['goodsCode'] = '测试文本2UlvZg';
		$data['equipmentType'] = '2';
		$data['suitCode'] = '测试文本CpOjb9';
		$data['rarityLevel'] = '66961';
		$data['level'] = '78566';
		$data['hp'] = '90461';
		$data['mp'] = '49790';
		$data['attack'] = '16080';
		$data['defense'] = '60561';
		$data['endurance'] = '46864';
		$data['intellect'] = '12871';
		$data['strength'] = '51856';
		$data['enduranceQualification'] = '84676';
		$data['intellectQualification'] = '97499';
		$data['strengthQualification'] = '77398';
		$data['criticalRate'] = '38822';
		$data['criticalStrikeDamage'] = '20673';
		$data['hitRate'] = '97144';
		$data['penetrate'] = '15518';
		$data['attackSpeed'] = '21114';
		$data['userElement'] = '43989';
		$data['attackElement'] = '26196';
		$data['jin'] = '85573';
		$data['mu'] = '79733';
		$data['tu'] = '76824';
		$data['sui'] = '67075';
		$data['huo'] = '53264';
		$data['light'] = '15034';
		$data['dark'] = '36333';
		$data['luck'] = '90878';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$data = [];
		$data['goodsEquipmentId'] = $model->goodsEquipmentId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->goodsEquipmentId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['goodsCode'] = '测试文本YmeCja';
		$data['equipmentType'] = '2';
		$data['suitCode'] = '测试文本HvxOBk';
		$data['rarityLevel'] = '36054';
		$data['level'] = '88433';
		$data['hp'] = '20429';
		$data['mp'] = '41169';
		$data['attack'] = '79321';
		$data['defense'] = '48579';
		$data['endurance'] = '63728';
		$data['intellect'] = '30437';
		$data['strength'] = '50185';
		$data['enduranceQualification'] = '99534';
		$data['intellectQualification'] = '99976';
		$data['strengthQualification'] = '93893';
		$data['criticalRate'] = '28730';
		$data['criticalStrikeDamage'] = '18535';
		$data['hitRate'] = '58031';
		$data['penetrate'] = '51392';
		$data['attackSpeed'] = '33180';
		$data['userElement'] = '76933';
		$data['attackElement'] = '46632';
		$data['jin'] = '96480';
		$data['mu'] = '70550';
		$data['tu'] = '45744';
		$data['sui'] = '27725';
		$data['huo'] = '19272';
		$data['light'] = '55146';
		$data['dark'] = '19805';
		$data['luck'] = '46481';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$update = [];
		$update['goodsEquipmentId'] = $model->goodsEquipmentId;
		$update['goodsCode'] = '测试文本2p4o0W';
		$update['equipmentType'] = '0';
		$update['suitCode'] = '测试文本jib8AR';
		$update['rarityLevel'] = '54233';
		$update['level'] = '19039';
		$update['hp'] = '52627';
		$update['mp'] = '45120';
		$update['attack'] = '11999';
		$update['defense'] = '77986';
		$update['endurance'] = '63388';
		$update['intellect'] = '74060';
		$update['strength'] = '71326';
		$update['enduranceQualification'] = '55516';
		$update['intellectQualification'] = '79124';
		$update['strengthQualification'] = '99865';
		$update['criticalRate'] = '94835';
		$update['criticalStrikeDamage'] = '38928';
		$update['hitRate'] = '98935';
		$update['penetrate'] = '53448';
		$update['attackSpeed'] = '85138';
		$update['userElement'] = '88535';
		$update['attackElement'] = '87240';
		$update['jin'] = '46540';
		$update['mu'] = '39172';
		$update['tu'] = '97600';
		$update['sui'] = '70325';
		$update['huo'] = '67140';
		$update['light'] = '53996';
		$update['dark'] = '42540';
		$update['luck'] = '57163';
		$response = $this->request('update',$update);
		$model->destroy($model->goodsEquipmentId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new GoodsEquipmentModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['goodsCode'] = '测试文本Xt6mp1';
		$data['equipmentType'] = '0';
		$data['suitCode'] = '测试文本i2XT0a';
		$data['rarityLevel'] = '47730';
		$data['level'] = '44419';
		$data['hp'] = '46113';
		$data['mp'] = '51957';
		$data['attack'] = '36719';
		$data['defense'] = '59690';
		$data['endurance'] = '29607';
		$data['intellect'] = '64985';
		$data['strength'] = '85778';
		$data['enduranceQualification'] = '80478';
		$data['intellectQualification'] = '55424';
		$data['strengthQualification'] = '19671';
		$data['criticalRate'] = '58408';
		$data['criticalStrikeDamage'] = '27550';
		$data['hitRate'] = '90110';
		$data['penetrate'] = '74832';
		$data['attackSpeed'] = '25210';
		$data['userElement'] = '37005';
		$data['attackElement'] = '25452';
		$data['jin'] = '50787';
		$data['mu'] = '97787';
		$data['tu'] = '53158';
		$data['sui'] = '19443';
		$data['huo'] = '59199';
		$data['light'] = '99245';
		$data['dark'] = '47148';
		$data['luck'] = '74946';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$delData = [];
		$delData['goodsEquipmentId'] = $model->goodsEquipmentId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

