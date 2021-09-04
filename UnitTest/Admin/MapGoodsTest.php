<?php

namespace UnitTest\Admin;

use MapGoodsModel;

/**
 * MapGoodsTest
 * Class MapGoodsTest
 * Create With ClassGeneration
 */
class MapGoodsTest extends AdminBaseTestCase
{
	public $modelName = 'MapGoods';


	public function testAdd()
	{
		$data = [];
		$data['mapId'] = '91988';
		$data['goodsCode'] = '测试文本yrA5hs';
		$data['goodsType'] = '50783';
		$data['odds'] = '39514';
		$response = $this->request('add',$data);
		$model = new MapGoodsModel();
		$model->destroy($response->result->mapGoodsId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['mapId'] = '56915';
		$data['goodsCode'] = '测试文本ksFpEg';
		$data['goodsType'] = '95857';
		$data['odds'] = '78852';
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
		$data['mapId'] = '50370';
		$data['goodsCode'] = '测试文本5nNYjI';
		$data['goodsType'] = '45214';
		$data['odds'] = '50982';
		$model = new MapGoodsModel();
		$model->data($data)->save();

		$update = [];
		$update['mapGoodsId'] = $model->mapGoodsId;
		$update['mapId'] = '71258';
		$update['goodsCode'] = '测试文本F7EuMs';
		$update['goodsType'] = '60408';
		$update['odds'] = '83059';
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
		$data['mapId'] = '82498';
		$data['goodsCode'] = '测试文本HPXnMs';
		$data['goodsType'] = '68231';
		$data['odds'] = '14696';
		$model = new MapGoodsModel();
		$model->data($data)->save();

		$delData = [];
		$delData['mapGoodsId'] = $model->mapGoodsId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

