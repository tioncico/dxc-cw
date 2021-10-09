<?php

namespace UnitTest\User;

use EasySwoole\Utility\Random;
use SkillLevelUpNeedGoodsModel;

/**
 * SkillLevelUpNeedGoodsTest
 * Class SkillLevelUpNeedGoodsTest
 * Create With ClassGeneration
 */
class SkillLevelUpNeedGoodsTest extends UserBaseTestCase
{
	public $modelName = 'SkillLevelUpNeedGoods';


	public function testAdd()
	{
		$data = [];
		$data['skillId'] = mt_rand(10000, 99999);
		$data['level'] = mt_rand(10000, 99999);
		$data['goodsCode'] = "测试文本".Random::character(6);
		$data['goodsNum'] = mt_rand(10000, 99999);
		$response = $this->request('add',$data);
		$model = new SkillLevelUpNeedGoodsModel();
		$model->destroy($response->result->id);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['skillId'] = mt_rand(10000, 99999);
		$data['level'] = mt_rand(10000, 99999);
		$data['goodsCode'] = "测试文本".Random::character(6);
		$data['goodsNum'] = mt_rand(10000, 99999);
		$model = new SkillLevelUpNeedGoodsModel();
		$model->data($data)->save();

		$data = [];
		$data['id'] = $model->id;
		$response = $this->request('getOne',$data);
		$model->destroy($model->id);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['skillId'] = mt_rand(10000, 99999);
		$data['level'] = mt_rand(10000, 99999);
		$data['goodsCode'] = "测试文本".Random::character(6);
		$data['goodsNum'] = mt_rand(10000, 99999);
		$model = new SkillLevelUpNeedGoodsModel();
		$model->data($data)->save();

		$update = [];
		$update['id'] = $model->id;
		$update['skillId'] = mt_rand(10000, 99999);
		$update['level'] = mt_rand(10000, 99999);
		$update['goodsCode'] = "测试文本".Random::character(6);
		$update['goodsNum'] = mt_rand(10000, 99999);
		$response = $this->request('update',$update);
		$model->destroy($model->id);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new SkillLevelUpNeedGoodsModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['skillId'] = mt_rand(10000, 99999);
		$data['level'] = mt_rand(10000, 99999);
		$data['goodsCode'] = "测试文本".Random::character(6);
		$data['goodsNum'] = mt_rand(10000, 99999);
		$model = new SkillLevelUpNeedGoodsModel();
		$model->data($data)->save();

		$delData = [];
		$delData['id'] = $model->id;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

