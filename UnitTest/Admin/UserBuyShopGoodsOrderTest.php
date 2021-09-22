<?php

namespace UnitTest\Admin;

use App\Model\Game\UserBuyShopGoodsOrderModel;

/**
 * UserBuyShopGoodsOrderTest
 * Class UserBuyShopGoodsOrderTest
 * Create With ClassGeneration
 */
class UserBuyShopGoodsOrderTest extends AdminBaseTestCase
{
	public $modelName = '/Api/Admin/UserBuyShopGoodsOrder';


	public function testAdd()
	{
		$data = [];
		$data['userId'] = '58166';
		$data['shopGoodsId'] = '73815';
		$data['num'] = '14417';
		$data['date'] = '57826';
		$data['addTime'] = '89161';
		$response = $this->request('add',$data);
		$model = new UserBuyShopGoodsOrderModel();
		$model->destroy($response->result->orderId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['userId'] = '92951';
		$data['shopGoodsId'] = '70957';
		$data['num'] = '16316';
		$data['date'] = '30649';
		$data['addTime'] = '77360';
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
		$data['userId'] = '28394';
		$data['shopGoodsId'] = '47192';
		$data['num'] = '52419';
		$data['date'] = '73775';
		$data['addTime'] = '74849';
		$model = new UserBuyShopGoodsOrderModel();
		$model->data($data)->save();

		$update = [];
		$update['orderId'] = $model->orderId;
		$update['userId'] = '65039';
		$update['shopGoodsId'] = '39858';
		$update['num'] = '65832';
		$update['date'] = '70249';
		$update['addTime'] = '50517';
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
		$data['userId'] = '76270';
		$data['shopGoodsId'] = '40037';
		$data['num'] = '78073';
		$data['date'] = '44055';
		$data['addTime'] = '98046';
		$model = new UserBuyShopGoodsOrderModel();
		$model->data($data)->save();

		$delData = [];
		$delData['orderId'] = $model->orderId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

