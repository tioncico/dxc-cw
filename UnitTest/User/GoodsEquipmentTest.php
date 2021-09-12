<?php

namespace UnitTest\User;

use App\Model\GoodsEquipmentModel;

/**
 * GoodsEquipmentTest
 * Class GoodsEquipmentTest
 * Create With ClassGeneration
 */
class GoodsEquipmentTest extends UserBaseTestCase
{
	public $modelName = '/Api/User/GoodsEquipment';


	public function testAdd()
	{
		$data = [];
		$data['goodsCode'] = '测试文本0mjGHP';
		$data['equipmentType'] = '1';
		$data['suitCode'] = '测试文本3gQlfi';
		$data['strengthenLevel'] = '28598';
		$data['rarityLevel'] = '24744';
		$data['level'] = '67947';
		$data['hp'] = '26596';
		$data['mp'] = '24393';
		$data['attack'] = '49478';
		$data['defense'] = '53902';
		$data['endurance'] = '42571';
		$data['intellect'] = '20059';
		$data['strength'] = '89134';
		$data['enduranceQualification'] = '70901';
		$data['intellectQualification'] = '82460';
		$data['strengthQualification'] = '13404';
		$data['criticalRate'] = '92414';
		$data['criticalStrikeDamage'] = '78109';
		$data['hitRate'] = '62547';
		$data['dodgeRate'] = '86441';
		$data['penetrate'] = '63699';
		$data['attackSpeed'] = '14957';
		$data['userElement'] = '13120';
		$data['attackElement'] = '36963';
		$data['jin'] = '77384';
		$data['mu'] = '84270';
		$data['tu'] = '57607';
		$data['sui'] = '74570';
		$data['huo'] = '12780';
		$data['light'] = '39551';
		$data['dark'] = '30737';
		$data['luck'] = '97119';
		$response = $this->request('add',$data);
		$model = new GoodsEquipmentModel();
		$model->destroy($response->result->goodsEquipmentId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['goodsCode'] = '测试文本wvbjgW';
		$data['equipmentType'] = '2';
		$data['suitCode'] = '测试文本wlNTxs';
		$data['strengthenLevel'] = '35271';
		$data['rarityLevel'] = '68274';
		$data['level'] = '82626';
		$data['hp'] = '41352';
		$data['mp'] = '97802';
		$data['attack'] = '28100';
		$data['defense'] = '54411';
		$data['endurance'] = '98995';
		$data['intellect'] = '89092';
		$data['strength'] = '78680';
		$data['enduranceQualification'] = '86510';
		$data['intellectQualification'] = '34143';
		$data['strengthQualification'] = '38598';
		$data['criticalRate'] = '44128';
		$data['criticalStrikeDamage'] = '53960';
		$data['hitRate'] = '75804';
		$data['dodgeRate'] = '40707';
		$data['penetrate'] = '66103';
		$data['attackSpeed'] = '32343';
		$data['userElement'] = '91082';
		$data['attackElement'] = '90561';
		$data['jin'] = '69157';
		$data['mu'] = '24199';
		$data['tu'] = '81838';
		$data['sui'] = '45571';
		$data['huo'] = '29143';
		$data['light'] = '51881';
		$data['dark'] = '45138';
		$data['luck'] = '26164';
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
		$data['goodsCode'] = '测试文本k2MNVl';
		$data['equipmentType'] = '3';
		$data['suitCode'] = '测试文本yjcfPX';
		$data['strengthenLevel'] = '86773';
		$data['rarityLevel'] = '92005';
		$data['level'] = '93445';
		$data['hp'] = '46592';
		$data['mp'] = '41542';
		$data['attack'] = '17183';
		$data['defense'] = '56935';
		$data['endurance'] = '57800';
		$data['intellect'] = '12457';
		$data['strength'] = '90094';
		$data['enduranceQualification'] = '46502';
		$data['intellectQualification'] = '51339';
		$data['strengthQualification'] = '15821';
		$data['criticalRate'] = '47662';
		$data['criticalStrikeDamage'] = '30476';
		$data['hitRate'] = '27538';
		$data['dodgeRate'] = '68533';
		$data['penetrate'] = '62419';
		$data['attackSpeed'] = '67392';
		$data['userElement'] = '59689';
		$data['attackElement'] = '88484';
		$data['jin'] = '69464';
		$data['mu'] = '17577';
		$data['tu'] = '47726';
		$data['sui'] = '30885';
		$data['huo'] = '95279';
		$data['light'] = '72789';
		$data['dark'] = '88513';
		$data['luck'] = '14097';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$update = [];
		$update['goodsEquipmentId'] = $model->goodsEquipmentId;
		$update['goodsCode'] = '测试文本eVX3oa';
		$update['equipmentType'] = '3';
		$update['suitCode'] = '测试文本vxsGpr';
		$update['strengthenLevel'] = '94152';
		$update['rarityLevel'] = '70016';
		$update['level'] = '14427';
		$update['hp'] = '39143';
		$update['mp'] = '92356';
		$update['attack'] = '98342';
		$update['defense'] = '95832';
		$update['endurance'] = '68376';
		$update['intellect'] = '41330';
		$update['strength'] = '45524';
		$update['enduranceQualification'] = '69731';
		$update['intellectQualification'] = '91466';
		$update['strengthQualification'] = '18889';
		$update['criticalRate'] = '79559';
		$update['criticalStrikeDamage'] = '11512';
		$update['hitRate'] = '13458';
		$update['dodgeRate'] = '78854';
		$update['penetrate'] = '16352';
		$update['attackSpeed'] = '46103';
		$update['userElement'] = '23416';
		$update['attackElement'] = '44387';
		$update['jin'] = '54746';
		$update['mu'] = '17123';
		$update['tu'] = '43776';
		$update['sui'] = '36492';
		$update['huo'] = '66942';
		$update['light'] = '41563';
		$update['dark'] = '18034';
		$update['luck'] = '47525';
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
		$data['goodsCode'] = '测试文本e7YfyG';
		$data['equipmentType'] = '0';
		$data['suitCode'] = '测试文本q1BvaS';
		$data['strengthenLevel'] = '64497';
		$data['rarityLevel'] = '48604';
		$data['level'] = '62752';
		$data['hp'] = '35395';
		$data['mp'] = '33715';
		$data['attack'] = '60405';
		$data['defense'] = '54085';
		$data['endurance'] = '23507';
		$data['intellect'] = '94350';
		$data['strength'] = '73315';
		$data['enduranceQualification'] = '43822';
		$data['intellectQualification'] = '61610';
		$data['strengthQualification'] = '48004';
		$data['criticalRate'] = '67337';
		$data['criticalStrikeDamage'] = '20719';
		$data['hitRate'] = '93438';
		$data['dodgeRate'] = '60930';
		$data['penetrate'] = '76271';
		$data['attackSpeed'] = '21214';
		$data['userElement'] = '54200';
		$data['attackElement'] = '73536';
		$data['jin'] = '12132';
		$data['mu'] = '84281';
		$data['tu'] = '22875';
		$data['sui'] = '68373';
		$data['huo'] = '36131';
		$data['light'] = '40834';
		$data['dark'] = '67477';
		$data['luck'] = '24252';
		$model = new GoodsEquipmentModel();
		$model->data($data)->save();

		$delData = [];
		$delData['goodsEquipmentId'] = $model->goodsEquipmentId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

