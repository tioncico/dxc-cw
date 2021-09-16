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
		$data['equipmentType'] = '1';
		$data['goodsName'] = '测试文本MTAOit';
		$data['description'] = '测试文本LHpGXJ';
		$data['attributeDescription'] = '测试文本pR3Em5';
		$data['attributeEntryDescription'] = '测试文本ce2udi';
		$data['extraAttributeDescription'] = '测试文本LSGqzK';
		$data['suitAttribute2Description'] = '测试文本NexoUS';
		$data['suitAttribute3Description'] = '测试文本tK2S7f';
		$data['suitAttribute5Description'] = '测试文本IyCtLo';
		$data['suitCode'] = '测试文本W3AqEb';
		$data['strengthenLevel'] = '46752';
		$data['rarityLevel'] = '53323';
		$data['level'] = '24540';
		$data['hp'] = '92849';
		$data['mp'] = '59044';
		$data['attack'] = '38202';
		$data['defense'] = '62453';
		$data['endurance'] = '91065';
		$data['intellect'] = '64926';
		$data['strength'] = '43591';
		$data['criticalRate'] = '41737';
		$data['criticalStrikeDamage'] = '54521';
		$data['hitRate'] = '36648';
		$data['dodgeRate'] = '23828';
		$data['penetrate'] = '83044';
		$data['attackSpeed'] = '57024';
		$data['userElement'] = '80009';
		$data['attackElement'] = '19025';
		$data['jin'] = '63981';
		$data['mu'] = '34597';
		$data['tu'] = '29799';
		$data['sui'] = '60677';
		$data['huo'] = '68400';
		$data['light'] = '37913';
		$data['dark'] = '10992';
		$data['luck'] = '99427';
		$response = $this->request('add',$data);
		$model = new GoodsEquipmentModel();
		$model->destroy($response->result->goodsCode);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['equipmentType'] = '2';
		$data['goodsName'] = '测试文本X2V9c4';
		$data['description'] = '测试文本bDo7T3';
		$data['attributeDescription'] = '测试文本2txSyH';
		$data['attributeEntryDescription'] = '测试文本l6MrGF';
		$data['extraAttributeDescription'] = '测试文本IoHr84';
		$data['suitAttribute2Description'] = '测试文本Z3fwyY';
		$data['suitAttribute3Description'] = '测试文本59QTWA';
		$data['suitAttribute5Description'] = '测试文本pbyDxs';
		$data['suitCode'] = '测试文本d8nAf1';
		$data['strengthenLevel'] = '85933';
		$data['rarityLevel'] = '40760';
		$data['level'] = '72286';
		$data['hp'] = '39832';
		$data['mp'] = '35861';
		$data['attack'] = '34282';
		$data['defense'] = '37398';
		$data['endurance'] = '63981';
		$data['intellect'] = '36586';
		$data['strength'] = '58400';
		$data['criticalRate'] = '55517';
		$data['criticalStrikeDamage'] = '26348';
		$data['hitRate'] = '74830';
		$data['dodgeRate'] = '92362';
		$data['penetrate'] = '87424';
		$data['attackSpeed'] = '46514';
		$data['userElement'] = '73415';
		$data['attackElement'] = '27186';
		$data['jin'] = '50788';
		$data['mu'] = '82255';
		$data['tu'] = '48010';
		$data['sui'] = '31975';
		$data['huo'] = '12252';
		$data['light'] = '83730';
		$data['dark'] = '81128';
		$data['luck'] = '17737';
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
		$data['equipmentType'] = '0';
		$data['goodsName'] = '测试文本yLw0Sa';
		$data['description'] = '测试文本2nTuaN';
		$data['attributeDescription'] = '测试文本5QgJkX';
		$data['attributeEntryDescription'] = '测试文本Omr7Ua';
		$data['extraAttributeDescription'] = '测试文本Dw2mPL';
		$data['suitAttribute2Description'] = '测试文本drim8F';
		$data['suitAttribute3Description'] = '测试文本Q97PrH';
		$data['suitAttribute5Description'] = '测试文本5U8Mtn';
		$data['suitCode'] = '测试文本WGwNf8';
		$data['strengthenLevel'] = '15145';
		$data['rarityLevel'] = '35775';
		$data['level'] = '56070';
		$data['hp'] = '37840';
		$data['mp'] = '24234';
		$data['attack'] = '34381';
		$data['defense'] = '58228';
		$data['endurance'] = '24778';
		$data['intellect'] = '29674';
		$data['strength'] = '93417';
		$data['criticalRate'] = '25580';
		$data['criticalStrikeDamage'] = '56627';
		$data['hitRate'] = '88394';
		$data['dodgeRate'] = '89837';
		$data['penetrate'] = '12968';
		$data['attackSpeed'] = '65665';
		$data['userElement'] = '28201';
		$data['attackElement'] = '28148';
		$data['jin'] = '50687';
		$data['mu'] = '73446';
		$data['tu'] = '50983';
		$data['sui'] = '97687';
		$data['huo'] = '43249';
		$data['light'] = '12639';
		$data['dark'] = '17635';
		$data['luck'] = '87482';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$update = [];
		$update['goodsCode'] = $model->goodsCode;
		$update['equipmentType'] = '1';
		$update['goodsName'] = '测试文本kWUZ47';
		$update['description'] = '测试文本ImFPM8';
		$update['attributeDescription'] = '测试文本IfHrW8';
		$update['attributeEntryDescription'] = '测试文本DMVUpX';
		$update['extraAttributeDescription'] = '测试文本uzSEAv';
		$update['suitAttribute2Description'] = '测试文本OrZ4Vb';
		$update['suitAttribute3Description'] = '测试文本BSyovF';
		$update['suitAttribute5Description'] = '测试文本uePVGq';
		$update['suitCode'] = '测试文本erlxBE';
		$update['strengthenLevel'] = '71698';
		$update['rarityLevel'] = '40782';
		$update['level'] = '63466';
		$update['hp'] = '69841';
		$update['mp'] = '47853';
		$update['attack'] = '21046';
		$update['defense'] = '81254';
		$update['endurance'] = '98180';
		$update['intellect'] = '73047';
		$update['strength'] = '67245';
		$update['criticalRate'] = '52482';
		$update['criticalStrikeDamage'] = '30901';
		$update['hitRate'] = '67339';
		$update['dodgeRate'] = '48682';
		$update['penetrate'] = '11854';
		$update['attackSpeed'] = '38422';
		$update['userElement'] = '47049';
		$update['attackElement'] = '91792';
		$update['jin'] = '75388';
		$update['mu'] = '36047';
		$update['tu'] = '70609';
		$update['sui'] = '24239';
		$update['huo'] = '54027';
		$update['light'] = '23237';
		$update['dark'] = '41687';
		$update['luck'] = '73940';
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
		$data['goodsName'] = '测试文本8V7czs';
		$data['description'] = '测试文本F9rPck';
		$data['attributeDescription'] = '测试文本vl80sU';
		$data['attributeEntryDescription'] = '测试文本c5gHht';
		$data['extraAttributeDescription'] = '测试文本0Ftr5j';
		$data['suitAttribute2Description'] = '测试文本82ylgp';
		$data['suitAttribute3Description'] = '测试文本0u9z6l';
		$data['suitAttribute5Description'] = '测试文本X0hqrR';
		$data['suitCode'] = '测试文本ukTEnl';
		$data['strengthenLevel'] = '43832';
		$data['rarityLevel'] = '54257';
		$data['level'] = '32072';
		$data['hp'] = '33087';
		$data['mp'] = '12420';
		$data['attack'] = '75098';
		$data['defense'] = '53367';
		$data['endurance'] = '35116';
		$data['intellect'] = '75243';
		$data['strength'] = '66279';
		$data['criticalRate'] = '74146';
		$data['criticalStrikeDamage'] = '18650';
		$data['hitRate'] = '28104';
		$data['dodgeRate'] = '26557';
		$data['penetrate'] = '34026';
		$data['attackSpeed'] = '68457';
		$data['userElement'] = '97949';
		$data['attackElement'] = '87936';
		$data['jin'] = '45259';
		$data['mu'] = '44827';
		$data['tu'] = '20354';
		$data['sui'] = '78770';
		$data['huo'] = '29304';
		$data['light'] = '61716';
		$data['dark'] = '32744';
		$data['luck'] = '31124';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$delData = [];
		$delData['goodsCode'] = $model->goodsCode;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

