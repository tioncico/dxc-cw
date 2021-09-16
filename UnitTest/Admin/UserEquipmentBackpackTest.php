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
		$data['userId'] = '21883';
		$data['isUse'] = '0';
		$data['strengthenLevel'] = '65583';
		$data['attributeDescription'] = '测试文本XjnaSs';
		$data['attributeEntryDescription'] = '测试文本vJmITe';
		$data['extraAttributeDescription'] = '测试文本jJurwK';
		$data['suitAttribute2Description'] = '测试文本OHPSyZ';
		$data['suitAttribute3Description'] = '测试文本6mNqQA';
		$data['suitAttribute5Description'] = '测试文本mMd6vx';
		$data['goodsCode'] = '测试文本muLsUy';
		$data['goodsName'] = '测试文本sPHelz';
		$data['equipmentType'] = '2';
		$data['suitCode'] = '测试文本UgGZlq';
		$data['rarityLevel'] = '87708';
		$data['level'] = '89552';
		$data['hp'] = '23460';
		$data['mp'] = '97894';
		$data['attack'] = '57183';
		$data['defense'] = '46964';
		$data['endurance'] = '88494';
		$data['intellect'] = '56239';
		$data['strength'] = '67117';
		$data['criticalRate'] = '13013';
		$data['criticalStrikeDamage'] = '64592';
		$data['hitRate'] = '48734';
		$data['dodgeRate'] = '69973';
		$data['penetrate'] = '29839';
		$data['attackSpeed'] = '26644';
		$data['userElement'] = '40912';
		$data['attackElement'] = '54685';
		$data['jin'] = '46548';
		$data['mu'] = '67727';
		$data['tu'] = '32470';
		$data['sui'] = '39031';
		$data['huo'] = '54044';
		$data['light'] = '74292';
		$data['dark'] = '24831';
		$data['luck'] = '59658';
		$response = $this->request('add',$data);
		$model = new UserEquipmentBackpackModel();
		$model->destroy($response->result->backpackId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['userId'] = '81930';
		$data['isUse'] = '0';
		$data['strengthenLevel'] = '56090';
		$data['attributeDescription'] = '测试文本LoQqz2';
		$data['attributeEntryDescription'] = '测试文本aEmNyW';
		$data['extraAttributeDescription'] = '测试文本xvyGXR';
		$data['suitAttribute2Description'] = '测试文本j8Y4WP';
		$data['suitAttribute3Description'] = '测试文本pWXCLe';
		$data['suitAttribute5Description'] = '测试文本c2P4pt';
		$data['goodsCode'] = '测试文本QyG8Lc';
		$data['goodsName'] = '测试文本etqNQn';
		$data['equipmentType'] = '1';
		$data['suitCode'] = '测试文本PHOYCa';
		$data['rarityLevel'] = '49973';
		$data['level'] = '58947';
		$data['hp'] = '10904';
		$data['mp'] = '54653';
		$data['attack'] = '13950';
		$data['defense'] = '76336';
		$data['endurance'] = '32428';
		$data['intellect'] = '84545';
		$data['strength'] = '98468';
		$data['criticalRate'] = '90206';
		$data['criticalStrikeDamage'] = '74819';
		$data['hitRate'] = '73095';
		$data['dodgeRate'] = '95906';
		$data['penetrate'] = '26679';
		$data['attackSpeed'] = '28951';
		$data['userElement'] = '79709';
		$data['attackElement'] = '50870';
		$data['jin'] = '69022';
		$data['mu'] = '34785';
		$data['tu'] = '72998';
		$data['sui'] = '43746';
		$data['huo'] = '56908';
		$data['light'] = '51006';
		$data['dark'] = '27297';
		$data['luck'] = '19712';
		$model = new UserEquipmentBackpackModel();
		$model->data($data)->save();

		$data = [];
		$data['backpackId'] = $model->backpackId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->backpackId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['userId'] = '81902';
		$data['isUse'] = '0';
		$data['strengthenLevel'] = '10904';
		$data['attributeDescription'] = '测试文本qWLvw4';
		$data['attributeEntryDescription'] = '测试文本0ZxybH';
		$data['extraAttributeDescription'] = '测试文本6cTj02';
		$data['suitAttribute2Description'] = '测试文本p2FrJ4';
		$data['suitAttribute3Description'] = '测试文本O01rf7';
		$data['suitAttribute5Description'] = '测试文本zn85KP';
		$data['goodsCode'] = '测试文本olq17D';
		$data['goodsName'] = '测试文本tpRncl';
		$data['equipmentType'] = '2';
		$data['suitCode'] = '测试文本CIkRP3';
		$data['rarityLevel'] = '12786';
		$data['level'] = '22900';
		$data['hp'] = '84346';
		$data['mp'] = '87781';
		$data['attack'] = '25846';
		$data['defense'] = '58191';
		$data['endurance'] = '23875';
		$data['intellect'] = '32727';
		$data['strength'] = '16019';
		$data['criticalRate'] = '61469';
		$data['criticalStrikeDamage'] = '34083';
		$data['hitRate'] = '16502';
		$data['dodgeRate'] = '82134';
		$data['penetrate'] = '77236';
		$data['attackSpeed'] = '90658';
		$data['userElement'] = '37703';
		$data['attackElement'] = '40943';
		$data['jin'] = '52858';
		$data['mu'] = '12284';
		$data['tu'] = '38461';
		$data['sui'] = '39696';
		$data['huo'] = '63616';
		$data['light'] = '70693';
		$data['dark'] = '86610';
		$data['luck'] = '66385';
		$model = new UserEquipmentBackpackModel();
		$model->data($data)->save();

		$update = [];
		$update['backpackId'] = $model->backpackId;
		$update['userId'] = '41480';
		$update['isUse'] = '1';
		$update['strengthenLevel'] = '79165';
		$update['attributeDescription'] = '测试文本lqTjwK';
		$update['attributeEntryDescription'] = '测试文本atyz46';
		$update['extraAttributeDescription'] = '测试文本ZxOLKl';
		$update['suitAttribute2Description'] = '测试文本Ql3H96';
		$update['suitAttribute3Description'] = '测试文本cMtWvB';
		$update['suitAttribute5Description'] = '测试文本MyT92N';
		$update['goodsCode'] = '测试文本raJP6Z';
		$update['goodsName'] = '测试文本p8zm1V';
		$update['equipmentType'] = '1';
		$update['suitCode'] = '测试文本ok5U1A';
		$update['rarityLevel'] = '44410';
		$update['level'] = '63899';
		$update['hp'] = '15828';
		$update['mp'] = '55747';
		$update['attack'] = '26171';
		$update['defense'] = '70039';
		$update['endurance'] = '40409';
		$update['intellect'] = '76403';
		$update['strength'] = '15186';
		$update['criticalRate'] = '19733';
		$update['criticalStrikeDamage'] = '66015';
		$update['hitRate'] = '45839';
		$update['dodgeRate'] = '95149';
		$update['penetrate'] = '45462';
		$update['attackSpeed'] = '99490';
		$update['userElement'] = '48538';
		$update['attackElement'] = '70818';
		$update['jin'] = '83338';
		$update['mu'] = '54159';
		$update['tu'] = '77829';
		$update['sui'] = '16493';
		$update['huo'] = '75920';
		$update['light'] = '94894';
		$update['dark'] = '41849';
		$update['luck'] = '11180';
		$response = $this->request('update',$update);
		$model->destroy($model->backpackId);
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
		$data['userId'] = '57689';
		$data['isUse'] = '2';
		$data['strengthenLevel'] = '76828';
		$data['attributeDescription'] = '测试文本l02Xy5';
		$data['attributeEntryDescription'] = '测试文本luPFDq';
		$data['extraAttributeDescription'] = '测试文本GxAQHo';
		$data['suitAttribute2Description'] = '测试文本Ih5fbR';
		$data['suitAttribute3Description'] = '测试文本RUxwVX';
		$data['suitAttribute5Description'] = '测试文本htXvW7';
		$data['goodsCode'] = '测试文本w0UDdZ';
		$data['goodsName'] = '测试文本3BRx7L';
		$data['equipmentType'] = '0';
		$data['suitCode'] = '测试文本jyZ2BX';
		$data['rarityLevel'] = '50804';
		$data['level'] = '20487';
		$data['hp'] = '69490';
		$data['mp'] = '72889';
		$data['attack'] = '83905';
		$data['defense'] = '31118';
		$data['endurance'] = '49361';
		$data['intellect'] = '68141';
		$data['strength'] = '85518';
		$data['criticalRate'] = '32293';
		$data['criticalStrikeDamage'] = '36156';
		$data['hitRate'] = '63710';
		$data['dodgeRate'] = '97772';
		$data['penetrate'] = '39217';
		$data['attackSpeed'] = '13415';
		$data['userElement'] = '83640';
		$data['attackElement'] = '86197';
		$data['jin'] = '24531';
		$data['mu'] = '27334';
		$data['tu'] = '76591';
		$data['sui'] = '82112';
		$data['huo'] = '50212';
		$data['light'] = '39703';
		$data['dark'] = '73686';
		$data['luck'] = '78276';
		$model = new UserEquipmentBackpackModel();
		$model->data($data)->save();

		$delData = [];
		$delData['backpackId'] = $model->backpackId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

