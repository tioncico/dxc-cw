<?php

namespace UnitTest\Admin;

use MailModel;

/**
 * MailTest
 * Class MailTest
 * Create With ClassGeneration
 */
class MailTest extends AdminBaseTestCase
{
	public $modelName = 'Mail';


	public function testAdd()
	{
		$data = [];
		$data['userId'] = '47355';
		$data['name'] = '测试文本8HN42U';
		$data['msg'] = '测试文本fb2Qtu';
		$data['addTime'] = '20704';
		$data['isRead'] = '2';
		$data['isReceive'] = '1';
		$data['isDelete'] = '0';
		$response = $this->request('add',$data);
		$model = new MailModel();
		$model->destroy($response->result->id);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['userId'] = '36808';
		$data['name'] = '测试文本5rDnv3';
		$data['msg'] = '测试文本KgZ6mz';
		$data['addTime'] = '82215';
		$data['isRead'] = '1';
		$data['isReceive'] = '2';
		$data['isDelete'] = '2';
		$model = new MailModel();
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
		$data['userId'] = '54606';
		$data['name'] = '测试文本hzke4Y';
		$data['msg'] = '测试文本fxGNZU';
		$data['addTime'] = '97580';
		$data['isRead'] = '2';
		$data['isReceive'] = '1';
		$data['isDelete'] = '0';
		$model = new MailModel();
		$model->data($data)->save();

		$update = [];
		$update['id'] = $model->id;
		$update['userId'] = '86505';
		$update['name'] = '测试文本HpJkKu';
		$update['msg'] = '测试文本hs6XWt';
		$update['addTime'] = '19136';
		$update['isRead'] = '3';
		$update['isReceive'] = '2';
		$update['isDelete'] = '3';
		$response = $this->request('update',$update);
		$model->destroy($model->id);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new MailModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['userId'] = '36080';
		$data['name'] = '测试文本hutHxU';
		$data['msg'] = '测试文本6x0nVT';
		$data['addTime'] = '10093';
		$data['isRead'] = '2';
		$data['isReceive'] = '0';
		$data['isDelete'] = '1';
		$model = new MailModel();
		$model->data($data)->save();

		$delData = [];
		$delData['id'] = $model->id;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

