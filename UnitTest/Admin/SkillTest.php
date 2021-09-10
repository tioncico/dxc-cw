<?php

namespace UnitTest\Admin;

use SkillModel;

/**
 * SkillTest
 * Class SkillTest
 * Create With ClassGeneration
 */
class SkillTest extends AdminBaseTestCase
{
	public $modelName = 'Skill';


	public function testAdd()
	{
		$data = [];
		$data['name'] = '测试文本5BOJa0';
		$data['level'] = '88697';
		$data['type'] = '3';
		$data['rarityLevel'] = '63251';
		$data['maxLevel'] = '57671';
		$data['coolingTime'] = '35224';
		$data['manaCost'] = '13155';
		$data['entryCode'] = '测试文本x7RgbH';
		$data['description'] = '测试文本yXSpQx';
		$data['param'] = '测试文本Z8RrHk';
		$data['qualification'] = '测试文本YgUeWV';
		$data['manaCostQualification'] = '54666';
		$response = $this->request('add',$data);
		$model = new SkillModel();
		$model->destroy($response->result->skillId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = '测试文本A5Vyh7';
		$data['level'] = '35890';
		$data['type'] = '0';
		$data['rarityLevel'] = '64007';
		$data['maxLevel'] = '48053';
		$data['coolingTime'] = '29580';
		$data['manaCost'] = '47798';
		$data['entryCode'] = '测试文本JhWGEz';
		$data['description'] = '测试文本UrxwXI';
		$data['param'] = '测试文本B1y5KP';
		$data['qualification'] = '测试文本sIyqDV';
		$data['manaCostQualification'] = '48139';
		$model = new SkillModel();
		$model->data($data)->save();

		$data = [];
		$data['skillId'] = $model->skillId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->skillId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['name'] = '测试文本rizXUe';
		$data['level'] = '63198';
		$data['type'] = '0';
		$data['rarityLevel'] = '86075';
		$data['maxLevel'] = '68215';
		$data['coolingTime'] = '74420';
		$data['manaCost'] = '99746';
		$data['entryCode'] = '测试文本2wkIKj';
		$data['description'] = '测试文本8dCRUa';
		$data['param'] = '测试文本6bHRuX';
		$data['qualification'] = '测试文本TMKLIh';
		$data['manaCostQualification'] = '83218';
		$model = new SkillModel();
		$model->data($data)->save();

		$update = [];
		$update['skillId'] = $model->skillId;
		$update['name'] = '测试文本wX90SH';
		$update['level'] = '29130';
		$update['type'] = '2';
		$update['rarityLevel'] = '47057';
		$update['maxLevel'] = '80567';
		$update['coolingTime'] = '88548';
		$update['manaCost'] = '70500';
		$update['entryCode'] = '测试文本25iSFc';
		$update['description'] = '测试文本Mx3cES';
		$update['param'] = '测试文本fZwe1M';
		$update['qualification'] = '测试文本1j6qSK';
		$update['manaCostQualification'] = '77339';
		$response = $this->request('update',$update);
		$model->destroy($model->skillId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new SkillModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['name'] = '测试文本DLiEAx';
		$data['level'] = '39797';
		$data['type'] = '3';
		$data['rarityLevel'] = '83491';
		$data['maxLevel'] = '37319';
		$data['coolingTime'] = '89044';
		$data['manaCost'] = '98826';
		$data['entryCode'] = '测试文本15Z3rk';
		$data['description'] = '测试文本3U8Byn';
		$data['param'] = '测试文本YUotyg';
		$data['qualification'] = '测试文本lHcG4S';
		$data['manaCostQualification'] = '51128';
		$model = new SkillModel();
		$model->data($data)->save();

		$delData = [];
		$delData['skillId'] = $model->skillId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

