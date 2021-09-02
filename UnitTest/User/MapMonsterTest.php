<?php

namespace UnitTest\User;

use MapMonsterModel;

/**
 * MapMonsterTest
 * Class MapMonsterTest
 * Create With ClassGeneration
 */
class MapMonsterTest extends UserBaseTestCase
{
	public $modelName = 'MapMonster';


	public function testAdd()
	{
		$data = [];
		$data['monsterId'] = '20851';
		$data['name'] = '测试文本dwUEq0';
		$data['type'] = '19109';
		$data['description'] = '测试文本fWDJnM';
		$data['level'] = '97382';
		$data['hp'] = '41372';
		$data['mp'] = '55400';
		$data['attack'] = '40932';
		$data['defense'] = '44183';
		$data['endurance'] = '65291';
		$data['intellect'] = '77920';
		$data['strength'] = '56654';
		$data['enduranceQualification'] = '28663';
		$data['intellectQualification'] = '62047';
		$data['strengthQualification'] = '34496';
		$data['criticalRate'] = '64893';
		$data['criticalStrikeDamage'] = '40293';
		$data['hitRate'] = '61566';
		$data['penetrate'] = '30089';
		$data['attackSpeed'] = '89648';
		$data['userElement'] = '76428';
		$data['attackElement'] = '24806';
		$data['jin'] = '95603';
		$data['mu'] = '48310';
		$data['tu'] = '68570';
		$data['sui'] = '13735';
		$data['huo'] = '93711';
		$data['light'] = '77691';
		$data['dark'] = '10983';
		$response = $this->request('add',$data);
		$model = new MapMonsterModel();
		$model->destroy($response->result->mapMonsterId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['monsterId'] = '81197';
		$data['name'] = '测试文本kG2CmW';
		$data['type'] = '67881';
		$data['description'] = '测试文本97zCAg';
		$data['level'] = '95778';
		$data['hp'] = '74456';
		$data['mp'] = '44523';
		$data['attack'] = '25212';
		$data['defense'] = '41080';
		$data['endurance'] = '79390';
		$data['intellect'] = '95232';
		$data['strength'] = '27516';
		$data['enduranceQualification'] = '15060';
		$data['intellectQualification'] = '45069';
		$data['strengthQualification'] = '45709';
		$data['criticalRate'] = '40887';
		$data['criticalStrikeDamage'] = '73533';
		$data['hitRate'] = '24298';
		$data['penetrate'] = '17021';
		$data['attackSpeed'] = '56181';
		$data['userElement'] = '63581';
		$data['attackElement'] = '43893';
		$data['jin'] = '63000';
		$data['mu'] = '98566';
		$data['tu'] = '15130';
		$data['sui'] = '88496';
		$data['huo'] = '37712';
		$data['light'] = '33926';
		$data['dark'] = '47301';
		$model = new MapMonsterModel();
		$model->data($data)->save();

		$data = [];
		$data['mapMonsterId'] = $model->mapMonsterId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->mapMonsterId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['monsterId'] = '99756';
		$data['name'] = '测试文本otn9ma';
		$data['type'] = '64138';
		$data['description'] = '测试文本eaj8Sq';
		$data['level'] = '15428';
		$data['hp'] = '63505';
		$data['mp'] = '63660';
		$data['attack'] = '56520';
		$data['defense'] = '28552';
		$data['endurance'] = '54744';
		$data['intellect'] = '24418';
		$data['strength'] = '39306';
		$data['enduranceQualification'] = '54544';
		$data['intellectQualification'] = '91583';
		$data['strengthQualification'] = '89740';
		$data['criticalRate'] = '48840';
		$data['criticalStrikeDamage'] = '20972';
		$data['hitRate'] = '38785';
		$data['penetrate'] = '14353';
		$data['attackSpeed'] = '80259';
		$data['userElement'] = '99564';
		$data['attackElement'] = '67601';
		$data['jin'] = '68445';
		$data['mu'] = '18020';
		$data['tu'] = '30120';
		$data['sui'] = '72761';
		$data['huo'] = '82634';
		$data['light'] = '51059';
		$data['dark'] = '93529';
		$model = new MapMonsterModel();
		$model->data($data)->save();

		$update = [];
		$update['mapMonsterId'] = $model->mapMonsterId;
		$update['monsterId'] = '74716';
		$update['name'] = '测试文本MDRWdT';
		$update['type'] = '44203';
		$update['description'] = '测试文本7AXNTU';
		$update['level'] = '71632';
		$update['hp'] = '42585';
		$update['mp'] = '87760';
		$update['attack'] = '18119';
		$update['defense'] = '89594';
		$update['endurance'] = '99302';
		$update['intellect'] = '19222';
		$update['strength'] = '16817';
		$update['enduranceQualification'] = '10995';
		$update['intellectQualification'] = '31045';
		$update['strengthQualification'] = '16055';
		$update['criticalRate'] = '30381';
		$update['criticalStrikeDamage'] = '84239';
		$update['hitRate'] = '49559';
		$update['penetrate'] = '69923';
		$update['attackSpeed'] = '16015';
		$update['userElement'] = '17521';
		$update['attackElement'] = '85386';
		$update['jin'] = '82044';
		$update['mu'] = '16340';
		$update['tu'] = '73985';
		$update['sui'] = '15246';
		$update['huo'] = '23057';
		$update['light'] = '17607';
		$update['dark'] = '40164';
		$response = $this->request('update',$update);
		$model->destroy($model->mapMonsterId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new MapMonsterModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['monsterId'] = '48874';
		$data['name'] = '测试文本hZQiLC';
		$data['type'] = '34403';
		$data['description'] = '测试文本kzNrld';
		$data['level'] = '94842';
		$data['hp'] = '35583';
		$data['mp'] = '49184';
		$data['attack'] = '15710';
		$data['defense'] = '95939';
		$data['endurance'] = '90579';
		$data['intellect'] = '10358';
		$data['strength'] = '79040';
		$data['enduranceQualification'] = '35009';
		$data['intellectQualification'] = '73058';
		$data['strengthQualification'] = '34805';
		$data['criticalRate'] = '76301';
		$data['criticalStrikeDamage'] = '67652';
		$data['hitRate'] = '76736';
		$data['penetrate'] = '78059';
		$data['attackSpeed'] = '62703';
		$data['userElement'] = '58295';
		$data['attackElement'] = '97984';
		$data['jin'] = '70172';
		$data['mu'] = '18032';
		$data['tu'] = '58812';
		$data['sui'] = '55935';
		$data['huo'] = '12744';
		$data['light'] = '22682';
		$data['dark'] = '66367';
		$model = new MapMonsterModel();
		$model->data($data)->save();

		$delData = [];
		$delData['mapMonsterId'] = $model->mapMonsterId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

