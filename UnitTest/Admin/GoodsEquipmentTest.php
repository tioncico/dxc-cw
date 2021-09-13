<?php

namespace UnitTest\Admin;

use GoodsEquipmentModel;

/**
 * GoodsEquipmentTest
 * Class GoodsEquipmentTest
 * Create With ClassGeneration
 */
class GoodsEquipmentTest extends AdminBaseTestCase
{
	public $modelName = 'GoodsEquipment';


	public function testAdd()
	{
		$data = [];
		$data['equipmentType'] = '3';
		$data['goodsName'] = '测试文本YiKBNo';
		$data['suitCode'] = '测试文本OQyoI6';
		$data['strengthenLevel'] = '51754';
		$data['rarityLevel'] = '57911';
		$data['level'] = '56404';
		$data['hp'] = '61996';
		$data['mp'] = '60933';
		$data['attack'] = '91376';
		$data['defense'] = '97372';
		$data['endurance'] = '18317';
		$data['intellect'] = '27917';
		$data['strength'] = '65054';
		$data['enduranceQualification'] = '97818';
		$data['intellectQualification'] = '29709';
		$data['strengthQualification'] = '67747';
		$data['criticalRate'] = '62255';
		$data['criticalStrikeDamage'] = '64192';
		$data['hitRate'] = '53942';
		$data['dodgeRate'] = '75758';
		$data['penetrate'] = '11297';
		$data['attackSpeed'] = '32121';
		$data['userElement'] = '45604';
		$data['attackElement'] = '78588';
		$data['jin'] = '16176';
		$data['mu'] = '20373';
		$data['tu'] = '81683';
		$data['sui'] = '57726';
		$data['huo'] = '12187';
		$data['light'] = '97637';
		$data['dark'] = '74141';
		$data['luck'] = '58580';
		$response = $this->request('add',$data);
		$model = new GoodsEquipmentModel();
		$model->destroy($response->result->goodsCode);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['equipmentType'] = '3';
		$data['goodsName'] = '测试文本kAh2mX';
		$data['suitCode'] = '测试文本zpYXrk';
		$data['strengthenLevel'] = '94580';
		$data['rarityLevel'] = '54923';
		$data['level'] = '30439';
		$data['hp'] = '33523';
		$data['mp'] = '23450';
		$data['attack'] = '59608';
		$data['defense'] = '57169';
		$data['endurance'] = '84610';
		$data['intellect'] = '26558';
		$data['strength'] = '89194';
		$data['enduranceQualification'] = '83212';
		$data['intellectQualification'] = '75325';
		$data['strengthQualification'] = '66637';
		$data['criticalRate'] = '26101';
		$data['criticalStrikeDamage'] = '64216';
		$data['hitRate'] = '88574';
		$data['dodgeRate'] = '34473';
		$data['penetrate'] = '94396';
		$data['attackSpeed'] = '57884';
		$data['userElement'] = '55969';
		$data['attackElement'] = '17243';
		$data['jin'] = '99213';
		$data['mu'] = '54824';
		$data['tu'] = '75387';
		$data['sui'] = '98978';
		$data['huo'] = '83429';
		$data['light'] = '85171';
		$data['dark'] = '81005';
		$data['luck'] = '32596';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$data = [];
		$data['goodsCode'] = $model->goodsCode;
		$response = $this->request('getOne',$data);
		$model->destroy($model->goodsCode);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['equipmentType'] = '1';
		$data['goodsName'] = '测试文本lYEfhx';
		$data['suitCode'] = '测试文本GcHLPq';
		$data['strengthenLevel'] = '48952';
		$data['rarityLevel'] = '42104';
		$data['level'] = '35001';
		$data['hp'] = '35081';
		$data['mp'] = '80063';
		$data['attack'] = '58730';
		$data['defense'] = '11021';
		$data['endurance'] = '92891';
		$data['intellect'] = '81012';
		$data['strength'] = '14547';
		$data['enduranceQualification'] = '79178';
		$data['intellectQualification'] = '74260';
		$data['strengthQualification'] = '72772';
		$data['criticalRate'] = '17526';
		$data['criticalStrikeDamage'] = '46402';
		$data['hitRate'] = '53250';
		$data['dodgeRate'] = '10499';
		$data['penetrate'] = '85700';
		$data['attackSpeed'] = '10155';
		$data['userElement'] = '90461';
		$data['attackElement'] = '65721';
		$data['jin'] = '11055';
		$data['mu'] = '60700';
		$data['tu'] = '93097';
		$data['sui'] = '58117';
		$data['huo'] = '19901';
		$data['light'] = '29226';
		$data['dark'] = '93077';
		$data['luck'] = '82516';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$update = [];
		$update['goodsCode'] = $model->goodsCode;
		$update['equipmentType'] = '3';
		$update['goodsName'] = '测试文本yMkn75';
		$update['suitCode'] = '测试文本VgCE64';
		$update['strengthenLevel'] = '39626';
		$update['rarityLevel'] = '37252';
		$update['level'] = '77115';
		$update['hp'] = '48704';
		$update['mp'] = '54325';
		$update['attack'] = '51458';
		$update['defense'] = '98878';
		$update['endurance'] = '64550';
		$update['intellect'] = '80934';
		$update['strength'] = '92858';
		$update['enduranceQualification'] = '21206';
		$update['intellectQualification'] = '94955';
		$update['strengthQualification'] = '61682';
		$update['criticalRate'] = '32257';
		$update['criticalStrikeDamage'] = '63952';
		$update['hitRate'] = '64402';
		$update['dodgeRate'] = '77099';
		$update['penetrate'] = '51518';
		$update['attackSpeed'] = '81267';
		$update['userElement'] = '95197';
		$update['attackElement'] = '84587';
		$update['jin'] = '92546';
		$update['mu'] = '18866';
		$update['tu'] = '91859';
		$update['sui'] = '32934';
		$update['huo'] = '97106';
		$update['light'] = '12586';
		$update['dark'] = '27527';
		$update['luck'] = '93847';
		$response = $this->request('update',$update);
		$model->destroy($model->goodsCode);
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
		$data['equipmentType'] = '1';
		$data['goodsName'] = '测试文本1ERq5m';
		$data['suitCode'] = '测试文本HqS32U';
		$data['strengthenLevel'] = '66689';
		$data['rarityLevel'] = '38634';
		$data['level'] = '92045';
		$data['hp'] = '22037';
		$data['mp'] = '85762';
		$data['attack'] = '88156';
		$data['defense'] = '49811';
		$data['endurance'] = '81709';
		$data['intellect'] = '94061';
		$data['strength'] = '91115';
		$data['enduranceQualification'] = '76759';
		$data['intellectQualification'] = '66433';
		$data['strengthQualification'] = '19177';
		$data['criticalRate'] = '98320';
		$data['criticalStrikeDamage'] = '88980';
		$data['hitRate'] = '61197';
		$data['dodgeRate'] = '69120';
		$data['penetrate'] = '91108';
		$data['attackSpeed'] = '29803';
		$data['userElement'] = '54035';
		$data['attackElement'] = '72923';
		$data['jin'] = '81858';
		$data['mu'] = '41223';
		$data['tu'] = '42435';
		$data['sui'] = '84290';
		$data['huo'] = '32050';
		$data['light'] = '38650';
		$data['dark'] = '81894';
		$data['luck'] = '87188';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$delData = [];
		$delData['goodsCode'] = $model->goodsCode;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

