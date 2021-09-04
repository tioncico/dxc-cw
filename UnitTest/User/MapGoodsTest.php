<?php

namespace UnitTest\User;

use MapGoodsModel;

/**
 * MapGoodsTest
 * Class MapGoodsTest
 * Create With ClassGeneration
 */
class MapGoodsTest extends UserBaseTestCase
{
	public $modelName = 'MapGoods';


	public function testAdd()
	{
		$data = [];
		$data['mapId'] = '81246';
		$data['goodsCode'] = '测试文本W28PBu';
		$data['goodsType'] = '90694';
		$data['odds'] = '51380';
		$response = $this->request('add',$data);
		$model = new MapGoodsModel();
		$model->destroy($response->result->mapGoodsId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['mapId'] = '23308';
		$data['goodsCode'] = '测试文本Ega38x';
		$data['goodsType'] = '69970';
		$data['odds'] = '83889';
		$model = new MapGoodsModel();
		$model->data($data)->save();

		$data = [];
		$data['mapGoodsId'] = $model->mapGoodsId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->mapGoodsId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['mapId'] = '24864';
		$data['goodsCode'] = '测试文本5WQMzD';
		$data['goodsType'] = '22698';
		$data['odds'] = '86721';
		$model = new MapGoodsModel();
		$model->data($data)->save();

		$update = [];
		$update['mapGoodsId'] = $model->mapGoodsId;
		$update['mapId'] = '51991';
		$update['goodsCode'] = '测试文本kMB2X1';
		$update['goodsType'] = '48566';
		$update['odds'] = '49551';
		$response = $this->request('update',$update);
		$model->destroy($model->mapGoodsId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new MapGoodsModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['mapId'] = '94899';
		$data['goodsCode'] = '测试文本UWdBgo';
		$data['goodsType'] = '51773';
		$data['odds'] = '32264';
		$model = new MapGoodsModel();
		$model->data($data)->save();

		$delData = [];
		$delData['mapGoodsId'] = $model->mapGoodsId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

