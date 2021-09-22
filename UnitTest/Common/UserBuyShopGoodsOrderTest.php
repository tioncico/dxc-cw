<?php

namespace UnitTest\Common;

use App\Model\Game\UserBuyShopGoodsOrderModel;

/**
 * UserBuyShopGoodsOrderTest
 * Class UserBuyShopGoodsOrderTest
 * Create With ClassGeneration
 */
class UserBuyShopGoodsOrderTest extends CommonBaseTest
{
	public $modelName = '/Api/Common/UserBuyShopGoodsOrder';


	public function testAdd()
	{
		$data = [];
		$data['userId'] = '79529';
		$data['shopGoodsId'] = '32442';
		$data['num'] = '63519';
		$data['date'] = '22174';
		$data['addTime'] = '13746';
		$response = $this->request('add',$data);
		$model = new UserBuyShopGoodsOrderModel();
		$model->destroy($response->result->orderId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['userId'] = '73792';
		$data['shopGoodsId'] = '49647';
		$data['num'] = '82957';
		$data['date'] = '36925';
		$data['addTime'] = '70377';
		$model = new UserBuyShopGoodsOrderModel();
		$model->data($data)->save();

		$data = [];
		$data['orderId'] = $model->orderId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->orderId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['userId'] = '33819';
		$data['shopGoodsId'] = '20574';
		$data['num'] = '36619';
		$data['date'] = '67071';
		$data['addTime'] = '60631';
		$model = new UserBuyShopGoodsOrderModel();
		$model->data($data)->save();

		$update = [];
		$update['orderId'] = $model->orderId;
		$update['userId'] = '46208';
		$update['shopGoodsId'] = '91818';
		$update['num'] = '59504';
		$update['date'] = '61385';
		$update['addTime'] = '53199';
		$response = $this->request('update',$update);
		$model->destroy($model->orderId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new UserBuyShopGoodsOrderModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['userId'] = '33295';
		$data['shopGoodsId'] = '59442';
		$data['num'] = '97516';
		$data['date'] = '15482';
		$data['addTime'] = '54010';
		$model = new UserBuyShopGoodsOrderModel();
		$model->data($data)->save();

		$delData = [];
		$delData['orderId'] = $model->orderId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

