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
		$data['userId'] = '81380';
		$data['isUse'] = '2';
		$data['strengthenLevel'] = '50240';
		$data['goodsCode'] = '测试文本7avMuU';
		$data['goodsName'] = '测试文本rRaJ9b';
		$data['equipmentType'] = '3';
		$data['suitCode'] = '测试文本izpNW4';
		$data['rarityLevel'] = '40158';
		$data['level'] = '70550';
		$data['hp'] = '99827';
		$data['mp'] = '79864';
		$data['attack'] = '58257';
		$data['defense'] = '18550';
		$data['endurance'] = '81202';
		$data['intellect'] = '32854';
		$data['strength'] = '57666';
		$data['enduranceQualification'] = '70325';
		$data['intellectQualification'] = '63515';
		$data['strengthQualification'] = '89565';
		$data['criticalRate'] = '35675';
		$data['criticalStrikeDamage'] = '91799';
		$data['hitRate'] = '87898';
		$data['dodgeRate'] = '56844';
		$data['penetrate'] = '87380';
		$data['attackSpeed'] = '54896';
		$data['userElement'] = '68007';
		$data['attackElement'] = '83735';
		$data['jin'] = '83224';
		$data['mu'] = '26506';
		$data['tu'] = '36017';
		$data['sui'] = '32274';
		$data['huo'] = '60603';
		$data['light'] = '91296';
		$data['dark'] = '70940';
		$data['luck'] = '78427';
		$data['physicalStrength'] = '51159';
		$response = $this->request('add',$data);
		$model = new UserEquipmentBackpackModel();
		$model->destroy($response->result->backpackId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['userId'] = '86633';
		$data['isUse'] = '2';
		$data['strengthenLevel'] = '98171';
		$data['goodsCode'] = '测试文本g9BbUD';
		$data['goodsName'] = '测试文本PG1Ixp';
		$data['equipmentType'] = '2';
		$data['suitCode'] = '测试文本zlRNf7';
		$data['rarityLevel'] = '89745';
		$data['level'] = '26590';
		$data['hp'] = '91952';
		$data['mp'] = '97735';
		$data['attack'] = '56352';
		$data['defense'] = '95763';
		$data['endurance'] = '91465';
		$data['intellect'] = '72953';
		$data['strength'] = '75657';
		$data['enduranceQualification'] = '44854';
		$data['intellectQualification'] = '38627';
		$data['strengthQualification'] = '37385';
		$data['criticalRate'] = '82912';
		$data['criticalStrikeDamage'] = '75205';
		$data['hitRate'] = '14825';
		$data['dodgeRate'] = '46457';
		$data['penetrate'] = '75165';
		$data['attackSpeed'] = '38568';
		$data['userElement'] = '49330';
		$data['attackElement'] = '64125';
		$data['jin'] = '47815';
		$data['mu'] = '14156';
		$data['tu'] = '79717';
		$data['sui'] = '32629';
		$data['huo'] = '90875';
		$data['light'] = '39934';
		$data['dark'] = '60531';
		$data['luck'] = '47916';
		$data['physicalStrength'] = '91987';
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
		$data['userId'] = '15073';
		$data['isUse'] = '3';
		$data['strengthenLevel'] = '75150';
		$data['goodsCode'] = '测试文本xMbLn0';
		$data['goodsName'] = '测试文本ct7MTI';
		$data['equipmentType'] = '2';
		$data['suitCode'] = '测试文本cfER9h';
		$data['rarityLevel'] = '81374';
		$data['level'] = '13256';
		$data['hp'] = '67031';
		$data['mp'] = '16406';
		$data['attack'] = '54101';
		$data['defense'] = '82960';
		$data['endurance'] = '35117';
		$data['intellect'] = '28555';
		$data['strength'] = '57962';
		$data['enduranceQualification'] = '70886';
		$data['intellectQualification'] = '16660';
		$data['strengthQualification'] = '16584';
		$data['criticalRate'] = '55558';
		$data['criticalStrikeDamage'] = '67492';
		$data['hitRate'] = '42651';
		$data['dodgeRate'] = '63910';
		$data['penetrate'] = '33165';
		$data['attackSpeed'] = '23153';
		$data['userElement'] = '56678';
		$data['attackElement'] = '48697';
		$data['jin'] = '86078';
		$data['mu'] = '66118';
		$data['tu'] = '71826';
		$data['sui'] = '15900';
		$data['huo'] = '16584';
		$data['light'] = '94809';
		$data['dark'] = '86140';
		$data['luck'] = '48222';
		$data['physicalStrength'] = '36619';
		$model = new UserEquipmentBackpackModel();
		$model->data($data)->save();

		$update = [];
		$update['backpackId'] = $model->backpackId;
		$update['userId'] = '26226';
		$update['isUse'] = '3';
		$update['strengthenLevel'] = '65617';
		$update['goodsCode'] = '测试文本aDqw08';
		$update['goodsName'] = '测试文本f8XABy';
		$update['equipmentType'] = '0';
		$update['suitCode'] = '测试文本N5jgtS';
		$update['rarityLevel'] = '97161';
		$update['level'] = '95841';
		$update['hp'] = '28745';
		$update['mp'] = '17641';
		$update['attack'] = '47268';
		$update['defense'] = '52391';
		$update['endurance'] = '68669';
		$update['intellect'] = '50259';
		$update['strength'] = '30338';
		$update['enduranceQualification'] = '70510';
		$update['intellectQualification'] = '37154';
		$update['strengthQualification'] = '46934';
		$update['criticalRate'] = '31310';
		$update['criticalStrikeDamage'] = '41547';
		$update['hitRate'] = '43914';
		$update['dodgeRate'] = '64507';
		$update['penetrate'] = '97435';
		$update['attackSpeed'] = '33342';
		$update['userElement'] = '31302';
		$update['attackElement'] = '67618';
		$update['jin'] = '53454';
		$update['mu'] = '11775';
		$update['tu'] = '58339';
		$update['sui'] = '70852';
		$update['huo'] = '93350';
		$update['light'] = '97720';
		$update['dark'] = '71973';
		$update['luck'] = '70211';
		$update['physicalStrength'] = '57999';
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
		$data['userId'] = '15183';
		$data['isUse'] = '3';
		$data['strengthenLevel'] = '54031';
		$data['goodsCode'] = '测试文本GNVXUu';
		$data['goodsName'] = '测试文本qZLx78';
		$data['equipmentType'] = '0';
		$data['suitCode'] = '测试文本pyQSi2';
		$data['rarityLevel'] = '86859';
		$data['level'] = '33869';
		$data['hp'] = '88462';
		$data['mp'] = '15202';
		$data['attack'] = '98075';
		$data['defense'] = '83083';
		$data['endurance'] = '16310';
		$data['intellect'] = '25329';
		$data['strength'] = '85306';
		$data['enduranceQualification'] = '57359';
		$data['intellectQualification'] = '63636';
		$data['strengthQualification'] = '12801';
		$data['criticalRate'] = '90804';
		$data['criticalStrikeDamage'] = '11763';
		$data['hitRate'] = '33308';
		$data['dodgeRate'] = '53785';
		$data['penetrate'] = '32067';
		$data['attackSpeed'] = '77998';
		$data['userElement'] = '50279';
		$data['attackElement'] = '82219';
		$data['jin'] = '23851';
		$data['mu'] = '83286';
		$data['tu'] = '86197';
		$data['sui'] = '72524';
		$data['huo'] = '71377';
		$data['light'] = '16568';
		$data['dark'] = '63059';
		$data['luck'] = '87788';
		$data['physicalStrength'] = '84842';
		$model = new UserEquipmentBackpackModel();
		$model->data($data)->save();

		$delData = [];
		$delData['backpackId'] = $model->backpackId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

