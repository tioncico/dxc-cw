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
		$data['userId'] = '99002';
		$data['isUse'] = '2';
		$data['strengthenLevel'] = '75561';
		$data['goodsCode'] = '测试文本KTvwIp';
		$data['goodsName'] = '测试文本ZuEs6S';
		$data['equipmentType'] = '3';
		$data['suitCode'] = '测试文本J2VlX7';
		$data['rarityLevel'] = '63363';
		$data['level'] = '37237';
		$data['hp'] = '41324';
		$data['mp'] = '83061';
		$data['attack'] = '83785';
		$data['defense'] = '32723';
		$data['endurance'] = '37679';
		$data['intellect'] = '55656';
		$data['strength'] = '73224';
		$data['enduranceQualification'] = '76496';
		$data['intellectQualification'] = '94436';
		$data['strengthQualification'] = '39108';
		$data['criticalRate'] = '36585';
		$data['criticalStrikeDamage'] = '94547';
		$data['hitRate'] = '13060';
		$data['dodgeRate'] = '70318';
		$data['penetrate'] = '31926';
		$data['attackSpeed'] = '40747';
		$data['userElement'] = '22914';
		$data['attackElement'] = '50072';
		$data['jin'] = '28551';
		$data['mu'] = '71765';
		$data['tu'] = '98767';
		$data['sui'] = '88575';
		$data['huo'] = '78573';
		$data['light'] = '46555';
		$data['dark'] = '85511';
		$data['luck'] = '41606';
		$data['physicalStrength'] = '20366';
		$response = $this->request('add',$data);
		$model = new UserEquipmentBackpackModel();
		$model->destroy($response->result->backpackId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['userId'] = '68533';
		$data['isUse'] = '1';
		$data['strengthenLevel'] = '52592';
		$data['goodsCode'] = '测试文本ZPIULf';
		$data['goodsName'] = '测试文本7TIO4F';
		$data['equipmentType'] = '1';
		$data['suitCode'] = '测试文本LMGdli';
		$data['rarityLevel'] = '61017';
		$data['level'] = '73693';
		$data['hp'] = '53090';
		$data['mp'] = '73632';
		$data['attack'] = '94652';
		$data['defense'] = '13190';
		$data['endurance'] = '19068';
		$data['intellect'] = '27531';
		$data['strength'] = '97529';
		$data['enduranceQualification'] = '99478';
		$data['intellectQualification'] = '60501';
		$data['strengthQualification'] = '61883';
		$data['criticalRate'] = '86256';
		$data['criticalStrikeDamage'] = '75735';
		$data['hitRate'] = '83745';
		$data['dodgeRate'] = '90073';
		$data['penetrate'] = '32599';
		$data['attackSpeed'] = '66368';
		$data['userElement'] = '53139';
		$data['attackElement'] = '89096';
		$data['jin'] = '41972';
		$data['mu'] = '67935';
		$data['tu'] = '69142';
		$data['sui'] = '66066';
		$data['huo'] = '83515';
		$data['light'] = '23477';
		$data['dark'] = '10029';
		$data['luck'] = '57016';
		$data['physicalStrength'] = '63523';
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
		$data['userId'] = '99797';
		$data['isUse'] = '0';
		$data['strengthenLevel'] = '32366';
		$data['goodsCode'] = '测试文本nc6XAE';
		$data['goodsName'] = '测试文本hwmLg3';
		$data['equipmentType'] = '1';
		$data['suitCode'] = '测试文本lJgOmp';
		$data['rarityLevel'] = '46723';
		$data['level'] = '82317';
		$data['hp'] = '96467';
		$data['mp'] = '46584';
		$data['attack'] = '63071';
		$data['defense'] = '58833';
		$data['endurance'] = '37159';
		$data['intellect'] = '11513';
		$data['strength'] = '18707';
		$data['enduranceQualification'] = '94144';
		$data['intellectQualification'] = '55357';
		$data['strengthQualification'] = '37412';
		$data['criticalRate'] = '87958';
		$data['criticalStrikeDamage'] = '45043';
		$data['hitRate'] = '10309';
		$data['dodgeRate'] = '54665';
		$data['penetrate'] = '24510';
		$data['attackSpeed'] = '64796';
		$data['userElement'] = '70931';
		$data['attackElement'] = '11307';
		$data['jin'] = '16950';
		$data['mu'] = '75666';
		$data['tu'] = '56054';
		$data['sui'] = '94924';
		$data['huo'] = '61740';
		$data['light'] = '10909';
		$data['dark'] = '53020';
		$data['luck'] = '65867';
		$data['physicalStrength'] = '14782';
		$model = new UserEquipmentBackpackModel();
		$model->data($data)->save();

		$update = [];
		$update['backpackId'] = $model->backpackId;
		$update['userId'] = '53593';
		$update['isUse'] = '3';
		$update['strengthenLevel'] = '47293';
		$update['goodsCode'] = '测试文本gLy90B';
		$update['goodsName'] = '测试文本5LJbuW';
		$update['equipmentType'] = '0';
		$update['suitCode'] = '测试文本LhVUlA';
		$update['rarityLevel'] = '39013';
		$update['level'] = '31224';
		$update['hp'] = '34007';
		$update['mp'] = '78338';
		$update['attack'] = '49642';
		$update['defense'] = '84091';
		$update['endurance'] = '16987';
		$update['intellect'] = '10589';
		$update['strength'] = '86273';
		$update['enduranceQualification'] = '89068';
		$update['intellectQualification'] = '12353';
		$update['strengthQualification'] = '49638';
		$update['criticalRate'] = '18492';
		$update['criticalStrikeDamage'] = '47934';
		$update['hitRate'] = '88290';
		$update['dodgeRate'] = '74439';
		$update['penetrate'] = '46872';
		$update['attackSpeed'] = '89539';
		$update['userElement'] = '97353';
		$update['attackElement'] = '70076';
		$update['jin'] = '31331';
		$update['mu'] = '51008';
		$update['tu'] = '97553';
		$update['sui'] = '50257';
		$update['huo'] = '21704';
		$update['light'] = '60828';
		$update['dark'] = '79377';
		$update['luck'] = '17033';
		$update['physicalStrength'] = '31474';
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
		$data['userId'] = '28357';
		$data['isUse'] = '3';
		$data['strengthenLevel'] = '41729';
		$data['goodsCode'] = '测试文本2wJGlC';
		$data['goodsName'] = '测试文本HU3Vzy';
		$data['equipmentType'] = '1';
		$data['suitCode'] = '测试文本QO9oa2';
		$data['rarityLevel'] = '33401';
		$data['level'] = '29264';
		$data['hp'] = '73120';
		$data['mp'] = '89892';
		$data['attack'] = '34529';
		$data['defense'] = '77942';
		$data['endurance'] = '26249';
		$data['intellect'] = '76958';
		$data['strength'] = '32942';
		$data['enduranceQualification'] = '81762';
		$data['intellectQualification'] = '12395';
		$data['strengthQualification'] = '29714';
		$data['criticalRate'] = '48512';
		$data['criticalStrikeDamage'] = '45066';
		$data['hitRate'] = '91390';
		$data['dodgeRate'] = '71606';
		$data['penetrate'] = '12254';
		$data['attackSpeed'] = '75770';
		$data['userElement'] = '36442';
		$data['attackElement'] = '43916';
		$data['jin'] = '16246';
		$data['mu'] = '90790';
		$data['tu'] = '68693';
		$data['sui'] = '90154';
		$data['huo'] = '65414';
		$data['light'] = '63284';
		$data['dark'] = '54543';
		$data['luck'] = '13860';
		$data['physicalStrength'] = '46371';
		$model = new UserEquipmentBackpackModel();
		$model->data($data)->save();

		$delData = [];
		$delData['backpackId'] = $model->backpackId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

