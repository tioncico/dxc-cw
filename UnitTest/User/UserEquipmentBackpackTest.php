<?php

namespace UnitTest\User;

use App\Model\UserEquipmentBackpackModel;

/**
 * UserEquipmentBackpackTest
 * Class UserEquipmentBackpackTest
 * Create With ClassGeneration
 */
class UserEquipmentBackpackTest extends UserBaseTestCase
{
	public $modelName = '/Api/User/UserEquipmentBackpack';


	public function testAdd()
	{
		$data = [];
		$data['backpackId'] = '13199';
		$data['userId'] = '74925';
		$data['isUse'] = '3';
		$data['strengthenLevel'] = '93891';
		$data['goodsCode'] = '测试文本P0ovhK';
		$data['equipmentType'] = '1';
		$data['suitCode'] = '测试文本hTde6w';
		$data['rarityLevel'] = '91206';
		$data['level'] = '86060';
		$data['hp'] = '29771';
		$data['mp'] = '47726';
		$data['attack'] = '72323';
		$data['defense'] = '33588';
		$data['endurance'] = '57965';
		$data['intellect'] = '78957';
		$data['strength'] = '58497';
		$data['enduranceQualification'] = '90384';
		$data['intellectQualification'] = '25360';
		$data['strengthQualification'] = '78932';
		$data['criticalRate'] = '61776';
		$data['criticalStrikeDamage'] = '82225';
		$data['hitRate'] = '36617';
		$data['dodgeRate'] = '82377';
		$data['penetrate'] = '79495';
		$data['attackSpeed'] = '75878';
		$data['userElement'] = '13804';
		$data['attackElement'] = '34317';
		$data['jin'] = '87484';
		$data['mu'] = '55948';
		$data['tu'] = '42209';
		$data['sui'] = '11252';
		$data['huo'] = '10404';
		$data['light'] = '73925';
		$data['dark'] = '13858';
		$data['luck'] = '34331';
		$data['physicalStrength'] = '94554';
		$response = $this->request('add',$data);
		$model = new UserEquipmentBackpackModel();
		$model->destroy($response->result->userEquipmentBackpackId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['backpackId'] = '54789';
		$data['userId'] = '48654';
		$data['isUse'] = '1';
		$data['strengthenLevel'] = '94032';
		$data['goodsCode'] = '测试文本yrzaub';
		$data['equipmentType'] = '3';
		$data['suitCode'] = '测试文本cmRClw';
		$data['rarityLevel'] = '68114';
		$data['level'] = '20034';
		$data['hp'] = '42074';
		$data['mp'] = '87334';
		$data['attack'] = '74081';
		$data['defense'] = '86873';
		$data['endurance'] = '86481';
		$data['intellect'] = '99747';
		$data['strength'] = '46408';
		$data['enduranceQualification'] = '34389';
		$data['intellectQualification'] = '68134';
		$data['strengthQualification'] = '62264';
		$data['criticalRate'] = '45622';
		$data['criticalStrikeDamage'] = '93591';
		$data['hitRate'] = '49198';
		$data['dodgeRate'] = '91384';
		$data['penetrate'] = '14171';
		$data['attackSpeed'] = '71514';
		$data['userElement'] = '29243';
		$data['attackElement'] = '91100';
		$data['jin'] = '87188';
		$data['mu'] = '87305';
		$data['tu'] = '95482';
		$data['sui'] = '64413';
		$data['huo'] = '72932';
		$data['light'] = '33296';
		$data['dark'] = '52850';
		$data['luck'] = '11500';
		$data['physicalStrength'] = '82077';
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
		$data['backpackId'] = '31504';
		$data['userId'] = '19692';
		$data['isUse'] = '2';
		$data['strengthenLevel'] = '74845';
		$data['goodsCode'] = '测试文本a2C6Xd';
		$data['equipmentType'] = '2';
		$data['suitCode'] = '测试文本HQhydj';
		$data['rarityLevel'] = '79539';
		$data['level'] = '53797';
		$data['hp'] = '94685';
		$data['mp'] = '13296';
		$data['attack'] = '21644';
		$data['defense'] = '60821';
		$data['endurance'] = '78105';
		$data['intellect'] = '50168';
		$data['strength'] = '81311';
		$data['enduranceQualification'] = '99582';
		$data['intellectQualification'] = '70196';
		$data['strengthQualification'] = '38279';
		$data['criticalRate'] = '93417';
		$data['criticalStrikeDamage'] = '57838';
		$data['hitRate'] = '10678';
		$data['dodgeRate'] = '22225';
		$data['penetrate'] = '18259';
		$data['attackSpeed'] = '12418';
		$data['userElement'] = '13338';
		$data['attackElement'] = '70064';
		$data['jin'] = '83070';
		$data['mu'] = '99290';
		$data['tu'] = '99733';
		$data['sui'] = '84309';
		$data['huo'] = '64571';
		$data['light'] = '90117';
		$data['dark'] = '79112';
		$data['luck'] = '54146';
		$data['physicalStrength'] = '47622';
		$model = new UserEquipmentBackpackModel();
		$model->data($data)->save();

		$update = [];
		$update['userEquipmentBackpackId'] = $model->userEquipmentBackpackId;
		$update['backpackId'] = '17804';
		$update['userId'] = '94207';
		$update['isUse'] = '3';
		$update['strengthenLevel'] = '55749';
		$update['goodsCode'] = '测试文本VUANl0';
		$update['equipmentType'] = '0';
		$update['suitCode'] = '测试文本VPAmhQ';
		$update['rarityLevel'] = '49466';
		$update['level'] = '86599';
		$update['hp'] = '81079';
		$update['mp'] = '67663';
		$update['attack'] = '60260';
		$update['defense'] = '68076';
		$update['endurance'] = '34819';
		$update['intellect'] = '67443';
		$update['strength'] = '49602';
		$update['enduranceQualification'] = '13189';
		$update['intellectQualification'] = '46901';
		$update['strengthQualification'] = '22559';
		$update['criticalRate'] = '17768';
		$update['criticalStrikeDamage'] = '73159';
		$update['hitRate'] = '73576';
		$update['dodgeRate'] = '28470';
		$update['penetrate'] = '26874';
		$update['attackSpeed'] = '53088';
		$update['userElement'] = '19327';
		$update['attackElement'] = '11395';
		$update['jin'] = '10198';
		$update['mu'] = '88704';
		$update['tu'] = '73166';
		$update['sui'] = '22153';
		$update['huo'] = '87861';
		$update['light'] = '33287';
		$update['dark'] = '69449';
		$update['luck'] = '45283';
		$update['physicalStrength'] = '11654';
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
		$data['backpackId'] = '56115';
		$data['userId'] = '78995';
		$data['isUse'] = '0';
		$data['strengthenLevel'] = '58827';
		$data['goodsCode'] = '测试文本AkxwH5';
		$data['equipmentType'] = '1';
		$data['suitCode'] = '测试文本ElbAq2';
		$data['rarityLevel'] = '57879';
		$data['level'] = '63163';
		$data['hp'] = '13620';
		$data['mp'] = '33876';
		$data['attack'] = '18537';
		$data['defense'] = '32756';
		$data['endurance'] = '88234';
		$data['intellect'] = '74085';
		$data['strength'] = '96308';
		$data['enduranceQualification'] = '10575';
		$data['intellectQualification'] = '82339';
		$data['strengthQualification'] = '95801';
		$data['criticalRate'] = '15364';
		$data['criticalStrikeDamage'] = '90077';
		$data['hitRate'] = '68956';
		$data['dodgeRate'] = '81906';
		$data['penetrate'] = '32714';
		$data['attackSpeed'] = '84954';
		$data['userElement'] = '84911';
		$data['attackElement'] = '94099';
		$data['jin'] = '80280';
		$data['mu'] = '38884';
		$data['tu'] = '24738';
		$data['sui'] = '89840';
		$data['huo'] = '17378';
		$data['light'] = '61428';
		$data['dark'] = '46271';
		$data['luck'] = '48315';
		$data['physicalStrength'] = '86902';
		$model = new UserEquipmentBackpackModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userEquipmentBackpackId'] = $model->userEquipmentBackpackId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

