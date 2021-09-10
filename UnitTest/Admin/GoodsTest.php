<?php

namespace UnitTest\Admin;

use GoodsModel;

/**
 * GoodsTest
 * Class GoodsTest
 * Create With ClassGeneration
 */
class GoodsTest extends AdminBaseTestCase
{
	public $modelName = 'Goods';


	public function testAdd()
	{
		$data = [];
		$data['name'] = '测试文本jtpJNs';
		$data['code'] = '测试文本12Tr8b';
		$data['baseCode'] = '测试文本r1PbzH';
		$data['type'] = '48840';
		$data['description'] = '测试文本vVUc0f';
		$data['gold'] = '69165';
		$data['isSale'] = '95775';
		$data['level'] = '81669';
		$data['rarityLevel'] = '48975';
		$data['extraData'] = '测试文本O6N3Q1';
		$response = $this->request('add',$data);
		$model = new GoodsModel();
		$model->destroy($response->result->goodsId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = '测试文本2KJQUn';
		$data['code'] = '测试文本mZS7tK';
		$data['baseCode'] = '测试文本oCb2zL';
		$data['type'] = '37082';
		$data['description'] = '测试文本Ertwdj';
		$data['gold'] = '75377';
		$data['isSale'] = '26581';
		$data['level'] = '51480';
		$data['rarityLevel'] = '60645';
		$data['extraData'] = '测试文本jUQZTn';
		$model = new GoodsModel();
		$model->data($data)->save();

		$data = [];
		$data['goodsId'] = $model->goodsId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->goodsId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['name'] = '测试文本JCb8Zm';
		$data['code'] = '测试文本8cuBGx';
		$data['baseCode'] = '测试文本nFrVqo';
		$data['type'] = '25454';
		$data['description'] = '测试文本mocqAf';
		$data['gold'] = '21739';
		$data['isSale'] = '50848';
		$data['level'] = '43263';
		$data['rarityLevel'] = '43646';
		$data['extraData'] = '测试文本sDBnP5';
		$model = new GoodsModel();
		$model->data($data)->save();

		$update = [];
		$update['goodsId'] = $model->goodsId;
		$update['name'] = '测试文本0b4qms';
		$update['code'] = '测试文本9TtZHn';
		$update['baseCode'] = '测试文本H8ATOo';
		$update['type'] = '64415';
		$update['description'] = '测试文本2yrtpV';
		$update['gold'] = '86089';
		$update['isSale'] = '47555';
		$update['level'] = '46196';
		$update['rarityLevel'] = '94735';
		$update['extraData'] = '测试文本mf6TCY';
		$response = $this->request('update',$update);
		$model->destroy($model->goodsId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new GoodsModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['name'] = '测试文本FAyh6z';
		$data['code'] = '测试文本mwT7Mt';
		$data['baseCode'] = '测试文本ZsCcXY';
		$data['type'] = '75448';
		$data['description'] = '测试文本F3pKmX';
		$data['gold'] = '53004';
		$data['isSale'] = '54717';
		$data['level'] = '37078';
		$data['rarityLevel'] = '63353';
		$data['extraData'] = '测试文本TSxc4Q';
		$model = new GoodsModel();
		$model->data($data)->save();

		$delData = [];
		$delData['goodsId'] = $model->goodsId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

