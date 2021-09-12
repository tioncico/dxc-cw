<?php

namespace UnitTest\Admin;

use App\Model\GoodsEquipmentModel;

/**
 * GoodsEquipmentTest
 * Class GoodsEquipmentTest
 * Create With ClassGeneration
 */
class GoodsEquipmentTest extends AdminBaseTestCase
{
	public $modelName = '/Api/Admin/GoodsEquipment';


	public function testAdd()
	{
		$data = [];
		$data['goodsCode'] = '测试文本TX2xrg';
		$data['equipmentType'] = '2';
		$data['suitCode'] = '测试文本ZpTnB3';
		$data['strengthenLevel'] = '77906';
		$data['rarityLevel'] = '86169';
		$data['level'] = '48514';
		$data['hp'] = '41524';
		$data['mp'] = '91708';
		$data['attack'] = '71219';
		$data['defense'] = '82353';
		$data['endurance'] = '93239';
		$data['intellect'] = '94897';
		$data['strength'] = '60619';
		$data['enduranceQualification'] = '41873';
		$data['intellectQualification'] = '39069';
		$data['strengthQualification'] = '99565';
		$data['criticalRate'] = '33140';
		$data['criticalStrikeDamage'] = '32045';
		$data['hitRate'] = '72032';
		$data['dodgeRate'] = '74646';
		$data['penetrate'] = '16481';
		$data['attackSpeed'] = '35454';
		$data['userElement'] = '90697';
		$data['attackElement'] = '91303';
		$data['jin'] = '21140';
		$data['mu'] = '96454';
		$data['tu'] = '49837';
		$data['sui'] = '82198';
		$data['huo'] = '42138';
		$data['light'] = '62041';
		$data['dark'] = '72214';
		$data['luck'] = '94334';
		$response = $this->request('add',$data);
		$model = new GoodsEquipmentModel();
		$model->destroy($response->result->goodsEquipmentId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['goodsCode'] = '测试文本ELaPcD';
		$data['equipmentType'] = '0';
		$data['suitCode'] = '测试文本anRktA';
		$data['strengthenLevel'] = '36957';
		$data['rarityLevel'] = '33641';
		$data['level'] = '95800';
		$data['hp'] = '22417';
		$data['mp'] = '26391';
		$data['attack'] = '54983';
		$data['defense'] = '17758';
		$data['endurance'] = '58618';
		$data['intellect'] = '26310';
		$data['strength'] = '57435';
		$data['enduranceQualification'] = '59426';
		$data['intellectQualification'] = '19455';
		$data['strengthQualification'] = '17733';
		$data['criticalRate'] = '86434';
		$data['criticalStrikeDamage'] = '10760';
		$data['hitRate'] = '97078';
		$data['dodgeRate'] = '50334';
		$data['penetrate'] = '91829';
		$data['attackSpeed'] = '16601';
		$data['userElement'] = '55646';
		$data['attackElement'] = '99790';
		$data['jin'] = '93964';
		$data['mu'] = '75440';
		$data['tu'] = '42174';
		$data['sui'] = '11124';
		$data['huo'] = '74741';
		$data['light'] = '63055';
		$data['dark'] = '14833';
		$data['luck'] = '55127';
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
		$data['goodsCode'] = '测试文本3klT7f';
		$data['equipmentType'] = '0';
		$data['suitCode'] = '测试文本wPIEdu';
		$data['strengthenLevel'] = '86700';
		$data['rarityLevel'] = '11192';
		$data['level'] = '79404';
		$data['hp'] = '60332';
		$data['mp'] = '60668';
		$data['attack'] = '68796';
		$data['defense'] = '20512';
		$data['endurance'] = '24349';
		$data['intellect'] = '75361';
		$data['strength'] = '45610';
		$data['enduranceQualification'] = '72649';
		$data['intellectQualification'] = '86522';
		$data['strengthQualification'] = '22166';
		$data['criticalRate'] = '92502';
		$data['criticalStrikeDamage'] = '99153';
		$data['hitRate'] = '70054';
		$data['dodgeRate'] = '88719';
		$data['penetrate'] = '79167';
		$data['attackSpeed'] = '14642';
		$data['userElement'] = '51859';
		$data['attackElement'] = '33845';
		$data['jin'] = '29959';
		$data['mu'] = '46461';
		$data['tu'] = '51945';
		$data['sui'] = '21198';
		$data['huo'] = '76839';
		$data['light'] = '38281';
		$data['dark'] = '94392';
		$data['luck'] = '36770';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$update = [];
		$update['goodsEquipmentId'] = $model->goodsEquipmentId;
		$update['goodsCode'] = '测试文本8h36Nw';
		$update['equipmentType'] = '0';
		$update['suitCode'] = '测试文本9CAEVg';
		$update['strengthenLevel'] = '46257';
		$update['rarityLevel'] = '89757';
		$update['level'] = '71348';
		$update['hp'] = '67561';
		$update['mp'] = '57289';
		$update['attack'] = '61059';
		$update['defense'] = '39431';
		$update['endurance'] = '95165';
		$update['intellect'] = '28060';
		$update['strength'] = '88728';
		$update['enduranceQualification'] = '68926';
		$update['intellectQualification'] = '65476';
		$update['strengthQualification'] = '96936';
		$update['criticalRate'] = '87324';
		$update['criticalStrikeDamage'] = '87621';
		$update['hitRate'] = '28410';
		$update['dodgeRate'] = '69425';
		$update['penetrate'] = '91943';
		$update['attackSpeed'] = '50721';
		$update['userElement'] = '17090';
		$update['attackElement'] = '14573';
		$update['jin'] = '60349';
		$update['mu'] = '83049';
		$update['tu'] = '90244';
		$update['sui'] = '37432';
		$update['huo'] = '49021';
		$update['light'] = '91844';
		$update['dark'] = '89095';
		$update['luck'] = '84793';
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
		$data['goodsCode'] = '测试文本5ZkXhn';
		$data['equipmentType'] = '1';
		$data['suitCode'] = '测试文本7BfgCU';
		$data['strengthenLevel'] = '46891';
		$data['rarityLevel'] = '72001';
		$data['level'] = '66899';
		$data['hp'] = '92577';
		$data['mp'] = '48450';
		$data['attack'] = '41012';
		$data['defense'] = '11134';
		$data['endurance'] = '57723';
		$data['intellect'] = '82669';
		$data['strength'] = '59488';
		$data['enduranceQualification'] = '31988';
		$data['intellectQualification'] = '36035';
		$data['strengthQualification'] = '35091';
		$data['criticalRate'] = '42477';
		$data['criticalStrikeDamage'] = '65709';
		$data['hitRate'] = '37899';
		$data['dodgeRate'] = '10565';
		$data['penetrate'] = '47898';
		$data['attackSpeed'] = '11209';
		$data['userElement'] = '66036';
		$data['attackElement'] = '15727';
		$data['jin'] = '67642';
		$data['mu'] = '93996';
		$data['tu'] = '28863';
		$data['sui'] = '39754';
		$data['huo'] = '90991';
		$data['light'] = '20946';
		$data['dark'] = '45793';
		$data['luck'] = '31149';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$delData = [];
		$delData['goodsEquipmentId'] = $model->goodsEquipmentId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

