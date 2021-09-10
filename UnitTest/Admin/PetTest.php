<?php

namespace UnitTest\Admin;

use PetModel;

/**
 * PetTest
 * Class PetTest
 * Create With ClassGeneration
 */
class PetTest extends AdminBaseTestCase
{
	public $modelName = 'Pet';


	public function testAdd()
	{
		$data = [];
		$data['name'] = '测试文本JX54p3';
		$data['type'] = '测试文本8bGAeO';
		$data['description'] = '测试文本F8hMC4';
		$data['level'] = '67356';
		$data['hp'] = '71426';
		$data['mp'] = '98004';
		$data['attack'] = '56170';
		$data['defense'] = '73074';
		$data['endurance'] = '81258';
		$data['intellect'] = '11213';
		$data['strength'] = '20457';
		$data['enduranceQualification'] = '99591';
		$data['intellectQualification'] = '91752';
		$data['strengthQualification'] = '22380';
		$data['criticalRate'] = '88321';
		$data['criticalStrikeDamage'] = '27691';
		$data['hitRate'] = '63946';
		$data['dodgeRate'] = '60067';
		$data['penetrate'] = '89651';
		$data['attackSpeed'] = '63969';
		$data['userElement'] = '78428';
		$data['attackElement'] = '32104';
		$data['jin'] = '54365';
		$data['mu'] = '65823';
		$data['tu'] = '34241';
		$data['sui'] = '43216';
		$data['huo'] = '86663';
		$data['light'] = '97607';
		$data['dark'] = '36918';
		$response = $this->request('add',$data);
		$model = new PetModel();
		$model->destroy($response->result->petId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = '测试文本wr3oLW';
		$data['type'] = '测试文本ThpVxG';
		$data['description'] = '测试文本0VOaPB';
		$data['level'] = '22227';
		$data['hp'] = '97033';
		$data['mp'] = '10260';
		$data['attack'] = '11048';
		$data['defense'] = '46386';
		$data['endurance'] = '43004';
		$data['intellect'] = '41717';
		$data['strength'] = '63619';
		$data['enduranceQualification'] = '59305';
		$data['intellectQualification'] = '67089';
		$data['strengthQualification'] = '41573';
		$data['criticalRate'] = '62724';
		$data['criticalStrikeDamage'] = '72746';
		$data['hitRate'] = '32726';
		$data['dodgeRate'] = '64220';
		$data['penetrate'] = '31131';
		$data['attackSpeed'] = '93103';
		$data['userElement'] = '52292';
		$data['attackElement'] = '76234';
		$data['jin'] = '34796';
		$data['mu'] = '51953';
		$data['tu'] = '65097';
		$data['sui'] = '27928';
		$data['huo'] = '25090';
		$data['light'] = '91934';
		$data['dark'] = '99601';
		$model = new PetModel();
		$model->data($data)->save();

		$data = [];
		$data['petId'] = $model->petId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->petId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['name'] = '测试文本pm8FSd';
		$data['type'] = '测试文本dHPAx8';
		$data['description'] = '测试文本e38cD9';
		$data['level'] = '14006';
		$data['hp'] = '11195';
		$data['mp'] = '45286';
		$data['attack'] = '35665';
		$data['defense'] = '88118';
		$data['endurance'] = '84840';
		$data['intellect'] = '76317';
		$data['strength'] = '55169';
		$data['enduranceQualification'] = '96131';
		$data['intellectQualification'] = '42771';
		$data['strengthQualification'] = '52254';
		$data['criticalRate'] = '65991';
		$data['criticalStrikeDamage'] = '81055';
		$data['hitRate'] = '85815';
		$data['dodgeRate'] = '70033';
		$data['penetrate'] = '60556';
		$data['attackSpeed'] = '96317';
		$data['userElement'] = '94770';
		$data['attackElement'] = '26673';
		$data['jin'] = '53522';
		$data['mu'] = '79228';
		$data['tu'] = '44982';
		$data['sui'] = '69950';
		$data['huo'] = '10383';
		$data['light'] = '12559';
		$data['dark'] = '62632';
		$model = new PetModel();
		$model->data($data)->save();

		$update = [];
		$update['petId'] = $model->petId;
		$update['name'] = '测试文本NhLRQI';
		$update['type'] = '测试文本atxGkN';
		$update['description'] = '测试文本qopeQL';
		$update['level'] = '82760';
		$update['hp'] = '19036';
		$update['mp'] = '59723';
		$update['attack'] = '37189';
		$update['defense'] = '52777';
		$update['endurance'] = '33510';
		$update['intellect'] = '66113';
		$update['strength'] = '75509';
		$update['enduranceQualification'] = '39882';
		$update['intellectQualification'] = '74278';
		$update['strengthQualification'] = '91886';
		$update['criticalRate'] = '23481';
		$update['criticalStrikeDamage'] = '29774';
		$update['hitRate'] = '37179';
		$update['dodgeRate'] = '70326';
		$update['penetrate'] = '35549';
		$update['attackSpeed'] = '38501';
		$update['userElement'] = '28430';
		$update['attackElement'] = '78644';
		$update['jin'] = '34763';
		$update['mu'] = '22465';
		$update['tu'] = '79880';
		$update['sui'] = '56460';
		$update['huo'] = '48556';
		$update['light'] = '29796';
		$update['dark'] = '36636';
		$response = $this->request('update',$update);
		$model->destroy($model->petId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new PetModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['name'] = '测试文本FGMJCU';
		$data['type'] = '测试文本M2H0lO';
		$data['description'] = '测试文本mJILta';
		$data['level'] = '43030';
		$data['hp'] = '49279';
		$data['mp'] = '21587';
		$data['attack'] = '95614';
		$data['defense'] = '28397';
		$data['endurance'] = '30982';
		$data['intellect'] = '25189';
		$data['strength'] = '22474';
		$data['enduranceQualification'] = '98134';
		$data['intellectQualification'] = '38874';
		$data['strengthQualification'] = '69963';
		$data['criticalRate'] = '13808';
		$data['criticalStrikeDamage'] = '80937';
		$data['hitRate'] = '20887';
		$data['dodgeRate'] = '55075';
		$data['penetrate'] = '19413';
		$data['attackSpeed'] = '92858';
		$data['userElement'] = '87698';
		$data['attackElement'] = '62608';
		$data['jin'] = '29356';
		$data['mu'] = '28685';
		$data['tu'] = '95650';
		$data['sui'] = '93784';
		$data['huo'] = '88170';
		$data['light'] = '58426';
		$data['dark'] = '70397';
		$model = new PetModel();
		$model->data($data)->save();

		$delData = [];
		$delData['petId'] = $model->petId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

