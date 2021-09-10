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
		$data['monsterId'] = '72450';
		$data['mapId'] = '40911';
		$data['mapLevelMin'] = '3';
		$data['mapLevelMax'] = '2';
		$data['name'] = '测试文本5X4T8d';
		$data['type'] = '78308';
		$data['description'] = '测试文本YKZuf0';
		$data['level'] = '71252';
		$data['hp'] = '58397';
		$data['mp'] = '95748';
		$data['attack'] = '97327';
		$data['defense'] = '26060';
		$data['endurance'] = '35439';
		$data['intellect'] = '41180';
		$data['strength'] = '44840';
		$data['enduranceQualification'] = '60387';
		$data['intellectQualification'] = '99671';
		$data['strengthQualification'] = '43138';
		$data['criticalRate'] = '99431';
		$data['criticalStrikeDamage'] = '30148';
		$data['hitRate'] = '35861';
		$data['dodgeRate'] = '87497';
		$data['penetrate'] = '61410';
		$data['attackSpeed'] = '61779';
		$data['userElement'] = '20467';
		$data['attackElement'] = '30919';
		$data['jin'] = '18097';
		$data['mu'] = '50852';
		$data['tu'] = '71444';
		$data['sui'] = '28460';
		$data['huo'] = '22169';
		$data['light'] = '13674';
		$data['dark'] = '21511';
		$response = $this->request('add',$data);
		$model = new MapMonsterModel();
		$model->destroy($response->result->mapMonsterId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['monsterId'] = '85685';
		$data['mapId'] = '66203';
		$data['mapLevelMin'] = '2';
		$data['mapLevelMax'] = '1';
		$data['name'] = '测试文本BA8kO4';
		$data['type'] = '58555';
		$data['description'] = '测试文本AiGT0E';
		$data['level'] = '82353';
		$data['hp'] = '71809';
		$data['mp'] = '96165';
		$data['attack'] = '78641';
		$data['defense'] = '36437';
		$data['endurance'] = '17399';
		$data['intellect'] = '74674';
		$data['strength'] = '57151';
		$data['enduranceQualification'] = '78980';
		$data['intellectQualification'] = '20187';
		$data['strengthQualification'] = '90279';
		$data['criticalRate'] = '24796';
		$data['criticalStrikeDamage'] = '55227';
		$data['hitRate'] = '41670';
		$data['dodgeRate'] = '57737';
		$data['penetrate'] = '49218';
		$data['attackSpeed'] = '91530';
		$data['userElement'] = '66530';
		$data['attackElement'] = '17457';
		$data['jin'] = '41098';
		$data['mu'] = '42967';
		$data['tu'] = '55590';
		$data['sui'] = '68778';
		$data['huo'] = '34225';
		$data['light'] = '54964';
		$data['dark'] = '24477';
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
		$data['monsterId'] = '37138';
		$data['mapId'] = '68593';
		$data['mapLevelMin'] = '2';
		$data['mapLevelMax'] = '3';
		$data['name'] = '测试文本yv9lFX';
		$data['type'] = '79413';
		$data['description'] = '测试文本EVR7I6';
		$data['level'] = '10953';
		$data['hp'] = '35271';
		$data['mp'] = '77547';
		$data['attack'] = '45251';
		$data['defense'] = '22977';
		$data['endurance'] = '30510';
		$data['intellect'] = '41649';
		$data['strength'] = '24365';
		$data['enduranceQualification'] = '58109';
		$data['intellectQualification'] = '72807';
		$data['strengthQualification'] = '50168';
		$data['criticalRate'] = '53998';
		$data['criticalStrikeDamage'] = '85340';
		$data['hitRate'] = '21687';
		$data['dodgeRate'] = '55050';
		$data['penetrate'] = '83068';
		$data['attackSpeed'] = '86988';
		$data['userElement'] = '43208';
		$data['attackElement'] = '10794';
		$data['jin'] = '60975';
		$data['mu'] = '51704';
		$data['tu'] = '93499';
		$data['sui'] = '15395';
		$data['huo'] = '22617';
		$data['light'] = '81575';
		$data['dark'] = '28375';
		$model = new MapMonsterModel();
		$model->data($data)->save();

		$update = [];
		$update['mapMonsterId'] = $model->mapMonsterId;
		$update['monsterId'] = '28696';
		$update['mapId'] = '99960';
		$update['mapLevelMin'] = '3';
		$update['mapLevelMax'] = '2';
		$update['name'] = '测试文本HxFTbt';
		$update['type'] = '48747';
		$update['description'] = '测试文本OWh2Tl';
		$update['level'] = '88231';
		$update['hp'] = '35854';
		$update['mp'] = '68138';
		$update['attack'] = '42496';
		$update['defense'] = '86999';
		$update['endurance'] = '47206';
		$update['intellect'] = '42592';
		$update['strength'] = '77090';
		$update['enduranceQualification'] = '64051';
		$update['intellectQualification'] = '49348';
		$update['strengthQualification'] = '82615';
		$update['criticalRate'] = '75156';
		$update['criticalStrikeDamage'] = '50448';
		$update['hitRate'] = '50551';
		$update['dodgeRate'] = '63678';
		$update['penetrate'] = '57929';
		$update['attackSpeed'] = '12653';
		$update['userElement'] = '59164';
		$update['attackElement'] = '38012';
		$update['jin'] = '74709';
		$update['mu'] = '57010';
		$update['tu'] = '94582';
		$update['sui'] = '79051';
		$update['huo'] = '19498';
		$update['light'] = '89746';
		$update['dark'] = '82217';
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
		$data['monsterId'] = '78193';
		$data['mapId'] = '21582';
		$data['mapLevelMin'] = '0';
		$data['mapLevelMax'] = '3';
		$data['name'] = '测试文本R9qXVN';
		$data['type'] = '90502';
		$data['description'] = '测试文本S0K2Yq';
		$data['level'] = '12353';
		$data['hp'] = '55835';
		$data['mp'] = '76988';
		$data['attack'] = '34676';
		$data['defense'] = '92316';
		$data['endurance'] = '97887';
		$data['intellect'] = '32874';
		$data['strength'] = '82511';
		$data['enduranceQualification'] = '49280';
		$data['intellectQualification'] = '56643';
		$data['strengthQualification'] = '10847';
		$data['criticalRate'] = '43902';
		$data['criticalStrikeDamage'] = '92670';
		$data['hitRate'] = '70692';
		$data['dodgeRate'] = '66763';
		$data['penetrate'] = '47178';
		$data['attackSpeed'] = '79895';
		$data['userElement'] = '86493';
		$data['attackElement'] = '98669';
		$data['jin'] = '39522';
		$data['mu'] = '15718';
		$data['tu'] = '31077';
		$data['sui'] = '49620';
		$data['huo'] = '37001';
		$data['light'] = '19332';
		$data['dark'] = '84300';
		$model = new MapMonsterModel();
		$model->data($data)->save();

		$delData = [];
		$delData['mapMonsterId'] = $model->mapMonsterId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

