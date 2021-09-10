<?php

namespace UnitTest\User;

use GoodsModel;

/**
 * GoodsTest
 * Class GoodsTest
 * Create With ClassGeneration
 */
class GoodsTest extends UserBaseTestCase
{
	public $modelName = 'Goods';


	public function testAdd()
	{
		$data = [];
		$data['name'] = '测试文本BXi6qY';
		$data['code'] = '测试文本vSJ2Dy';
		$data['baseCode'] = '测试文本8th6qQ';
		$data['type'] = '61461';
		$data['description'] = '测试文本K5c6CY';
		$data['gold'] = '27391';
		$data['isSale'] = '26257';
		$data['level'] = '50590';
		$data['rarityLevel'] = '26026';
		$data['extraData'] = '测试文本boCGSx';
		$response = $this->request('add',$data);
		$model = new GoodsModel();
		$model->destroy($response->result->goodsId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = '测试文本8KBAMn';
		$data['code'] = '测试文本jHZpO1';
		$data['baseCode'] = '测试文本YCLmWG';
		$data['type'] = '63799';
		$data['description'] = '测试文本4UcIia';
		$data['gold'] = '87029';
		$data['isSale'] = '54505';
		$data['level'] = '87275';
		$data['rarityLevel'] = '33733';
		$data['extraData'] = '测试文本dB9Tal';
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
		$data['name'] = '测试文本rKOwx6';
		$data['code'] = '测试文本O6Jov3';
		$data['baseCode'] = '测试文本cgYKf6';
		$data['type'] = '98170';
		$data['description'] = '测试文本rUq86L';
		$data['gold'] = '97222';
		$data['isSale'] = '46276';
		$data['level'] = '38799';
		$data['rarityLevel'] = '27056';
		$data['extraData'] = '测试文本htRHbS';
		$model = new GoodsModel();
		$model->data($data)->save();

		$update = [];
		$update['goodsId'] = $model->goodsId;
		$update['name'] = '测试文本oebDWv';
		$update['code'] = '测试文本kaYGif';
		$update['baseCode'] = '测试文本7oG1qQ';
		$update['type'] = '81506';
		$update['description'] = '测试文本SEsPo5';
		$update['gold'] = '78260';
		$update['isSale'] = '72833';
		$update['level'] = '41809';
		$update['rarityLevel'] = '28097';
		$update['extraData'] = '测试文本fB3zl2';
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
		$data['name'] = '测试文本QPyYrG';
		$data['code'] = '测试文本mruIOf';
		$data['baseCode'] = '测试文本0dUlKe';
		$data['type'] = '29833';
		$data['description'] = '测试文本uacRtg';
		$data['gold'] = '99345';
		$data['isSale'] = '96577';
		$data['level'] = '47073';
		$data['rarityLevel'] = '13655';
		$data['extraData'] = '测试文本VBecJo';
		$model = new GoodsModel();
		$model->data($data)->save();

		$delData = [];
		$delData['goodsId'] = $model->goodsId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

