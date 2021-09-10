<?php

namespace UnitTest\Admin;

use UserPetModel;

/**
 * UserPetTest
 * Class UserPetTest
 * Create With ClassGeneration
 */
class UserPetTest extends AdminBaseTestCase
{
	public $modelName = 'UserPet';


	public function testAdd()
	{
		$data = [];
		$data['petId'] = '16093';
		$data['name'] = '测试文本ZmYvuk';
		$data['type'] = '测试文本LxwJrN';
		$data['description'] = '测试文本TwolQm';
		$data['level'] = '79373';
		$data['exp'] = '84190';
		$data['isBest'] = '0';
		$data['hp'] = '38010';
		$data['mp'] = '27223';
		$data['attack'] = '89522';
		$data['defense'] = '60832';
		$data['endurance'] = '74263';
		$data['intellect'] = '38481';
		$data['strength'] = '36659';
		$data['enduranceQualification'] = '53205';
		$data['intellectQualification'] = '48582';
		$data['strengthQualification'] = '15422';
		$data['criticalRate'] = '63719';
		$data['criticalStrikeDamage'] = '75116';
		$data['hitRate'] = '11214';
		$data['dodgeRate'] = '41061';
		$data['penetrate'] = '92934';
		$data['attackSpeed'] = '69916';
		$data['userElement'] = '62227';
		$data['attackElement'] = '39631';
		$data['jin'] = '99646';
		$data['mu'] = '74805';
		$data['tu'] = '66272';
		$data['sui'] = '45523';
		$data['huo'] = '74332';
		$data['light'] = '80885';
		$data['dark'] = '23442';
		$response = $this->request('add',$data);
		$model = new UserPetModel();
		$model->destroy($response->result->userPetId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['petId'] = '31849';
		$data['name'] = '测试文本82VDFU';
		$data['type'] = '测试文本80CMB2';
		$data['description'] = '测试文本SOjn56';
		$data['level'] = '90292';
		$data['exp'] = '58590';
		$data['isBest'] = '2';
		$data['hp'] = '20145';
		$data['mp'] = '17266';
		$data['attack'] = '81171';
		$data['defense'] = '77621';
		$data['endurance'] = '64320';
		$data['intellect'] = '93456';
		$data['strength'] = '32671';
		$data['enduranceQualification'] = '99997';
		$data['intellectQualification'] = '48929';
		$data['strengthQualification'] = '33124';
		$data['criticalRate'] = '37249';
		$data['criticalStrikeDamage'] = '56166';
		$data['hitRate'] = '23082';
		$data['dodgeRate'] = '80659';
		$data['penetrate'] = '78194';
		$data['attackSpeed'] = '36049';
		$data['userElement'] = '81002';
		$data['attackElement'] = '68007';
		$data['jin'] = '88417';
		$data['mu'] = '20713';
		$data['tu'] = '58550';
		$data['sui'] = '22349';
		$data['huo'] = '76149';
		$data['light'] = '46826';
		$data['dark'] = '46125';
		$model = new UserPetModel();
		$model->data($data)->save();

		$data = [];
		$data['userPetId'] = $model->userPetId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->userPetId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['petId'] = '74061';
		$data['name'] = '测试文本5CQbV1';
		$data['type'] = '测试文本7RDk4B';
		$data['description'] = '测试文本SzItNB';
		$data['level'] = '27470';
		$data['exp'] = '41209';
		$data['isBest'] = '2';
		$data['hp'] = '88877';
		$data['mp'] = '36758';
		$data['attack'] = '26893';
		$data['defense'] = '31518';
		$data['endurance'] = '47511';
		$data['intellect'] = '57968';
		$data['strength'] = '61997';
		$data['enduranceQualification'] = '71554';
		$data['intellectQualification'] = '93732';
		$data['strengthQualification'] = '63448';
		$data['criticalRate'] = '42083';
		$data['criticalStrikeDamage'] = '47886';
		$data['hitRate'] = '17320';
		$data['dodgeRate'] = '28577';
		$data['penetrate'] = '58729';
		$data['attackSpeed'] = '18309';
		$data['userElement'] = '60133';
		$data['attackElement'] = '67931';
		$data['jin'] = '73986';
		$data['mu'] = '27054';
		$data['tu'] = '77505';
		$data['sui'] = '18685';
		$data['huo'] = '30927';
		$data['light'] = '20799';
		$data['dark'] = '17393';
		$model = new UserPetModel();
		$model->data($data)->save();

		$update = [];
		$update['userPetId'] = $model->userPetId;
		$update['petId'] = '22798';
		$update['name'] = '测试文本0GIWMD';
		$update['type'] = '测试文本njfIrN';
		$update['description'] = '测试文本PBWhj5';
		$update['level'] = '34563';
		$update['exp'] = '42588';
		$update['isBest'] = '1';
		$update['hp'] = '19333';
		$update['mp'] = '33119';
		$update['attack'] = '24529';
		$update['defense'] = '39801';
		$update['endurance'] = '78496';
		$update['intellect'] = '98045';
		$update['strength'] = '58361';
		$update['enduranceQualification'] = '35987';
		$update['intellectQualification'] = '57343';
		$update['strengthQualification'] = '42905';
		$update['criticalRate'] = '60545';
		$update['criticalStrikeDamage'] = '81015';
		$update['hitRate'] = '88533';
		$update['dodgeRate'] = '27989';
		$update['penetrate'] = '85855';
		$update['attackSpeed'] = '11115';
		$update['userElement'] = '35799';
		$update['attackElement'] = '11380';
		$update['jin'] = '28762';
		$update['mu'] = '67463';
		$update['tu'] = '31573';
		$update['sui'] = '50450';
		$update['huo'] = '73696';
		$update['light'] = '41381';
		$update['dark'] = '68275';
		$response = $this->request('update',$update);
		$model->destroy($model->userPetId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new UserPetModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['petId'] = '10060';
		$data['name'] = '测试文本fXuUix';
		$data['type'] = '测试文本LGTZnE';
		$data['description'] = '测试文本IxFTQk';
		$data['level'] = '74503';
		$data['exp'] = '54218';
		$data['isBest'] = '0';
		$data['hp'] = '49280';
		$data['mp'] = '98259';
		$data['attack'] = '14964';
		$data['defense'] = '83992';
		$data['endurance'] = '61387';
		$data['intellect'] = '14476';
		$data['strength'] = '56094';
		$data['enduranceQualification'] = '71190';
		$data['intellectQualification'] = '15244';
		$data['strengthQualification'] = '23895';
		$data['criticalRate'] = '11904';
		$data['criticalStrikeDamage'] = '64659';
		$data['hitRate'] = '76208';
		$data['dodgeRate'] = '39847';
		$data['penetrate'] = '18612';
		$data['attackSpeed'] = '13243';
		$data['userElement'] = '24792';
		$data['attackElement'] = '37393';
		$data['jin'] = '16399';
		$data['mu'] = '38055';
		$data['tu'] = '77033';
		$data['sui'] = '18575';
		$data['huo'] = '46427';
		$data['light'] = '42303';
		$data['dark'] = '24329';
		$model = new UserPetModel();
		$model->data($data)->save();

		$delData = [];
		$delData['userPetId'] = $model->userPetId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

