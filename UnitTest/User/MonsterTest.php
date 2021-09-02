<?php

namespace UnitTest\User;

use MonsterModel;

/**
 * MonsterTest
 * Class MonsterTest
 * Create With ClassGeneration
 */
class MonsterTest extends UserBaseTestCase
{
	public $modelName = 'Monster';


	public function testAdd()
	{
		$data = [];
		$data['name'] = '测试文本bROCiM';
		$data['type'] = '25643';
		$data['description'] = '测试文本SWUzc6';
		$data['level'] = '57469';
		$data['hp'] = '44513';
		$data['mp'] = '55458';
		$data['attack'] = '75973';
		$data['defense'] = '55750';
		$data['endurance'] = '65181';
		$data['intellect'] = '64922';
		$data['strength'] = '56762';
		$data['enduranceQualification'] = '35511';
		$data['intellectQualification'] = '88267';
		$data['strengthQualification'] = '98253';
		$data['criticalRate'] = '39041';
		$data['criticalStrikeDamage'] = '64167';
		$data['hitRate'] = '95628';
		$data['penetrate'] = '24713';
		$data['attackSpeed'] = '49582';
		$data['userElement'] = '63215';
		$data['attackElement'] = '30601';
		$data['jin'] = '55589';
		$data['mu'] = '51052';
		$data['tu'] = '90608';
		$data['sui'] = '31949';
		$data['huo'] = '92560';
		$data['light'] = '53740';
		$data['dark'] = '24228';
		$response = $this->request('add',$data);
		$model = new MonsterModel();
		$model->destroy($response->result->monsterId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = '测试文本Zrb3SX';
		$data['type'] = '97667';
		$data['description'] = '测试文本6yvAHY';
		$data['level'] = '74773';
		$data['hp'] = '94907';
		$data['mp'] = '33863';
		$data['attack'] = '23428';
		$data['defense'] = '15975';
		$data['endurance'] = '96473';
		$data['intellect'] = '66688';
		$data['strength'] = '88368';
		$data['enduranceQualification'] = '21788';
		$data['intellectQualification'] = '15348';
		$data['strengthQualification'] = '59876';
		$data['criticalRate'] = '93184';
		$data['criticalStrikeDamage'] = '46408';
		$data['hitRate'] = '96831';
		$data['penetrate'] = '29926';
		$data['attackSpeed'] = '47829';
		$data['userElement'] = '78412';
		$data['attackElement'] = '33021';
		$data['jin'] = '71569';
		$data['mu'] = '47017';
		$data['tu'] = '82581';
		$data['sui'] = '41020';
		$data['huo'] = '92432';
		$data['light'] = '47489';
		$data['dark'] = '91337';
		$model = new MonsterModel();
		$model->data($data)->save();

		$data = [];
		$data['monsterId'] = $model->monsterId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->monsterId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['name'] = '测试文本8niamG';
		$data['type'] = '94661';
		$data['description'] = '测试文本A7U05D';
		$data['level'] = '23441';
		$data['hp'] = '26637';
		$data['mp'] = '39975';
		$data['attack'] = '98318';
		$data['defense'] = '37627';
		$data['endurance'] = '85982';
		$data['intellect'] = '66706';
		$data['strength'] = '71497';
		$data['enduranceQualification'] = '73258';
		$data['intellectQualification'] = '91503';
		$data['strengthQualification'] = '74774';
		$data['criticalRate'] = '32121';
		$data['criticalStrikeDamage'] = '83633';
		$data['hitRate'] = '16480';
		$data['penetrate'] = '99146';
		$data['attackSpeed'] = '46858';
		$data['userElement'] = '54113';
		$data['attackElement'] = '83568';
		$data['jin'] = '40358';
		$data['mu'] = '19066';
		$data['tu'] = '64780';
		$data['sui'] = '29930';
		$data['huo'] = '89247';
		$data['light'] = '81311';
		$data['dark'] = '48493';
		$model = new MonsterModel();
		$model->data($data)->save();

		$update = [];
		$update['monsterId'] = $model->monsterId;
		$update['name'] = '测试文本MED8ju';
		$update['type'] = '85486';
		$update['description'] = '测试文本s8WIzo';
		$update['level'] = '78086';
		$update['hp'] = '96670';
		$update['mp'] = '27413';
		$update['attack'] = '31522';
		$update['defense'] = '46226';
		$update['endurance'] = '23202';
		$update['intellect'] = '69643';
		$update['strength'] = '54791';
		$update['enduranceQualification'] = '46193';
		$update['intellectQualification'] = '62204';
		$update['strengthQualification'] = '86792';
		$update['criticalRate'] = '44672';
		$update['criticalStrikeDamage'] = '90337';
		$update['hitRate'] = '40962';
		$update['penetrate'] = '26883';
		$update['attackSpeed'] = '93409';
		$update['userElement'] = '93877';
		$update['attackElement'] = '95597';
		$update['jin'] = '50409';
		$update['mu'] = '60758';
		$update['tu'] = '24883';
		$update['sui'] = '96986';
		$update['huo'] = '23250';
		$update['light'] = '89214';
		$update['dark'] = '83028';
		$response = $this->request('update',$update);
		$model->destroy($model->monsterId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new MonsterModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['name'] = '测试文本Lu58QC';
		$data['type'] = '56241';
		$data['description'] = '测试文本Wot1Om';
		$data['level'] = '26392';
		$data['hp'] = '37252';
		$data['mp'] = '78315';
		$data['attack'] = '10569';
		$data['defense'] = '25288';
		$data['endurance'] = '77169';
		$data['intellect'] = '86597';
		$data['strength'] = '13729';
		$data['enduranceQualification'] = '44235';
		$data['intellectQualification'] = '87502';
		$data['strengthQualification'] = '64246';
		$data['criticalRate'] = '60198';
		$data['criticalStrikeDamage'] = '78275';
		$data['hitRate'] = '48096';
		$data['penetrate'] = '55609';
		$data['attackSpeed'] = '22630';
		$data['userElement'] = '19111';
		$data['attackElement'] = '20426';
		$data['jin'] = '33779';
		$data['mu'] = '89663';
		$data['tu'] = '16006';
		$data['sui'] = '41021';
		$data['huo'] = '66465';
		$data['light'] = '34193';
		$data['dark'] = '57925';
		$model = new MonsterModel();
		$model->data($data)->save();

		$delData = [];
		$delData['monsterId'] = $model->monsterId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

