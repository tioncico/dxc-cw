<?php

namespace UnitTest\Common;

use App\Model\UserEquipmentBackpackModel;

/**
 * UserEquipmentBackpackTest
 * Class UserEquipmentBackpackTest
 * Create With ClassGeneration
 */
class UserEquipmentBackpackTest extends CommonBaseTest
{
	public $modelName = '/Api/Common/UserEquipmentBackpack';


	public function testAdd()
	{
		$data = [];
		$data['backpackId'] = '40540';
		$data['userId'] = '78186';
		$data['isUse'] = '3';
		$data['strengthenLevel'] = '42725';
		$data['goodsCode'] = '测试文本3iJ2xV';
		$data['equipmentType'] = '3';
		$data['suitCode'] = '测试文本q3kdWQ';
		$data['rarityLevel'] = '89057';
		$data['level'] = '47505';
		$data['hp'] = '18117';
		$data['mp'] = '99816';
		$data['attack'] = '88838';
		$data['defense'] = '97755';
		$data['endurance'] = '75889';
		$data['intellect'] = '42015';
		$data['strength'] = '33833';
		$data['enduranceQualification'] = '32009';
		$data['intellectQualification'] = '10801';
		$data['strengthQualification'] = '10036';
		$data['criticalRate'] = '43015';
		$data['criticalStrikeDamage'] = '60892';
		$data['hitRate'] = '56858';
		$data['dodgeRate'] = '33168';
		$data['penetrate'] = '77862';
		$data['attackSpeed'] = '24871';
		$data['userElement'] = '18963';
		$data['attackElement'] = '26147';
		$data['jin'] = '53714';
		$data['mu'] = '29372';
		$data['tu'] = '13444';
		$data['sui'] = '27440';
		$data['huo'] = '90642';
		$data['light'] = '21085';
		$data['dark'] = '72544';
		$data['luck'] = '47445';
		$data['physicalStrength'] = '59940';
		$response = $this->request('add',$data);
		$model = new UserEquipmentBackpackModel();
		$model->destroy($response->result->userEquipmentBackpackId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['backpackId'] = '86517';
		$data['userId'] = '85673';
		$data['isUse'] = '3';
		$data['strengthenLevel'] = '68589';
		$data['goodsCode'] = '测试文本g0AnLF';
		$data['equipmentType'] = '3';
		$data['suitCode'] = '测试文本wP9aeO';
		$data['rarityLevel'] = '91303';
		$data['level'] = '91226';
		$data['hp'] = '96337';
		$data['mp'] = '31466';
		$data['attack'] = '50892';
		$data['defense'] = '19433';
		$data['endurance'] = '46797';
		$data['intellect'] = '54506';
		$data['strength'] = '12891';
		$data['enduranceQualification'] = '21678';
		$data['intellectQualification'] = '68923';
		$data['strengthQualification'] = '48850';
		$data['criticalRate'] = '97506';
		$data['criticalStrikeDamage'] = '43103';
		$data['hitRate'] = '31379';
		$data['dodgeRate'] = '79107';
		$data['penetrate'] = '25293';
		$data['attackSpeed'] = '41347';
		$data['userElement'] = '43454';
		$data['attackElement'] = '43022';
		$data['jin'] = '67082';
		$data['mu'] = '78933';
		$data['tu'] = '54191';
		$data['sui'] = '58778';
		$data['huo'] = '78672';
		$data['light'] = '18026';
		$data['dark'] = '69040';
		$data['luck'] = '30812';
		$data['physicalStrength'] = '93033';
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
		$data['backpackId'] = '34802';
		$data['userId'] = '99509';
		$data['isUse'] = '1';
		$data['strengthenLevel'] = '81597';
		$data['goodsCode'] = '测试文本cKpY7L';
		$data['equipmentType'] = '3';
		$data['suitCode'] = '测试文本HNu7Bq';
		$data['rarityLevel'] = '90703';
		$data['level'] = '13531';
		$data['hp'] = '34925';
		$data['mp'] = '82916';
		$data['attack'] = '50362';
		$data['defense'] = '74459';
		$data['endurance'] = '35859';
		$data['intellect'] = '99872';
		$data['strength'] = '86175';
		$data['enduranceQualification'] = '13437';
		$data['intellectQualification'] = '42614';
		$data['strengthQualification'] = '29152';
		$data['criticalRate'] = '37002';
		$data['criticalStrikeDamage'] = '50072';
		$data['hitRate'] = '31994';
		$data['dodgeRate'] = '69578';
		$data['penetrate'] = '97339';
		$data['attackSpeed'] = '81770';
		$data['userElement'] = '94044';
		$data['attackElement'] = '11286';
		$data['jin'] = '47108';
		$data['mu'] = '44323';
		$data['tu'] = '89178';
		$data['sui'] = '66201';
		$data['huo'] = '83186';
		$data['light'] = '24344';
		$data['dark'] = '41453';
		$data['luck'] = '56591';
		$data['physicalStrength'] = '99143';
		$model = new UserEquipmentBackpackModel();
		$model->data($data)->save();

		$update = [];
		$update['userEquipmentBackpackId'] = $model->userEquipmentBackpackId;
		$update['backpackId'] = '91745';
		$update['userId'] = '85938';
		$update['isUse'] = '2';
		$update['strengthenLevel'] = '49306';
		$update['goodsCode'] = '测试文本CMtoJh';
		$update['equipmentType'] = '0';
		$update['suitCode'] = '测试文本uA93Xl';
		$update['rarityLevel'] = '26558';
		$update['level'] = '91023';
		$update['hp'] = '72506';
		$update['mp'] = '70831';
		$update['attack'] = '62584';
		$update['defense'] = '46001';
		$update['endurance'] = '47481';
		$update['intellect'] = '89654';
		$update['strength'] = '68543';
		$update['enduranceQualification'] = '46218';
		$update['intellectQualification'] = '43938';
		$update['strengthQualification'] = '89758';
		$update['criticalRate'] = '77196';
		$update['criticalStrikeDamage'] = '61937';
		$update['hitRate'] = '53638';
		$update['dodgeRate'] = '54429';
		$update['penetrate'] = '73692';
		$update['attackSpeed'] = '33449';
		$update['userElement'] = '91017';
		$update['attackElement'] = '60314';
		$update['jin'] = '99424';
		$update['mu'] = '66244';
		$update['tu'] = '55878';
		$update['sui'] = '89562';
		$update['huo'] = '35203';
		$update['light'] = '58497';
		$update['dark'] = '65429';
		$update['luck'] = '99491';
		$update['physicalStrength'] = '34131';
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
		$data['backpackId'] = '24421';
		$data['userId'] = '28862';
		$data['isUse'] = '1';
		$data['strengthenLevel'] = '70061';
		$data['goodsCode'] = '测试文本Qh3Lc2';
		$data['equipmentType'] = '2';
		$data['suitCode'] = '测试文本MAPYLU';
		$data['rarityLevel'] = '54929';
		$data['level'] = '71286';
		$data['hp'] = '45595';
		$data['mp'] = '74920';
		$data['attack'] = '74717';
		$data['defense'] = '41127';
		$data['endurance'] = '70832';
		$data['intellect'] = '41726';
		$data['strength'] = '36250';
		$data['enduranceQualification'] = '35891';
		$data['intellectQualification'] = '31949';
		$data['strengthQualification'] = '34243';
		$data['criticalRate'] = '69356';
		$data['criticalStrikeDamage'] = '69478';
		$data['hitRate'] = '46654';
		$data['dodgeRate'] = '51389';
		$data['penetrate'] = '45012';
		$data['attackSpeed'] = '12761';
		$data['userElement'] = '82595';
		$data['attackElement'] = '82552';
		$data['jin'] = '41040';
		$data['mu'] = '18127';
		$data['tu'] = '67883';
		$data['sui'] = '58614';
		$data['huo'] = '75033';
		$data['light'] = '59337';
		$data['dark'] = '50058';
		$data['luck'] = '76692';
		$data['physicalStrength'] = '17278';
		$model = new UserEquipmentBackpackModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userEquipmentBackpackId'] = $model->userEquipmentBackpackId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

