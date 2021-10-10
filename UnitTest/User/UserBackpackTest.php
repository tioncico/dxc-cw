<?php

namespace UnitTest\User;

use UserBackpackModel;

/**
 * UserBackpackTest
 * Class UserBackpackTest
 * Create With ClassGeneration
 */
class UserBackpackTest extends UserBaseTestCase
{
	public $modelName = 'UserBackpack';


	public function testAdd()
	{
		$data = [];
		$data['userId'] = '54754';
		$data['goodsId'] = '22671';
		$data['goodsCode'] = '测试文本7jEHZX';
		$data['num'] = '34685';
		$data['goodsType'] = '0';
		$response = $this->request('add',$data);
		$model = new UserBackpackModel();
		$model->destroy($response->result->backpackId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['userId'] = '62727';
		$data['goodsId'] = '66544';
		$data['goodsCode'] = '测试文本W7cHRP';
		$data['num'] = '59928';
		$data['goodsType'] = '1';
		$model = new UserBackpackModel();
		$model->data($data)->save();

		$data = [];
		$data['backpackId'] = $model->backpackId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->backpackId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['userId'] = '62544';
		$data['goodsId'] = '81798';
		$data['goodsCode'] = '测试文本q5DTvR';
		$data['num'] = '50852';
		$data['goodsType'] = '0';
		$model = new UserBackpackModel();
		$model->data($data)->save();

		$update = [];
		$update['backpackId'] = $model->backpackId;
		$update['userId'] = '49048';
		$update['goodsId'] = '38311';
		$update['goodsCode'] = '测试文本h5TmGs';
		$update['num'] = '12334';
		$update['goodsType'] = '0';
		$response = $this->request('update',$update);
		$model->destroy($model->backpackId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$data = [];
		$response = $this->request('getList',$data);

		var_dump(json_encode($response,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
	}

	public function testGetGoodsInfo()
	{
		$data = [
		    'backpackId'=>59
        ];
		$response = $this->request('getGoodsInfo',$data);

		var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}

	public function testUseGoods()
	{
		$data = [
		    'backpackId'=>828,
            'num'=>1
        ];
		$response = $this->request('useGoods',$data);

		var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['userId'] = '34323';
		$data['goodsId'] = '57528';
		$data['goodsCode'] = '测试文本FkJoGD';
		$data['num'] = '57824';
		$data['goodsType'] = '2';
		$model = new UserBackpackModel();
		$model->data($data)->save();

		$delData = [];
		$delData['backpackId'] = $model->backpackId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

