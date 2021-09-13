<?php

namespace UnitTest\Admin;

use MapMonsterModel;

/**
 * MapMonsterTest
 * Class MapMonsterTest
 * Create With ClassGeneration
 */
class MapMonsterTest extends AdminBaseTestCase
{
	public $modelName = 'MapMonster';


	public function testAdd()
	{
		$data = [];
		$data['monsterId'] = '73881';
		$data['mapId'] = '43525';
		$data['mapLevelMin'] = '2';
		$data['mapLevelMax'] = '2';
		$data['name'] = '测试文本YutsTN';
		$data['type'] = '50735';
		$data['description'] = '测试文本KpV57P';
		$data['level'] = '35486';
		$data['hp'] = '94001';
		$data['mp'] = '72932';
		$data['attack'] = '73977';
		$data['defense'] = '80874';
		$data['endurance'] = '38810';
		$data['intellect'] = '78863';
		$data['strength'] = '66038';
		$data['enduranceQualification'] = '49338';
		$data['intellectQualification'] = '52798';
		$data['strengthQualification'] = '30079';
		$data['criticalRate'] = '65036';
		$data['criticalStrikeDamage'] = '98372';
		$data['hitRate'] = '46302';
		$data['dodgeRate'] = '80498';
		$data['penetrate'] = '65851';
		$data['attackSpeed'] = '87488';
		$data['userElement'] = '34733';
		$data['attackElement'] = '11729';
		$data['jin'] = '26121';
		$data['mu'] = '81237';
		$data['tu'] = '20791';
		$data['sui'] = '84845';
		$data['huo'] = '11848';
		$data['light'] = '48950';
		$data['dark'] = '12133';
		$response = $this->request('add',$data);
		$model = new MapMonsterModel();
		$model->destroy($response->result->mapMonsterId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['monsterId'] = '55114';
		$data['mapId'] = '34925';
		$data['mapLevelMin'] = '2';
		$data['mapLevelMax'] = '2';
		$data['name'] = '测试文本RLNrzT';
		$data['type'] = '17137';
		$data['description'] = '测试文本lVObP8';
		$data['level'] = '77007';
		$data['hp'] = '92017';
		$data['mp'] = '14959';
		$data['attack'] = '58037';
		$data['defense'] = '17137';
		$data['endurance'] = '60198';
		$data['intellect'] = '79410';
		$data['strength'] = '59059';
		$data['enduranceQualification'] = '47588';
		$data['intellectQualification'] = '87859';
		$data['strengthQualification'] = '37672';
		$data['criticalRate'] = '84944';
		$data['criticalStrikeDamage'] = '12825';
		$data['hitRate'] = '39956';
		$data['dodgeRate'] = '85037';
		$data['penetrate'] = '90739';
		$data['attackSpeed'] = '91185';
		$data['userElement'] = '45732';
		$data['attackElement'] = '66405';
		$data['jin'] = '59737';
		$data['mu'] = '65612';
		$data['tu'] = '24485';
		$data['sui'] = '43661';
		$data['huo'] = '55984';
		$data['light'] = '64165';
		$data['dark'] = '63389';
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
		$data['monsterId'] = '49087';
		$data['mapId'] = '59884';
		$data['mapLevelMin'] = '2';
		$data['mapLevelMax'] = '1';
		$data['name'] = '测试文本wqlF0Z';
		$data['type'] = '75149';
		$data['description'] = '测试文本xsgI7q';
		$data['level'] = '77666';
		$data['hp'] = '97335';
		$data['mp'] = '59167';
		$data['attack'] = '51351';
		$data['defense'] = '69322';
		$data['endurance'] = '66668';
		$data['intellect'] = '48145';
		$data['strength'] = '53619';
		$data['enduranceQualification'] = '49868';
		$data['intellectQualification'] = '53316';
		$data['strengthQualification'] = '21927';
		$data['criticalRate'] = '28510';
		$data['criticalStrikeDamage'] = '78818';
		$data['hitRate'] = '26012';
		$data['dodgeRate'] = '38614';
		$data['penetrate'] = '91791';
		$data['attackSpeed'] = '17891';
		$data['userElement'] = '84855';
		$data['attackElement'] = '63885';
		$data['jin'] = '73251';
		$data['mu'] = '70415';
		$data['tu'] = '19679';
		$data['sui'] = '18370';
		$data['huo'] = '30849';
		$data['light'] = '10846';
		$data['dark'] = '28785';
		$model = new MapMonsterModel();
		$model->data($data)->save();

		$update = [];
		$update['mapMonsterId'] = $model->mapMonsterId;
		$update['monsterId'] = '55645';
		$update['mapId'] = '61582';
		$update['mapLevelMin'] = '0';
		$update['mapLevelMax'] = '2';
		$update['name'] = '测试文本U8Cehd';
		$update['type'] = '47932';
		$update['description'] = '测试文本YjuWck';
		$update['level'] = '72030';
		$update['hp'] = '49580';
		$update['mp'] = '91681';
		$update['attack'] = '21018';
		$update['defense'] = '97684';
		$update['endurance'] = '40695';
		$update['intellect'] = '68474';
		$update['strength'] = '19499';
		$update['enduranceQualification'] = '14937';
		$update['intellectQualification'] = '14608';
		$update['strengthQualification'] = '53058';
		$update['criticalRate'] = '63306';
		$update['criticalStrikeDamage'] = '79400';
		$update['hitRate'] = '51314';
		$update['dodgeRate'] = '10391';
		$update['penetrate'] = '10407';
		$update['attackSpeed'] = '59472';
		$update['userElement'] = '96786';
		$update['attackElement'] = '18126';
		$update['jin'] = '97708';
		$update['mu'] = '12516';
		$update['tu'] = '97157';
		$update['sui'] = '75171';
		$update['huo'] = '42431';
		$update['light'] = '94313';
		$update['dark'] = '65417';
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
		$data['monsterId'] = '25691';
		$data['mapId'] = '42378';
		$data['mapLevelMin'] = '3';
		$data['mapLevelMax'] = '0';
		$data['name'] = '测试文本lbH8f3';
		$data['type'] = '73983';
		$data['description'] = '测试文本8LN3gd';
		$data['level'] = '43612';
		$data['hp'] = '89762';
		$data['mp'] = '74798';
		$data['attack'] = '91728';
		$data['defense'] = '44374';
		$data['endurance'] = '94176';
		$data['intellect'] = '33315';
		$data['strength'] = '86250';
		$data['enduranceQualification'] = '24481';
		$data['intellectQualification'] = '15704';
		$data['strengthQualification'] = '23934';
		$data['criticalRate'] = '52939';
		$data['criticalStrikeDamage'] = '40116';
		$data['hitRate'] = '54735';
		$data['dodgeRate'] = '69573';
		$data['penetrate'] = '53557';
		$data['attackSpeed'] = '53491';
		$data['userElement'] = '87257';
		$data['attackElement'] = '68458';
		$data['jin'] = '21912';
		$data['mu'] = '32742';
		$data['tu'] = '93471';
		$data['sui'] = '60184';
		$data['huo'] = '60903';
		$data['light'] = '48477';
		$data['dark'] = '29957';
		$model = new MapMonsterModel();
		$model->data($data)->save();

		$delData = [];
		$delData['mapMonsterId'] = $model->mapMonsterId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

