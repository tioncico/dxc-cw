<?php

namespace UnitTest\Admin;

use App\Model\Game\ShopGoodsModel;

/**
 * ShopGoodsTest
 * Class ShopGoodsTest
 * Create With ClassGeneration
 */
class ShopGoodsTest extends AdminBaseTestCase
{
	public $modelName = '/Api/Admin/ShopGoods';


	public function testAdd()
	{
		$data = [];
		$data['goodsCode'] = '测试文本JMPGqi';
		$data['goodsName'] = '测试文本6ITswJ';
		$data['limit'] = '80705';
		$data['limitType'] = '95332';
		$data['price'] = '14859';
		$data['stock'] = '42070';
		$data['priceType'] = '0';
		$data['addTime'] = '57673';
		$response = $this->request('add',$data);
		$model = new ShopGoodsModel();
		$model->destroy($response->result->shopGoodsId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['goodsCode'] = '测试文本J3wP0B';
		$data['goodsName'] = '测试文本73VIKM';
		$data['limit'] = '81557';
		$data['limitType'] = '93923';
		$data['price'] = '36493';
		$data['stock'] = '92822';
		$data['priceType'] = '2';
		$data['addTime'] = '94060';
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
		$data['goodsCode'] = '测试文本aN9L8M';
		$data['goodsName'] = '测试文本BdoqpK';
		$data['limit'] = '14432';
		$data['limitType'] = '73386';
		$data['price'] = '65570';
		$data['stock'] = '50101';
		$data['priceType'] = '1';
		$data['addTime'] = '73834';
		$model = new ShopGoodsModel();
		$model->data($data)->save();

		$update = [];
		$update['shopGoodsId'] = $model->shopGoodsId;
		$update['goodsCode'] = '测试文本Dxf5v0';
		$update['goodsName'] = '测试文本VtnqL2';
		$update['limit'] = '17073';
		$update['limitType'] = '29277';
		$update['price'] = '92915';
		$update['stock'] = '38432';
		$update['priceType'] = '0';
		$update['addTime'] = '14556';
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
		$data['goodsCode'] = '测试文本I7jEU2';
		$data['goodsName'] = '测试文本gXpTSd';
		$data['limit'] = '50380';
		$data['limitType'] = '37133';
		$data['price'] = '33819';
		$data['stock'] = '14604';
		$data['priceType'] = '1';
		$data['addTime'] = '65849';
		$model = new ShopGoodsModel();
		$model->data($data)->save();

		$delData = [];
		$delData['shopGoodsId'] = $model->shopGoodsId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

