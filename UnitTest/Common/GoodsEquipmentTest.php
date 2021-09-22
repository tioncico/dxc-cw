<?php

namespace UnitTest\Common;

use App\Model\GoodsEquipmentModel;

/**
 * GoodsEquipmentTest
 * Class GoodsEquipmentTest
 * Create With ClassGeneration
 */
class GoodsEquipmentTest extends CommonBaseTest
{
	public $modelName = '/Api/Common/GoodsEquipment';


	public function testAdd()
	{
		$data = [];
		$data['goodsCode'] = '测试文本WoGv86';
		$data['equipmentType'] = '1';
		$data['suitCode'] = '测试文本iVgJa5';
		$data['strengthenLevel'] = '76741';
		$data['rarityLevel'] = '91717';
		$data['level'] = '45225';
		$data['hp'] = '95288';
		$data['mp'] = '17758';
		$data['attack'] = '95938';
		$data['defense'] = '86043';
		$data['endurance'] = '70156';
		$data['intellect'] = '54648';
		$data['strength'] = '11586';
		$data['enduranceQualification'] = '75958';
		$data['intellectQualification'] = '17305';
		$data['strengthQualification'] = '65845';
		$data['criticalRate'] = '62985';
		$data['criticalStrikeDamage'] = '87320';
		$data['hitRate'] = '44037';
		$data['dodgeRate'] = '23740';
		$data['penetrate'] = '24453';
		$data['attackSpeed'] = '43884';
		$data['userElement'] = '87460';
		$data['attackElement'] = '48645';
		$data['jin'] = '16599';
		$data['mu'] = '61291';
		$data['tu'] = '93898';
		$data['sui'] = '49336';
		$data['huo'] = '81813';
		$data['light'] = '87562';
		$data['dark'] = '31505';
		$data['luck'] = '87173';
		$response = $this->request('add',$data);
		$model = new GoodsEquipmentModel();
		$model->destroy($response->result->goodsEquipmentId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['goodsCode'] = '测试文本NE8KAo';
		$data['equipmentType'] = '0';
		$data['suitCode'] = '测试文本VGcgzX';
		$data['strengthenLevel'] = '74598';
		$data['rarityLevel'] = '43462';
		$data['level'] = '37215';
		$data['hp'] = '54508';
		$data['mp'] = '33864';
		$data['attack'] = '42080';
		$data['defense'] = '25411';
		$data['endurance'] = '56457';
		$data['intellect'] = '42025';
		$data['strength'] = '13782';
		$data['enduranceQualification'] = '78362';
		$data['intellectQualification'] = '14694';
		$data['strengthQualification'] = '64703';
		$data['criticalRate'] = '51555';
		$data['criticalStrikeDamage'] = '57242';
		$data['hitRate'] = '31006';
		$data['dodgeRate'] = '19430';
		$data['penetrate'] = '11768';
		$data['attackSpeed'] = '60639';
		$data['userElement'] = '36965';
		$data['attackElement'] = '16275';
		$data['jin'] = '72391';
		$data['mu'] = '26620';
		$data['tu'] = '27047';
		$data['sui'] = '14079';
		$data['huo'] = '74836';
		$data['light'] = '52104';
		$data['dark'] = '58800';
		$data['luck'] = '24780';
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
		$data['goodsCode'] = '测试文本Eu3NO6';
		$data['equipmentType'] = '1';
		$data['suitCode'] = '测试文本HQKS3X';
		$data['strengthenLevel'] = '87325';
		$data['rarityLevel'] = '81542';
		$data['level'] = '13981';
		$data['hp'] = '95851';
		$data['mp'] = '95055';
		$data['attack'] = '16333';
		$data['defense'] = '45818';
		$data['endurance'] = '90931';
		$data['intellect'] = '85242';
		$data['strength'] = '18588';
		$data['enduranceQualification'] = '71984';
		$data['intellectQualification'] = '23313';
		$data['strengthQualification'] = '69008';
		$data['criticalRate'] = '20611';
		$data['criticalStrikeDamage'] = '63459';
		$data['hitRate'] = '88813';
		$data['dodgeRate'] = '67098';
		$data['penetrate'] = '51961';
		$data['attackSpeed'] = '93924';
		$data['userElement'] = '30082';
		$data['attackElement'] = '60767';
		$data['jin'] = '37615';
		$data['mu'] = '34162';
		$data['tu'] = '43079';
		$data['sui'] = '34432';
		$data['huo'] = '13317';
		$data['light'] = '39313';
		$data['dark'] = '86611';
		$data['luck'] = '72916';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$update = [];
		$update['goodsEquipmentId'] = $model->goodsEquipmentId;
		$update['goodsCode'] = '测试文本hE4LBX';
		$update['equipmentType'] = '3';
		$update['suitCode'] = '测试文本hxdJrm';
		$update['strengthenLevel'] = '64520';
		$update['rarityLevel'] = '33567';
		$update['level'] = '92466';
		$update['hp'] = '78571';
		$update['mp'] = '46662';
		$update['attack'] = '24996';
		$update['defense'] = '76649';
		$update['endurance'] = '81200';
		$update['intellect'] = '54387';
		$update['strength'] = '94391';
		$update['enduranceQualification'] = '26403';
		$update['intellectQualification'] = '68883';
		$update['strengthQualification'] = '82709';
		$update['criticalRate'] = '70578';
		$update['criticalStrikeDamage'] = '11883';
		$update['hitRate'] = '60517';
		$update['dodgeRate'] = '92898';
		$update['penetrate'] = '15904';
		$update['attackSpeed'] = '72480';
		$update['userElement'] = '25841';
		$update['attackElement'] = '92896';
		$update['jin'] = '65599';
		$update['mu'] = '52857';
		$update['tu'] = '31386';
		$update['sui'] = '22682';
		$update['huo'] = '52957';
		$update['light'] = '16513';
		$update['dark'] = '82219';
		$update['luck'] = '31788';
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
		$data['goodsCode'] = '测试文本adfMJL';
		$data['equipmentType'] = '0';
		$data['suitCode'] = '测试文本rxOJdb';
		$data['strengthenLevel'] = '61989';
		$data['rarityLevel'] = '98747';
		$data['level'] = '49999';
		$data['hp'] = '76218';
		$data['mp'] = '91697';
		$data['attack'] = '55506';
		$data['defense'] = '65989';
		$data['endurance'] = '22125';
		$data['intellect'] = '24534';
		$data['strength'] = '89442';
		$data['enduranceQualification'] = '63492';
		$data['intellectQualification'] = '75551';
		$data['strengthQualification'] = '99865';
		$data['criticalRate'] = '61309';
		$data['criticalStrikeDamage'] = '70399';
		$data['hitRate'] = '86682';
		$data['dodgeRate'] = '80987';
		$data['penetrate'] = '94481';
		$data['attackSpeed'] = '87949';
		$data['userElement'] = '90405';
		$data['attackElement'] = '25126';
		$data['jin'] = '35945';
		$data['mu'] = '78777';
		$data['tu'] = '80432';
		$data['sui'] = '14891';
		$data['huo'] = '75172';
		$data['light'] = '40713';
		$data['dark'] = '78091';
		$data['luck'] = '39323';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$delData = [];
		$delData['goodsEquipmentId'] = $model->goodsEquipmentId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

