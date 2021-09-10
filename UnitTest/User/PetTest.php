<?php

namespace UnitTest\User;

use PetModel;

/**
 * PetTest
 * Class PetTest
 * Create With ClassGeneration
 */
class PetTest extends UserBaseTestCase
{
	public $modelName = 'Pet';


	public function testAdd()
	{
		$data = [];
		$data['name'] = '测试文本3pSEsh';
		$data['type'] = '测试文本INdqzC';
		$data['description'] = '测试文本mCUavI';
		$data['level'] = '29650';
		$data['hp'] = '95172';
		$data['mp'] = '92461';
		$data['attack'] = '28035';
		$data['defense'] = '99712';
		$data['endurance'] = '67017';
		$data['intellect'] = '79581';
		$data['strength'] = '75020';
		$data['enduranceQualification'] = '40243';
		$data['intellectQualification'] = '34437';
		$data['strengthQualification'] = '39263';
		$data['criticalRate'] = '61559';
		$data['criticalStrikeDamage'] = '56941';
		$data['hitRate'] = '75818';
		$data['dodgeRate'] = '13484';
		$data['penetrate'] = '79899';
		$data['attackSpeed'] = '15787';
		$data['userElement'] = '47351';
		$data['attackElement'] = '33093';
		$data['jin'] = '65703';
		$data['mu'] = '36944';
		$data['tu'] = '49803';
		$data['sui'] = '33003';
		$data['huo'] = '34327';
		$data['light'] = '73001';
		$data['dark'] = '49060';
		$response = $this->request('add',$data);
		$model = new PetModel();
		$model->destroy($response->result->petId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = '测试文本7LOgPt';
		$data['type'] = '测试文本H10gLs';
		$data['description'] = '测试文本JpWq0y';
		$data['level'] = '71098';
		$data['hp'] = '41672';
		$data['mp'] = '17585';
		$data['attack'] = '99606';
		$data['defense'] = '74940';
		$data['endurance'] = '64369';
		$data['intellect'] = '14613';
		$data['strength'] = '57860';
		$data['enduranceQualification'] = '46986';
		$data['intellectQualification'] = '41970';
		$data['strengthQualification'] = '30856';
		$data['criticalRate'] = '82165';
		$data['criticalStrikeDamage'] = '37101';
		$data['hitRate'] = '51742';
		$data['dodgeRate'] = '55829';
		$data['penetrate'] = '59244';
		$data['attackSpeed'] = '57704';
		$data['userElement'] = '29457';
		$data['attackElement'] = '82603';
		$data['jin'] = '39871';
		$data['mu'] = '84256';
		$data['tu'] = '40713';
		$data['sui'] = '46289';
		$data['huo'] = '42553';
		$data['light'] = '12729';
		$data['dark'] = '21478';
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
		$data['name'] = '测试文本q0W2TM';
		$data['type'] = '测试文本xYONp8';
		$data['description'] = '测试文本Sylc6V';
		$data['level'] = '11341';
		$data['hp'] = '53441';
		$data['mp'] = '45778';
		$data['attack'] = '38079';
		$data['defense'] = '73399';
		$data['endurance'] = '72119';
		$data['intellect'] = '48648';
		$data['strength'] = '46286';
		$data['enduranceQualification'] = '64528';
		$data['intellectQualification'] = '18045';
		$data['strengthQualification'] = '95278';
		$data['criticalRate'] = '21402';
		$data['criticalStrikeDamage'] = '19190';
		$data['hitRate'] = '24479';
		$data['dodgeRate'] = '14912';
		$data['penetrate'] = '22670';
		$data['attackSpeed'] = '15281';
		$data['userElement'] = '98162';
		$data['attackElement'] = '54908';
		$data['jin'] = '29208';
		$data['mu'] = '48290';
		$data['tu'] = '33195';
		$data['sui'] = '62052';
		$data['huo'] = '75405';
		$data['light'] = '49484';
		$data['dark'] = '63670';
		$model = new PetModel();
		$model->data($data)->save();

		$update = [];
		$update['petId'] = $model->petId;
		$update['name'] = '测试文本YsCrEv';
		$update['type'] = '测试文本AgtMis';
		$update['description'] = '测试文本GeqAf5';
		$update['level'] = '18565';
		$update['hp'] = '33220';
		$update['mp'] = '39178';
		$update['attack'] = '54902';
		$update['defense'] = '86546';
		$update['endurance'] = '38783';
		$update['intellect'] = '49839';
		$update['strength'] = '11683';
		$update['enduranceQualification'] = '21654';
		$update['intellectQualification'] = '62386';
		$update['strengthQualification'] = '61765';
		$update['criticalRate'] = '96587';
		$update['criticalStrikeDamage'] = '57233';
		$update['hitRate'] = '22550';
		$update['dodgeRate'] = '15846';
		$update['penetrate'] = '80274';
		$update['attackSpeed'] = '91785';
		$update['userElement'] = '45924';
		$update['attackElement'] = '22986';
		$update['jin'] = '13610';
		$update['mu'] = '37867';
		$update['tu'] = '54823';
		$update['sui'] = '27085';
		$update['huo'] = '27095';
		$update['light'] = '78699';
		$update['dark'] = '32882';
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
		$data['name'] = '测试文本ShUuJd';
		$data['type'] = '测试文本eUahiA';
		$data['description'] = '测试文本xEJ935';
		$data['level'] = '57874';
		$data['hp'] = '42382';
		$data['mp'] = '20762';
		$data['attack'] = '40536';
		$data['defense'] = '74938';
		$data['endurance'] = '72811';
		$data['intellect'] = '63847';
		$data['strength'] = '29071';
		$data['enduranceQualification'] = '25711';
		$data['intellectQualification'] = '50415';
		$data['strengthQualification'] = '81182';
		$data['criticalRate'] = '74075';
		$data['criticalStrikeDamage'] = '90573';
		$data['hitRate'] = '63899';
		$data['dodgeRate'] = '57103';
		$data['penetrate'] = '20300';
		$data['attackSpeed'] = '41729';
		$data['userElement'] = '16887';
		$data['attackElement'] = '97899';
		$data['jin'] = '35047';
		$data['mu'] = '21416';
		$data['tu'] = '97696';
		$data['sui'] = '46366';
		$data['huo'] = '33963';
		$data['light'] = '43629';
		$data['dark'] = '55421';
		$model = new PetModel();
		$model->data($data)->save();

		$delData = [];
		$delData['petId'] = $model->petId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

