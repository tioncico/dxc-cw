<?php

namespace UnitTest\User;

use App\Model\Game\UserBuyShopGoodsOrderModel;

/**
 * UserBuyShopGoodsOrderTest
 * Class UserBuyShopGoodsOrderTest
 * Create With ClassGeneration
 */
class UserBuyShopGoodsOrderTest extends UserBaseTestCase
{
	public $modelName = '/Api/User/UserBuyShopGoodsOrder';


	public function testAdd()
	{
		$data = [];
		$data['userId'] = '55955';
		$data['shopGoodsId'] = '67013';
		$data['num'] = '49924';
		$data['date'] = '20514';
		$data['addTime'] = '75872';
		$response = $this->request('add',$data);
		$model = new UserBuyShopGoodsOrderModel();
		$model->destroy($response->result->orderId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['userId'] = '16270';
		$data['shopGoodsId'] = '12438';
		$data['num'] = '77922';
		$data['date'] = '20510';
		$data['addTime'] = '35717';
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
		$data['userId'] = '16906';
		$data['shopGoodsId'] = '63614';
		$data['num'] = '53961';
		$data['date'] = '90458';
		$data['addTime'] = '89870';
		$model = new UserBuyShopGoodsOrderModel();
		$model->data($data)->save();

		$update = [];
		$update['orderId'] = $model->orderId;
		$update['userId'] = '77085';
		$update['shopGoodsId'] = '75895';
		$update['num'] = '79867';
		$update['date'] = '56792';
		$update['addTime'] = '38612';
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
		$data['userId'] = '58000';
		$data['shopGoodsId'] = '96096';
		$data['num'] = '88085';
		$data['date'] = '35969';
		$data['addTime'] = '61523';
		$model = new UserBuyShopGoodsOrderModel();
		$model->data($data)->save();

		$delData = [];
		$delData['orderId'] = $model->orderId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

