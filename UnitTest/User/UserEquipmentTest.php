<?php

namespace UnitTest\User;

use UserEquipmentBackpackModel;

/**
 * UserEquipmentBackpackTest
 * Class UserEquipmentBackpackTest
 * Create With ClassGeneration
 */
class UserEquipmentTest extends UserBaseTestCase
{
	public $modelName = 'UserEquipment';


	public function testAdd()
	{
		$data = [];
		$data['userId'] = '91767';
		$data['isUse'] = '1';
		$data['strengthenLevel'] = '91266';
		$data['attributeDescription'] = '测试文本5HRTtc';
		$data['attributeEntryDescription'] = '测试文本lcbZoy';
		$data['extraAttributeDescription'] = '测试文本NKsFO4';
		$data['suitAttribute2Description'] = '测试文本yJxz6G';
		$data['suitAttribute3Description'] = '测试文本E26i9n';
		$data['suitAttribute5Description'] = '测试文本MAEzXD';
		$data['goodsCode'] = '测试文本iwfRXA';
		$data['goodsName'] = '测试文本8p9gKt';
		$data['equipmentType'] = '3';
		$data['suitCode'] = '测试文本oHmk1u';
		$data['rarityLevel'] = '49851';
		$data['level'] = '35918';
		$data['hp'] = '11491';
		$data['mp'] = '15888';
		$data['attack'] = '86436';
		$data['defense'] = '57461';
		$data['endurance'] = '97299';
		$data['intellect'] = '54587';
		$data['strength'] = '94614';
		$data['criticalRate'] = '78945';
		$data['criticalStrikeDamage'] = '83671';
		$data['hitRate'] = '69969';
		$data['dodgeRate'] = '35786';
		$data['penetrate'] = '48553';
		$data['attackSpeed'] = '38849';
		$data['userElement'] = '47664';
		$data['attackElement'] = '71616';
		$data['jin'] = '34981';
		$data['mu'] = '75430';
		$data['tu'] = '34842';
		$data['sui'] = '14260';
		$data['huo'] = '38303';
		$data['light'] = '73289';
		$data['dark'] = '30381';
		$data['luck'] = '98542';
		$response = $this->request('add',$data);
		$model = new UserEquipmentBackpackModel();
		$model->destroy($response->result->backpackId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}

	public function testGetStrengthenData()
	{
		$data = [
		    'backpackId'=>47
        ];
		$response = $this->request('getStrengthenData',$data);
		var_dump(json_encode($response,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
	}

	public function testStrengthen()
	{
		$data = [
		    'backpackId'=>60
        ];
		$response = $this->request('strengthen',$data);
		var_dump(json_encode($response,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
	}

	public function testDecompose()
	{
		$data = [
		    'backpackId'=>60
        ];
		$response = $this->request('decompose',$data);
		var_dump(json_encode($response,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
	}


	public function testGetOne()
	{
		$data = [];
		$data['userId'] = '76075';
		$data['isUse'] = '2';
		$data['strengthenLevel'] = '13228';
		$data['attributeDescription'] = '测试文本NyWgiq';
		$data['attributeEntryDescription'] = '测试文本4XTi0V';
		$data['extraAttributeDescription'] = '测试文本wGmMVu';
		$data['suitAttribute2Description'] = '测试文本u59ScG';
		$data['suitAttribute3Description'] = '测试文本oM2vjU';
		$data['suitAttribute5Description'] = '测试文本hKpCxA';
		$data['goodsCode'] = '测试文本SgFTYf';
		$data['goodsName'] = '测试文本pkYb1t';
		$data['equipmentType'] = '2';
		$data['suitCode'] = '测试文本H36cwl';
		$data['rarityLevel'] = '82570';
		$data['level'] = '31977';
		$data['hp'] = '76082';
		$data['mp'] = '68571';
		$data['attack'] = '20281';
		$data['defense'] = '48269';
		$data['endurance'] = '21389';
		$data['intellect'] = '59685';
		$data['strength'] = '96338';
		$data['criticalRate'] = '43978';
		$data['criticalStrikeDamage'] = '98301';
		$data['hitRate'] = '31282';
		$data['dodgeRate'] = '88468';
		$data['penetrate'] = '75772';
		$data['attackSpeed'] = '18010';
		$data['userElement'] = '40437';
		$data['attackElement'] = '64513';
		$data['jin'] = '40001';
		$data['mu'] = '41094';
		$data['tu'] = '64109';
		$data['sui'] = '18339';
		$data['huo'] = '34922';
		$data['light'] = '27206';
		$data['dark'] = '17160';
		$data['luck'] = '19445';
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
		$data['userId'] = '25642';
		$data['isUse'] = '2';
		$data['strengthenLevel'] = '50334';
		$data['attributeDescription'] = '测试文本puCsm1';
		$data['attributeEntryDescription'] = '测试文本hyjdYs';
		$data['extraAttributeDescription'] = '测试文本rA4ptG';
		$data['suitAttribute2Description'] = '测试文本yKqTIR';
		$data['suitAttribute3Description'] = '测试文本mtMhpw';
		$data['suitAttribute5Description'] = '测试文本0KreIj';
		$data['goodsCode'] = '测试文本OemUa7';
		$data['goodsName'] = '测试文本yr17on';
		$data['equipmentType'] = '3';
		$data['suitCode'] = '测试文本8Atc96';
		$data['rarityLevel'] = '45735';
		$data['level'] = '63538';
		$data['hp'] = '97266';
		$data['mp'] = '27151';
		$data['attack'] = '43846';
		$data['defense'] = '52340';
		$data['endurance'] = '57937';
		$data['intellect'] = '39351';
		$data['strength'] = '38331';
		$data['criticalRate'] = '67902';
		$data['criticalStrikeDamage'] = '33062';
		$data['hitRate'] = '35139';
		$data['dodgeRate'] = '65977';
		$data['penetrate'] = '78360';
		$data['attackSpeed'] = '95765';
		$data['userElement'] = '49142';
		$data['attackElement'] = '97557';
		$data['jin'] = '45823';
		$data['mu'] = '88917';
		$data['tu'] = '58056';
		$data['sui'] = '75220';
		$data['huo'] = '23990';
		$data['light'] = '67148';
		$data['dark'] = '93117';
		$data['luck'] = '14779';
		$model = new UserEquipmentBackpackModel();
		$model->data($data)->save();

		$update = [];
		$update['backpackId'] = $model->backpackId;
		$update['userId'] = '10926';
		$update['isUse'] = '2';
		$update['strengthenLevel'] = '50835';
		$update['attributeDescription'] = '测试文本Dsv0tU';
		$update['attributeEntryDescription'] = '测试文本bSp2Ga';
		$update['extraAttributeDescription'] = '测试文本lt2C5N';
		$update['suitAttribute2Description'] = '测试文本n9yJua';
		$update['suitAttribute3Description'] = '测试文本st91az';
		$update['suitAttribute5Description'] = '测试文本WPfmNC';
		$update['goodsCode'] = '测试文本174boZ';
		$update['goodsName'] = '测试文本3TrOIz';
		$update['equipmentType'] = '1';
		$update['suitCode'] = '测试文本kcSvBA';
		$update['rarityLevel'] = '31650';
		$update['level'] = '31394';
		$update['hp'] = '76639';
		$update['mp'] = '27061';
		$update['attack'] = '22915';
		$update['defense'] = '61096';
		$update['endurance'] = '43121';
		$update['intellect'] = '59243';
		$update['strength'] = '29323';
		$update['criticalRate'] = '47223';
		$update['criticalStrikeDamage'] = '37391';
		$update['hitRate'] = '86700';
		$update['dodgeRate'] = '78785';
		$update['penetrate'] = '52947';
		$update['attackSpeed'] = '88010';
		$update['userElement'] = '89504';
		$update['attackElement'] = '90692';
		$update['jin'] = '62341';
		$update['mu'] = '37763';
		$update['tu'] = '83067';
		$update['sui'] = '17876';
		$update['huo'] = '75228';
		$update['light'] = '31264';
		$update['dark'] = '41192';
		$update['luck'] = '17384';
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
		$data['userId'] = '78652';
		$data['isUse'] = '0';
		$data['strengthenLevel'] = '95059';
		$data['attributeDescription'] = '测试文本wtTCU9';
		$data['attributeEntryDescription'] = '测试文本s0rJZE';
		$data['extraAttributeDescription'] = '测试文本jpwX08';
		$data['suitAttribute2Description'] = '测试文本HT2i6o';
		$data['suitAttribute3Description'] = '测试文本I8mtOR';
		$data['suitAttribute5Description'] = '测试文本ZrqaDb';
		$data['goodsCode'] = '测试文本zu1d0y';
		$data['goodsName'] = '测试文本xPvEL4';
		$data['equipmentType'] = '1';
		$data['suitCode'] = '测试文本0DGIFt';
		$data['rarityLevel'] = '64517';
		$data['level'] = '24374';
		$data['hp'] = '92127';
		$data['mp'] = '10336';
		$data['attack'] = '88104';
		$data['defense'] = '61219';
		$data['endurance'] = '16123';
		$data['intellect'] = '35624';
		$data['strength'] = '93034';
		$data['criticalRate'] = '39432';
		$data['criticalStrikeDamage'] = '63801';
		$data['hitRate'] = '64091';
		$data['dodgeRate'] = '47161';
		$data['penetrate'] = '89349';
		$data['attackSpeed'] = '51014';
		$data['userElement'] = '28297';
		$data['attackElement'] = '42010';
		$data['jin'] = '27586';
		$data['mu'] = '70371';
		$data['tu'] = '27851';
		$data['sui'] = '33325';
		$data['huo'] = '92679';
		$data['light'] = '29759';
		$data['dark'] = '76860';
		$data['luck'] = '19937';
		$model = new UserEquipmentBackpackModel();
		$model->data($data)->save();

		$delData = [];
		$delData['backpackId'] = $model->backpackId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

