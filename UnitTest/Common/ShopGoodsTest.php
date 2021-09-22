<?php

namespace UnitTest\Common;

use App\Model\Game\ShopGoodsModel;

/**
 * ShopGoodsTest
 * Class ShopGoodsTest
 * Create With ClassGeneration
 */
class ShopGoodsTest extends CommonBaseTest
{
	public $modelName = '/Api/Common/ShopGoods';


	public function testAdd()
	{
		$data = [];
		$data['goodsCode'] = '测试文本m3GOiW';
		$data['goodsName'] = '测试文本HdAa4j';
		$data['limit'] = '38694';
		$data['limitType'] = '60793';
		$data['price'] = '78409';
		$data['stock'] = '18247';
		$data['priceType'] = '1';
		$data['addTime'] = '70136';
		$response = $this->request('add',$data);
		$model = new ShopGoodsModel();
		$model->destroy($response->result->shopGoodsId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['goodsCode'] = '测试文本h39pbf';
		$data['goodsName'] = '测试文本4mWo6b';
		$data['limit'] = '88714';
		$data['limitType'] = '21418';
		$data['price'] = '28110';
		$data['stock'] = '94216';
		$data['priceType'] = '3';
		$data['addTime'] = '10238';
		$model = new ShopGoodsModel();
		$model->data($data)->save();

		$data = [];
		$data['shopGoodsId'] = $model->shopGoodsId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->shopGoodsId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['goodsCode'] = '测试文本Y5bnl6';
		$data['goodsName'] = '测试文本OARdCy';
		$data['limit'] = '66224';
		$data['limitType'] = '37655';
		$data['price'] = '35269';
		$data['stock'] = '93811';
		$data['priceType'] = '1';
		$data['addTime'] = '16811';
		$model = new ShopGoodsModel();
		$model->data($data)->save();

		$update = [];
		$update['shopGoodsId'] = $model->shopGoodsId;
		$update['goodsCode'] = '测试文本XCpdLv';
		$update['goodsName'] = '测试文本3JHWT1';
		$update['limit'] = '88191';
		$update['limitType'] = '31875';
		$update['price'] = '74553';
		$update['stock'] = '10957';
		$update['priceType'] = '3';
		$update['addTime'] = '52775';
		$response = $this->request('update',$update);
		$model->destroy($model->shopGoodsId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new ShopGoodsModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['goodsCode'] = '测试文本S2dQOW';
		$data['goodsName'] = '测试文本Bhkbg2';
		$data['limit'] = '77987';
		$data['limitType'] = '37641';
		$data['price'] = '67664';
		$data['stock'] = '32135';
		$data['priceType'] = '0';
		$data['addTime'] = '30971';
		$model = new ShopGoodsModel();
		$model->data($data)->save();

		$delData = [];
		$delData['shopGoodsId'] = $model->shopGoodsId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

