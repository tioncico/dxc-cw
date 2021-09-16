<?php

namespace UnitTest\User;

use GoodsEquipmentModel;

/**
 * GoodsEquipmentTest
 * Class GoodsEquipmentTest
 * Create With ClassGeneration
 */
class GoodsEquipmentTest extends UserBaseTestCase
{
	public $modelName = 'GoodsEquipment';


	public function testAdd()
	{
		$data = [];
		$data['equipmentType'] = '3';
		$data['goodsName'] = '测试文本cjFa7O';
		$data['description'] = '测试文本J6LKmI';
		$data['attributeDescription'] = '测试文本g1mDZA';
		$data['attributeEntryDescription'] = '测试文本tGTqRk';
		$data['extraAttributeDescription'] = '测试文本m5hsYf';
		$data['suitAttribute2Description'] = '测试文本EhC9Il';
		$data['suitAttribute3Description'] = '测试文本vZhHES';
		$data['suitAttribute5Description'] = '测试文本2k8xB7';
		$data['suitCode'] = '测试文本pt6Yna';
		$data['strengthenLevel'] = '67185';
		$data['rarityLevel'] = '31912';
		$data['level'] = '26492';
		$data['hp'] = '24981';
		$data['mp'] = '19812';
		$data['attack'] = '99533';
		$data['defense'] = '32642';
		$data['endurance'] = '38073';
		$data['intellect'] = '70264';
		$data['strength'] = '23743';
		$data['criticalRate'] = '37357';
		$data['criticalStrikeDamage'] = '41825';
		$data['hitRate'] = '34374';
		$data['dodgeRate'] = '43370';
		$data['penetrate'] = '49379';
		$data['attackSpeed'] = '47332';
		$data['userElement'] = '62176';
		$data['attackElement'] = '20834';
		$data['jin'] = '59449';
		$data['mu'] = '52350';
		$data['tu'] = '98231';
		$data['sui'] = '54798';
		$data['huo'] = '35336';
		$data['light'] = '52511';
		$data['dark'] = '69056';
		$data['luck'] = '33912';
		$response = $this->request('add',$data);
		$model = new GoodsEquipmentModel();
		$model->destroy($response->result->goodsCode);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['equipmentType'] = '0';
		$data['goodsName'] = '测试文本LRKXq7';
		$data['description'] = '测试文本M6ICdX';
		$data['attributeDescription'] = '测试文本BMcmXn';
		$data['attributeEntryDescription'] = '测试文本NkfECo';
		$data['extraAttributeDescription'] = '测试文本QIow0n';
		$data['suitAttribute2Description'] = '测试文本gtp3Kh';
		$data['suitAttribute3Description'] = '测试文本ScrHI6';
		$data['suitAttribute5Description'] = '测试文本Scke1X';
		$data['suitCode'] = '测试文本xODNW4';
		$data['strengthenLevel'] = '40075';
		$data['rarityLevel'] = '57344';
		$data['level'] = '97413';
		$data['hp'] = '99702';
		$data['mp'] = '52767';
		$data['attack'] = '75957';
		$data['defense'] = '12919';
		$data['endurance'] = '62704';
		$data['intellect'] = '37752';
		$data['strength'] = '35398';
		$data['criticalRate'] = '38820';
		$data['criticalStrikeDamage'] = '87592';
		$data['hitRate'] = '13484';
		$data['dodgeRate'] = '37335';
		$data['penetrate'] = '71406';
		$data['attackSpeed'] = '30186';
		$data['userElement'] = '55073';
		$data['attackElement'] = '68983';
		$data['jin'] = '34159';
		$data['mu'] = '92308';
		$data['tu'] = '60297';
		$data['sui'] = '37327';
		$data['huo'] = '64149';
		$data['light'] = '45189';
		$data['dark'] = '44447';
		$data['luck'] = '42745';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$data = [];
		$data['goodsCode'] = $model->goodsCode;
		$response = $this->request('getOne',$data);
		$model->destroy($model->goodsCode);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['equipmentType'] = '2';
		$data['goodsName'] = '测试文本ade5fY';
		$data['description'] = '测试文本5T4yhM';
		$data['attributeDescription'] = '测试文本4ncE7S';
		$data['attributeEntryDescription'] = '测试文本Mamlyk';
		$data['extraAttributeDescription'] = '测试文本I4OtGx';
		$data['suitAttribute2Description'] = '测试文本cuk3j4';
		$data['suitAttribute3Description'] = '测试文本bNMV8W';
		$data['suitAttribute5Description'] = '测试文本d2VFaR';
		$data['suitCode'] = '测试文本5zqacV';
		$data['strengthenLevel'] = '63488';
		$data['rarityLevel'] = '95064';
		$data['level'] = '89054';
		$data['hp'] = '71684';
		$data['mp'] = '91953';
		$data['attack'] = '18850';
		$data['defense'] = '20634';
		$data['endurance'] = '37208';
		$data['intellect'] = '36222';
		$data['strength'] = '36662';
		$data['criticalRate'] = '41499';
		$data['criticalStrikeDamage'] = '21681';
		$data['hitRate'] = '98811';
		$data['dodgeRate'] = '45197';
		$data['penetrate'] = '93457';
		$data['attackSpeed'] = '26777';
		$data['userElement'] = '40096';
		$data['attackElement'] = '92071';
		$data['jin'] = '16662';
		$data['mu'] = '86492';
		$data['tu'] = '95347';
		$data['sui'] = '89804';
		$data['huo'] = '10810';
		$data['light'] = '10605';
		$data['dark'] = '60917';
		$data['luck'] = '27914';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$update = [];
		$update['goodsCode'] = $model->goodsCode;
		$update['equipmentType'] = '3';
		$update['goodsName'] = '测试文本nUdSxE';
		$update['description'] = '测试文本rQi1SR';
		$update['attributeDescription'] = '测试文本cneIbx';
		$update['attributeEntryDescription'] = '测试文本Sqs3VA';
		$update['extraAttributeDescription'] = '测试文本XKCT81';
		$update['suitAttribute2Description'] = '测试文本Ozp029';
		$update['suitAttribute3Description'] = '测试文本L2hFV5';
		$update['suitAttribute5Description'] = '测试文本UDpifw';
		$update['suitCode'] = '测试文本LFaPnj';
		$update['strengthenLevel'] = '54510';
		$update['rarityLevel'] = '27793';
		$update['level'] = '76229';
		$update['hp'] = '46535';
		$update['mp'] = '77160';
		$update['attack'] = '71918';
		$update['defense'] = '57472';
		$update['endurance'] = '11430';
		$update['intellect'] = '17788';
		$update['strength'] = '11080';
		$update['criticalRate'] = '85582';
		$update['criticalStrikeDamage'] = '35117';
		$update['hitRate'] = '10197';
		$update['dodgeRate'] = '40259';
		$update['penetrate'] = '98117';
		$update['attackSpeed'] = '72122';
		$update['userElement'] = '83749';
		$update['attackElement'] = '24994';
		$update['jin'] = '28819';
		$update['mu'] = '75531';
		$update['tu'] = '81026';
		$update['sui'] = '12399';
		$update['huo'] = '25537';
		$update['light'] = '30857';
		$update['dark'] = '94440';
		$update['luck'] = '35550';
		$response = $this->request('update',$update);
		$model->destroy($model->goodsCode);
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
		$data['equipmentType'] = '0';
		$data['goodsName'] = '测试文本5I9kcl';
		$data['description'] = '测试文本0SrvCH';
		$data['attributeDescription'] = '测试文本N67S9E';
		$data['attributeEntryDescription'] = '测试文本t13qMK';
		$data['extraAttributeDescription'] = '测试文本NpYhkJ';
		$data['suitAttribute2Description'] = '测试文本fNTylZ';
		$data['suitAttribute3Description'] = '测试文本TiV8mX';
		$data['suitAttribute5Description'] = '测试文本EqTZ1J';
		$data['suitCode'] = '测试文本o2Ma1S';
		$data['strengthenLevel'] = '32420';
		$data['rarityLevel'] = '87023';
		$data['level'] = '33705';
		$data['hp'] = '68301';
		$data['mp'] = '13227';
		$data['attack'] = '88109';
		$data['defense'] = '34062';
		$data['endurance'] = '67867';
		$data['intellect'] = '58000';
		$data['strength'] = '42351';
		$data['criticalRate'] = '63833';
		$data['criticalStrikeDamage'] = '79603';
		$data['hitRate'] = '22556';
		$data['dodgeRate'] = '25954';
		$data['penetrate'] = '77427';
		$data['attackSpeed'] = '63379';
		$data['userElement'] = '64925';
		$data['attackElement'] = '21913';
		$data['jin'] = '93835';
		$data['mu'] = '73454';
		$data['tu'] = '65686';
		$data['sui'] = '94273';
		$data['huo'] = '83170';
		$data['light'] = '23688';
		$data['dark'] = '30868';
		$data['luck'] = '59525';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$delData = [];
		$delData['goodsCode'] = $model->goodsCode;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

