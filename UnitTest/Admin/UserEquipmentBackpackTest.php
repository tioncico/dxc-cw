<?php

namespace UnitTest\Admin;

use App\Model\UserEquipmentBackpackModel;

/**
 * UserEquipmentBackpackTest
 * Class UserEquipmentBackpackTest
 * Create With ClassGeneration
 */
class UserEquipmentBackpackTest extends AdminBaseTestCase
{
	public $modelName = '/Api/Admin/UserEquipmentBackpack';


	public function testAdd()
	{
		$data = [];
		$data['backpackId'] = '14262';
		$data['userId'] = '23913';
		$data['isUse'] = '0';
		$data['strengthenLevel'] = '90247';
		$data['goodsCode'] = '测试文本NgeB2M';
		$data['equipmentType'] = '2';
		$data['suitCode'] = '测试文本QCaY03';
		$data['rarityLevel'] = '55073';
		$data['level'] = '42008';
		$data['hp'] = '85294';
		$data['mp'] = '11486';
		$data['attack'] = '13250';
		$data['defense'] = '57231';
		$data['endurance'] = '60436';
		$data['intellect'] = '94566';
		$data['strength'] = '95783';
		$data['enduranceQualification'] = '29191';
		$data['intellectQualification'] = '65388';
		$data['strengthQualification'] = '70882';
		$data['criticalRate'] = '42122';
		$data['criticalStrikeDamage'] = '64119';
		$data['hitRate'] = '13366';
		$data['dodgeRate'] = '12294';
		$data['penetrate'] = '91723';
		$data['attackSpeed'] = '83188';
		$data['userElement'] = '95230';
		$data['attackElement'] = '62765';
		$data['jin'] = '24759';
		$data['mu'] = '19725';
		$data['tu'] = '11389';
		$data['sui'] = '72891';
		$data['huo'] = '82222';
		$data['light'] = '55998';
		$data['dark'] = '81882';
		$data['luck'] = '60668';
		$data['physicalStrength'] = '35125';
		$response = $this->request('add',$data);
		$model = new UserEquipmentBackpackModel();
		$model->destroy($response->result->userEquipmentBackpackId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['backpackId'] = '50768';
		$data['userId'] = '50414';
		$data['isUse'] = '0';
		$data['strengthenLevel'] = '75672';
		$data['goodsCode'] = '测试文本mgHEla';
		$data['equipmentType'] = '3';
		$data['suitCode'] = '测试文本FV0ctW';
		$data['rarityLevel'] = '58695';
		$data['level'] = '38077';
		$data['hp'] = '89745';
		$data['mp'] = '62984';
		$data['attack'] = '84601';
		$data['defense'] = '59673';
		$data['endurance'] = '99454';
		$data['intellect'] = '84147';
		$data['strength'] = '14908';
		$data['enduranceQualification'] = '40337';
		$data['intellectQualification'] = '44275';
		$data['strengthQualification'] = '90478';
		$data['criticalRate'] = '68601';
		$data['criticalStrikeDamage'] = '99366';
		$data['hitRate'] = '11009';
		$data['dodgeRate'] = '69902';
		$data['penetrate'] = '40506';
		$data['attackSpeed'] = '10647';
		$data['userElement'] = '70643';
		$data['attackElement'] = '43900';
		$data['jin'] = '31779';
		$data['mu'] = '34496';
		$data['tu'] = '71080';
		$data['sui'] = '90281';
		$data['huo'] = '49815';
		$data['light'] = '41429';
		$data['dark'] = '60899';
		$data['luck'] = '16482';
		$data['physicalStrength'] = '28952';
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
		$data['backpackId'] = '58688';
		$data['userId'] = '11696';
		$data['isUse'] = '0';
		$data['strengthenLevel'] = '77912';
		$data['goodsCode'] = '测试文本If21y7';
		$data['equipmentType'] = '3';
		$data['suitCode'] = '测试文本e6gp5C';
		$data['rarityLevel'] = '62311';
		$data['level'] = '13209';
		$data['hp'] = '81450';
		$data['mp'] = '55456';
		$data['attack'] = '62702';
		$data['defense'] = '62291';
		$data['endurance'] = '30896';
		$data['intellect'] = '98200';
		$data['strength'] = '14806';
		$data['enduranceQualification'] = '60942';
		$data['intellectQualification'] = '79413';
		$data['strengthQualification'] = '96108';
		$data['criticalRate'] = '23735';
		$data['criticalStrikeDamage'] = '98655';
		$data['hitRate'] = '59498';
		$data['dodgeRate'] = '15301';
		$data['penetrate'] = '12155';
		$data['attackSpeed'] = '77609';
		$data['userElement'] = '65855';
		$data['attackElement'] = '95216';
		$data['jin'] = '36896';
		$data['mu'] = '33558';
		$data['tu'] = '78138';
		$data['sui'] = '16986';
		$data['huo'] = '69521';
		$data['light'] = '79758';
		$data['dark'] = '79211';
		$data['luck'] = '78181';
		$data['physicalStrength'] = '22964';
		$model = new UserEquipmentBackpackModel();
		$model->data($data)->save();

		$update = [];
		$update['userEquipmentBackpackId'] = $model->userEquipmentBackpackId;
		$update['backpackId'] = '36597';
		$update['userId'] = '49776';
		$update['isUse'] = '1';
		$update['strengthenLevel'] = '66453';
		$update['goodsCode'] = '测试文本z2Q8oS';
		$update['equipmentType'] = '2';
		$update['suitCode'] = '测试文本OQyJR2';
		$update['rarityLevel'] = '91200';
		$update['level'] = '86606';
		$update['hp'] = '83835';
		$update['mp'] = '54398';
		$update['attack'] = '88793';
		$update['defense'] = '36917';
		$update['endurance'] = '87737';
		$update['intellect'] = '93803';
		$update['strength'] = '34212';
		$update['enduranceQualification'] = '46552';
		$update['intellectQualification'] = '95414';
		$update['strengthQualification'] = '67755';
		$update['criticalRate'] = '35234';
		$update['criticalStrikeDamage'] = '25791';
		$update['hitRate'] = '73275';
		$update['dodgeRate'] = '22340';
		$update['penetrate'] = '52918';
		$update['attackSpeed'] = '61760';
		$update['userElement'] = '74869';
		$update['attackElement'] = '28982';
		$update['jin'] = '56101';
		$update['mu'] = '98504';
		$update['tu'] = '77374';
		$update['sui'] = '90172';
		$update['huo'] = '32038';
		$update['light'] = '67434';
		$update['dark'] = '77881';
		$update['luck'] = '86612';
		$update['physicalStrength'] = '23357';
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
		$data['backpackId'] = '11875';
		$data['userId'] = '52128';
		$data['isUse'] = '1';
		$data['strengthenLevel'] = '87761';
		$data['goodsCode'] = '测试文本Qe984v';
		$data['equipmentType'] = '1';
		$data['suitCode'] = '测试文本UweEs0';
		$data['rarityLevel'] = '32567';
		$data['level'] = '65474';
		$data['hp'] = '59782';
		$data['mp'] = '17051';
		$data['attack'] = '89059';
		$data['defense'] = '32792';
		$data['endurance'] = '93230';
		$data['intellect'] = '35814';
		$data['strength'] = '31521';
		$data['enduranceQualification'] = '99763';
		$data['intellectQualification'] = '18370';
		$data['strengthQualification'] = '61492';
		$data['criticalRate'] = '45168';
		$data['criticalStrikeDamage'] = '69185';
		$data['hitRate'] = '97021';
		$data['dodgeRate'] = '87415';
		$data['penetrate'] = '24430';
		$data['attackSpeed'] = '94510';
		$data['userElement'] = '16544';
		$data['attackElement'] = '94926';
		$data['jin'] = '43064';
		$data['mu'] = '94657';
		$data['tu'] = '57839';
		$data['sui'] = '85689';
		$data['huo'] = '41725';
		$data['light'] = '61329';
		$data['dark'] = '35890';
		$data['luck'] = '13393';
		$data['physicalStrength'] = '39555';
		$model = new UserEquipmentBackpackModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userEquipmentBackpackId'] = $model->userEquipmentBackpackId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

