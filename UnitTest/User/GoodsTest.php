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
		$data['name'] = '测试文本jtgZ4J';
		$data['code'] = '测试文本0McN57';
		$data['type'] = '15409';
		$data['description'] = '测试文本xY8seN';
		$data['gold'] = '95298';
		$data['isSale'] = '28060';
		$data['level'] = '23123';
		$data['rarityLevel'] = '63246';
		$data['extraData'] = '测试文本RBQpwe';
		$response = $this->request('add',$data);
		$model = new GoodsModel();
		$model->destroy($response->result->goodsId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = '测试文本7i1rPA';
		$data['code'] = '测试文本ajOwPX';
		$data['type'] = '18773';
		$data['description'] = '测试文本dIMmv9';
		$data['gold'] = '23683';
		$data['isSale'] = '88040';
		$data['level'] = '80730';
		$data['rarityLevel'] = '78151';
		$data['extraData'] = '测试文本qN9ASV';
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
		$data['name'] = '测试文本UcEZJi';
		$data['code'] = '测试文本fbwSJD';
		$data['type'] = '50568';
		$data['description'] = '测试文本KHIb34';
		$data['gold'] = '12672';
		$data['isSale'] = '17011';
		$data['level'] = '96763';
		$data['rarityLevel'] = '52838';
		$data['extraData'] = '测试文本5aL2pk';
		$model = new GoodsModel();
		$model->data($data)->save();

		$update = [];
		$update['goodsId'] = $model->goodsId;
		$update['name'] = '测试文本VE1dbK';
		$update['code'] = '测试文本yCOSJP';
		$update['type'] = '31178';
		$update['description'] = '测试文本zgcx7B';
		$update['gold'] = '23391';
		$update['isSale'] = '22359';
		$update['level'] = '64297';
		$update['rarityLevel'] = '15546';
		$update['extraData'] = '测试文本LGFd5R';
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
		$data['name'] = '测试文本IoPZh7';
		$data['code'] = '测试文本hlQKGm';
		$data['type'] = '29338';
		$data['description'] = '测试文本7LtAO8';
		$data['gold'] = '88939';
		$data['isSale'] = '29916';
		$data['level'] = '74575';
		$data['rarityLevel'] = '33119';
		$data['extraData'] = '测试文本R7pzgP';
		$model = new GoodsModel();
		$model->data($data)->save();

		$delData = [];
		$delData['goodsId'] = $model->goodsId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

