<?php

namespace UnitTest\User\Cdk;

use EasySwoole\Utility\Random;
use GameCdkGoodsModel;
use UnitTest\User\UserBaseTestCase;

/**
 * GameCdkGoodsTest
 * Class GameCdkGoodsTest
 * Create With ClassGeneration
 */
class GameCdkGoodsTest extends UserBaseTestCase
{
	public $modelName = 'GameCdkGoods';


	public function testAdd()
	{
		$data = [];
		$data['cdkId'] = mt_rand(10000, 99999);
		$data['goodsCode'] = "测试文本".Random::character(6);
		$data['goodsNum'] = mt_rand(10000, 99999);
		$response = $this->request('add',$data);
		$model = new GameCdkGoodsModel();
		$model->destroy($response->result->cdkGoodsId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['cdkId'] = mt_rand(10000, 99999);
		$data['goodsCode'] = "测试文本".Random::character(6);
		$data['goodsNum'] = mt_rand(10000, 99999);
		$model = new GameCdkGoodsModel();
		$model->data($data)->save();

		$data = [];
		$data['cdkGoodsId'] = $model->cdkGoodsId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->cdkGoodsId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['cdkId'] = mt_rand(10000, 99999);
		$data['goodsCode'] = "测试文本".Random::character(6);
		$data['goodsNum'] = mt_rand(10000, 99999);
		$model = new GameCdkGoodsModel();
		$model->data($data)->save();

		$update = [];
		$update['cdkGoodsId'] = $model->cdkGoodsId;
		$update['cdkId'] = mt_rand(10000, 99999);
		$update['goodsCode'] = "测试文本".Random::character(6);
		$update['goodsNum'] = mt_rand(10000, 99999);
		$response = $this->request('update',$update);
		$model->destroy($model->cdkGoodsId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new GameCdkGoodsModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['cdkId'] = mt_rand(10000, 99999);
		$data['goodsCode'] = "测试文本".Random::character(6);
		$data['goodsNum'] = mt_rand(10000, 99999);
		$model = new GameCdkGoodsModel();
		$model->data($data)->save();

		$delData = [];
		$delData['cdkGoodsId'] = $model->cdkGoodsId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

