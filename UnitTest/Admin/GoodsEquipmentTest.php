<?php

namespace UnitTest\Admin;

use GoodsEquipmentModel;

/**
 * GoodsEquipmentTest
 * Class GoodsEquipmentTest
 * Create With ClassGeneration
 */
class GoodsEquipmentTest extends AdminBaseTestCase
{
	public $modelName = 'GoodsEquipment';


	public function testAdd()
	{
		$data = [];
		$data['goodsCode'] = '测试文本vgNGxk';
		$data['equipmentType'] = '3';
		$data['suitCode'] = '测试文本TliuMt';
		$data['rarityLevel'] = '59791';
		$data['level'] = '76458';
		$data['hp'] = '95874';
		$data['mp'] = '93417';
		$data['attack'] = '80360';
		$data['defense'] = '61129';
		$data['endurance'] = '33275';
		$data['intellect'] = '41678';
		$data['strength'] = '56243';
		$data['enduranceQualification'] = '95022';
		$data['intellectQualification'] = '34872';
		$data['strengthQualification'] = '36753';
		$data['criticalRate'] = '17050';
		$data['criticalStrikeDamage'] = '30767';
		$data['hitRate'] = '28713';
		$data['penetrate'] = '24584';
		$data['attackSpeed'] = '16094';
		$data['userElement'] = '64112';
		$data['attackElement'] = '50283';
		$data['jin'] = '82853';
		$data['mu'] = '76808';
		$data['tu'] = '78753';
		$data['sui'] = '80321';
		$data['huo'] = '62284';
		$data['light'] = '62766';
		$data['dark'] = '57647';
		$data['luck'] = '94326';
		$response = $this->request('add',$data);
		$model = new GoodsEquipmentModel();
		$model->destroy($response->result->goodsEquipmentId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['goodsCode'] = '测试文本uNBGQY';
		$data['equipmentType'] = '1';
		$data['suitCode'] = '测试文本LzW0YG';
		$data['rarityLevel'] = '76738';
		$data['level'] = '33461';
		$data['hp'] = '68186';
		$data['mp'] = '67046';
		$data['attack'] = '21051';
		$data['defense'] = '73650';
		$data['endurance'] = '30810';
		$data['intellect'] = '56510';
		$data['strength'] = '76546';
		$data['enduranceQualification'] = '94565';
		$data['intellectQualification'] = '96293';
		$data['strengthQualification'] = '72889';
		$data['criticalRate'] = '96966';
		$data['criticalStrikeDamage'] = '79286';
		$data['hitRate'] = '33148';
		$data['penetrate'] = '68886';
		$data['attackSpeed'] = '26843';
		$data['userElement'] = '88196';
		$data['attackElement'] = '35057';
		$data['jin'] = '87711';
		$data['mu'] = '28669';
		$data['tu'] = '97331';
		$data['sui'] = '18148';
		$data['huo'] = '63007';
		$data['light'] = '34793';
		$data['dark'] = '43997';
		$data['luck'] = '14426';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$data = [];
		$data['goodsEquipmentId'] = $model->goodsEquipmentId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->goodsEquipmentId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['goodsCode'] = '测试文本k0mjP1';
		$data['equipmentType'] = '0';
		$data['suitCode'] = '测试文本12Fh9J';
		$data['rarityLevel'] = '39019';
		$data['level'] = '30216';
		$data['hp'] = '63492';
		$data['mp'] = '69820';
		$data['attack'] = '83956';
		$data['defense'] = '88154';
		$data['endurance'] = '36573';
		$data['intellect'] = '71105';
		$data['strength'] = '85947';
		$data['enduranceQualification'] = '27017';
		$data['intellectQualification'] = '58384';
		$data['strengthQualification'] = '50756';
		$data['criticalRate'] = '43458';
		$data['criticalStrikeDamage'] = '90002';
		$data['hitRate'] = '53454';
		$data['penetrate'] = '75245';
		$data['attackSpeed'] = '89446';
		$data['userElement'] = '25992';
		$data['attackElement'] = '76228';
		$data['jin'] = '63290';
		$data['mu'] = '17561';
		$data['tu'] = '10188';
		$data['sui'] = '68840';
		$data['huo'] = '31358';
		$data['light'] = '91681';
		$data['dark'] = '24203';
		$data['luck'] = '96687';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$update = [];
		$update['goodsEquipmentId'] = $model->goodsEquipmentId;
		$update['goodsCode'] = '测试文本VZmEXh';
		$update['equipmentType'] = '0';
		$update['suitCode'] = '测试文本iqcwZD';
		$update['rarityLevel'] = '45875';
		$update['level'] = '83670';
		$update['hp'] = '86329';
		$update['mp'] = '19419';
		$update['attack'] = '63132';
		$update['defense'] = '23028';
		$update['endurance'] = '99275';
		$update['intellect'] = '48955';
		$update['strength'] = '78474';
		$update['enduranceQualification'] = '26134';
		$update['intellectQualification'] = '61750';
		$update['strengthQualification'] = '49394';
		$update['criticalRate'] = '39665';
		$update['criticalStrikeDamage'] = '47312';
		$update['hitRate'] = '50739';
		$update['penetrate'] = '38136';
		$update['attackSpeed'] = '78387';
		$update['userElement'] = '34042';
		$update['attackElement'] = '37351';
		$update['jin'] = '34372';
		$update['mu'] = '62567';
		$update['tu'] = '48983';
		$update['sui'] = '14604';
		$update['huo'] = '83391';
		$update['light'] = '11679';
		$update['dark'] = '35004';
		$update['luck'] = '14176';
		$response = $this->request('update',$update);
		$model->destroy($model->goodsEquipmentId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new GoodsEquipmentModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['goodsCode'] = '测试文本Qub1XW';
		$data['equipmentType'] = '3';
		$data['suitCode'] = '测试文本LAjFJ8';
		$data['rarityLevel'] = '47059';
		$data['level'] = '76093';
		$data['hp'] = '24568';
		$data['mp'] = '83523';
		$data['attack'] = '27044';
		$data['defense'] = '56314';
		$data['endurance'] = '60180';
		$data['intellect'] = '99222';
		$data['strength'] = '50353';
		$data['enduranceQualification'] = '99434';
		$data['intellectQualification'] = '75260';
		$data['strengthQualification'] = '68393';
		$data['criticalRate'] = '59937';
		$data['criticalStrikeDamage'] = '43626';
		$data['hitRate'] = '34492';
		$data['penetrate'] = '16058';
		$data['attackSpeed'] = '56857';
		$data['userElement'] = '74740';
		$data['attackElement'] = '90709';
		$data['jin'] = '81088';
		$data['mu'] = '78554';
		$data['tu'] = '49413';
		$data['sui'] = '20788';
		$data['huo'] = '60052';
		$data['light'] = '59862';
		$data['dark'] = '27863';
		$data['luck'] = '64719';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$delData = [];
		$delData['goodsEquipmentId'] = $model->goodsEquipmentId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

