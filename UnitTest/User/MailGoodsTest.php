<?php

namespace UnitTest\User;

use MailGoodsModel;

/**
 * MailGoodsTest
 * Class MailGoodsTest
 * Create With ClassGeneration
 */
class MailGoodsTest extends UserBaseTestCase
{
	public $modelName = 'MailGoods';


	public function testAdd()
	{
		$data = [];
		$data['mailId'] = '36812';
		$data['goodsId'] = '29048';
		$data['num'] = '11032';
		$response = $this->request('add',$data);
		$model = new MailGoodsModel();
		$model->destroy($response->result->id);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['mailId'] = '78562';
		$data['goodsId'] = '61862';
		$data['num'] = '40549';
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
		$data['mailId'] = '55003';
		$data['goodsId'] = '26352';
		$data['num'] = '42580';
		$model = new MailGoodsModel();
		$model->data($data)->save();

		$update = [];
		$update['id'] = $model->id;
		$update['mailId'] = '45813';
		$update['goodsId'] = '45249';
		$update['num'] = '74926';
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
		$data['mailId'] = '67304';
		$data['goodsId'] = '69068';
		$data['num'] = '69823';
		$model = new MailGoodsModel();
		$model->data($data)->save();

		$delData = [];
		$delData['id'] = $model->id;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

