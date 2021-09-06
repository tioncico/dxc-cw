<?php

namespace UnitTest\Admin;

use MailGoodsModel;

/**
 * MailGoodsTest
 * Class MailGoodsTest
 * Create With ClassGeneration
 */
class MailGoodsTest extends AdminBaseTestCase
{
	public $modelName = 'MailGoods';


	public function testAdd()
	{
		$data = [];
		$data['mailId'] = '39593';
		$data['goodsId'] = '19289';
		$data['num'] = '60488';
		$response = $this->request('add',$data);
		$model = new MailGoodsModel();
		$model->destroy($response->result->id);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['mailId'] = '97253';
		$data['goodsId'] = '37969';
		$data['num'] = '15082';
		$model = new MailGoodsModel();
		$model->data($data)->save();

		$data = [];
		$data['id'] = $model->id;
		$response = $this->request('getOne',$data);
		$model->destroy($model->id);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['mailId'] = '11186';
		$data['goodsId'] = '11939';
		$data['num'] = '65298';
		$model = new MailGoodsModel();
		$model->data($data)->save();

		$update = [];
		$update['id'] = $model->id;
		$update['mailId'] = '30316';
		$update['goodsId'] = '11954';
		$update['num'] = '24219';
		$response = $this->request('update',$update);
		$model->destroy($model->id);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new MailGoodsModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['mailId'] = '28851';
		$data['goodsId'] = '97244';
		$data['num'] = '15301';
		$model = new MailGoodsModel();
		$model->data($data)->save();

		$delData = [];
		$delData['id'] = $model->id;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

