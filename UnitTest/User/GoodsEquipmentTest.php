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
		$data['equipmentType'] = '2';
		$data['goodsName'] = '测试文本PHurm4';
		$data['suitCode'] = '测试文本653qrM';
		$data['strengthenLevel'] = '60083';
		$data['rarityLevel'] = '15586';
		$data['level'] = '25772';
		$data['hp'] = '81324';
		$data['mp'] = '70857';
		$data['attack'] = '40948';
		$data['defense'] = '63671';
		$data['endurance'] = '80865';
		$data['intellect'] = '55758';
		$data['strength'] = '91014';
		$data['enduranceQualification'] = '76449';
		$data['intellectQualification'] = '43056';
		$data['strengthQualification'] = '62595';
		$data['criticalRate'] = '83715';
		$data['criticalStrikeDamage'] = '64574';
		$data['hitRate'] = '43588';
		$data['dodgeRate'] = '31076';
		$data['penetrate'] = '79426';
		$data['attackSpeed'] = '27635';
		$data['userElement'] = '68534';
		$data['attackElement'] = '88291';
		$data['jin'] = '35812';
		$data['mu'] = '81269';
		$data['tu'] = '73327';
		$data['sui'] = '87434';
		$data['huo'] = '23015';
		$data['light'] = '90966';
		$data['dark'] = '52802';
		$data['luck'] = '94583';
		$response = $this->request('add',$data);
		$model = new GoodsEquipmentModel();
		$model->destroy($response->result->goodsCode);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['equipmentType'] = '1';
		$data['goodsName'] = '测试文本6soIRY';
		$data['suitCode'] = '测试文本6BJfMz';
		$data['strengthenLevel'] = '73366';
		$data['rarityLevel'] = '53386';
		$data['level'] = '79818';
		$data['hp'] = '12312';
		$data['mp'] = '42938';
		$data['attack'] = '91634';
		$data['defense'] = '61269';
		$data['endurance'] = '12574';
		$data['intellect'] = '89334';
		$data['strength'] = '73136';
		$data['enduranceQualification'] = '52028';
		$data['intellectQualification'] = '70428';
		$data['strengthQualification'] = '94909';
		$data['criticalRate'] = '56986';
		$data['criticalStrikeDamage'] = '52252';
		$data['hitRate'] = '12885';
		$data['dodgeRate'] = '57926';
		$data['penetrate'] = '97997';
		$data['attackSpeed'] = '95515';
		$data['userElement'] = '28096';
		$data['attackElement'] = '66598';
		$data['jin'] = '86323';
		$data['mu'] = '86133';
		$data['tu'] = '12268';
		$data['sui'] = '38411';
		$data['huo'] = '72030';
		$data['light'] = '92287';
		$data['dark'] = '22669';
		$data['luck'] = '87892';
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
		$data['equipmentType'] = '0';
		$data['goodsName'] = '测试文本FpxPyv';
		$data['suitCode'] = '测试文本eT35C7';
		$data['strengthenLevel'] = '54867';
		$data['rarityLevel'] = '33242';
		$data['level'] = '71182';
		$data['hp'] = '32969';
		$data['mp'] = '46871';
		$data['attack'] = '35954';
		$data['defense'] = '40831';
		$data['endurance'] = '29619';
		$data['intellect'] = '28904';
		$data['strength'] = '16985';
		$data['enduranceQualification'] = '16521';
		$data['intellectQualification'] = '49375';
		$data['strengthQualification'] = '70840';
		$data['criticalRate'] = '98186';
		$data['criticalStrikeDamage'] = '86784';
		$data['hitRate'] = '71899';
		$data['dodgeRate'] = '22716';
		$data['penetrate'] = '92582';
		$data['attackSpeed'] = '14829';
		$data['userElement'] = '35774';
		$data['attackElement'] = '80534';
		$data['jin'] = '24697';
		$data['mu'] = '47659';
		$data['tu'] = '35739';
		$data['sui'] = '36838';
		$data['huo'] = '10208';
		$data['light'] = '37087';
		$data['dark'] = '39827';
		$data['luck'] = '50491';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$update = [];
		$update['goodsCode'] = $model->goodsCode;
		$update['equipmentType'] = '3';
		$update['goodsName'] = '测试文本NTSfec';
		$update['suitCode'] = '测试文本Grq0R1';
		$update['strengthenLevel'] = '18409';
		$update['rarityLevel'] = '20219';
		$update['level'] = '58070';
		$update['hp'] = '84381';
		$update['mp'] = '67984';
		$update['attack'] = '97229';
		$update['defense'] = '38092';
		$update['endurance'] = '16551';
		$update['intellect'] = '15924';
		$update['strength'] = '15492';
		$update['enduranceQualification'] = '53589';
		$update['intellectQualification'] = '88517';
		$update['strengthQualification'] = '62940';
		$update['criticalRate'] = '33646';
		$update['criticalStrikeDamage'] = '38855';
		$update['hitRate'] = '15468';
		$update['dodgeRate'] = '73192';
		$update['penetrate'] = '87943';
		$update['attackSpeed'] = '67783';
		$update['userElement'] = '31290';
		$update['attackElement'] = '13949';
		$update['jin'] = '57190';
		$update['mu'] = '68538';
		$update['tu'] = '44017';
		$update['sui'] = '97258';
		$update['huo'] = '48071';
		$update['light'] = '11671';
		$update['dark'] = '90676';
		$update['luck'] = '95690';
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
		$data['equipmentType'] = '3';
		$data['goodsName'] = '测试文本257olP';
		$data['suitCode'] = '测试文本WMPEfq';
		$data['strengthenLevel'] = '69711';
		$data['rarityLevel'] = '12652';
		$data['level'] = '82013';
		$data['hp'] = '51582';
		$data['mp'] = '20968';
		$data['attack'] = '13906';
		$data['defense'] = '56542';
		$data['endurance'] = '81394';
		$data['intellect'] = '36063';
		$data['strength'] = '81366';
		$data['enduranceQualification'] = '78489';
		$data['intellectQualification'] = '32211';
		$data['strengthQualification'] = '85217';
		$data['criticalRate'] = '94932';
		$data['criticalStrikeDamage'] = '51120';
		$data['hitRate'] = '65552';
		$data['dodgeRate'] = '74380';
		$data['penetrate'] = '48033';
		$data['attackSpeed'] = '80153';
		$data['userElement'] = '30702';
		$data['attackElement'] = '98830';
		$data['jin'] = '19496';
		$data['mu'] = '75658';
		$data['tu'] = '56355';
		$data['sui'] = '86207';
		$data['huo'] = '61665';
		$data['light'] = '85700';
		$data['dark'] = '80628';
		$data['luck'] = '97691';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$delData = [];
		$delData['goodsCode'] = $model->goodsCode;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

