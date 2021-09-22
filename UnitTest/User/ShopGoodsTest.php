<?php

namespace UnitTest\User;

use App\Model\Game\ShopGoodsModel;

/**
 * ShopGoodsTest
 * Class ShopGoodsTest
 * Create With ClassGeneration
 */
class ShopGoodsTest extends UserBaseTestCase
{
	public $modelName = 'ShopGoods';


	public function testAdd()
	{
		$data = [];
		$data['goodsCode'] = '测试文本SUmIdY';
		$data['goodsName'] = '测试文本v1t0z2';
		$data['limit'] = '94588';
		$data['limitType'] = '21939';
		$data['price'] = '69572';
		$data['stock'] = '28941';
		$data['priceType'] = '3';
		$data['addTime'] = '32018';
		$response = $this->request('add',$data);
		$model = new ShopGoodsModel();
		$model->destroy($response->result->shopGoodsId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['goodsCode'] = '测试文本N6ZSjc';
		$data['goodsName'] = '测试文本XIO52t';
		$data['limit'] = '73815';
		$data['limitType'] = '30420';
		$data['price'] = '43121';
		$data['stock'] = '45193';
		$data['priceType'] = '0';
		$data['addTime'] = '57189';
		$model = new ShopGoodsModel();
		$model->data($data)->save();

		$data = [];
		$data['shopGoodsId'] = $model->shopGoodsId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->shopGoodsId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
	public function testBuy()
	{
		$data = [];
		$data['shopGoodsId'] = 1;
		$data['num'] = 1;
		$response = $this->request('buy',$data);
		var_dump(json_encode($response,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
	}


	public function testUpdate()
	{
		$data = [];
		$data['goodsCode'] = '测试文本Tu7Avq';
		$data['goodsName'] = '测试文本nydNz8';
		$data['limit'] = '28579';
		$data['limitType'] = '69750';
		$data['price'] = '85875';
		$data['stock'] = '73854';
		$data['priceType'] = '0';
		$data['addTime'] = '37666';
		$model = new ShopGoodsModel();
		$model->data($data)->save();

		$update = [];
		$update['shopGoodsId'] = $model->shopGoodsId;
		$update['goodsCode'] = '测试文本IMbzSN';
		$update['goodsName'] = '测试文本fsMqd2';
		$update['limit'] = '49670';
		$update['limitType'] = '51914';
		$update['price'] = '52600';
		$update['stock'] = '63948';
		$update['priceType'] = '1';
		$update['addTime'] = '34301';
		$response = $this->request('update',$update);
		$model->destroy($model->shopGoodsId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new ShopGoodsModel();
		$data = [];
		$response = $this->request('getList',$data);

		var_dump(json_encode($response,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
	}


	public function testDel()
	{
		$data = [];
		$data['goodsCode'] = '测试文本B0hlTi';
		$data['goodsName'] = '测试文本XGUhvg';
		$data['limit'] = '29078';
		$data['limitType'] = '33552';
		$data['price'] = '38100';
		$data['stock'] = '16327';
		$data['priceType'] = '2';
		$data['addTime'] = '90571';
		$model = new ShopGoodsModel();
		$model->data($data)->save();

		$delData = [];
		$delData['shopGoodsId'] = $model->shopGoodsId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

