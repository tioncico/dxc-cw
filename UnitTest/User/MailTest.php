<?php

namespace UnitTest\User;

use MailModel;

/**
 * MailTest
 * Class MailTest
 * Create With ClassGeneration
 */
class MailTest extends UserBaseTestCase
{
	public $modelName = 'Mail';


	public function testAdd()
	{
		$data = [];
		$data['userId'] = '73764';
		$data['name'] = '测试文本XVOjRr';
		$data['msg'] = '测试文本Eiq3jr';
		$data['addTime'] = '76611';
		$data['isRead'] = '1';
		$data['isReceive'] = '3';
		$data['isDelete'] = '0';
		$response = $this->request('add',$data);
		$model = new MailModel();
		$model->destroy($response->result->id);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['userId'] = '63842';
		$data['name'] = '测试文本A69s7L';
		$data['msg'] = '测试文本KBg8p3';
		$data['addTime'] = '19743';
		$data['isRead'] = '2';
		$data['isReceive'] = '2';
		$data['isDelete'] = '1';
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
		$data['userId'] = '15996';
		$data['name'] = '测试文本OBz9Dj';
		$data['msg'] = '测试文本Ccjx2V';
		$data['addTime'] = '81639';
		$data['isRead'] = '3';
		$data['isReceive'] = '3';
		$data['isDelete'] = '2';
		$model = new MailModel();
		$model->data($data)->save();

		$update = [];
		$update['id'] = $model->id;
		$update['userId'] = '54641';
		$update['name'] = '测试文本SrnJym';
		$update['msg'] = '测试文本CMjwT1';
		$update['addTime'] = '15447';
		$update['isRead'] = '0';
		$update['isReceive'] = '3';
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
		$data['userId'] = '12032';
		$data['name'] = '测试文本rSgqoy';
		$data['msg'] = '测试文本rt2q65';
		$data['addTime'] = '91651';
		$data['isRead'] = '2';
		$data['isReceive'] = '0';
		$data['isDelete'] = '3';
		$model = new MailModel();
		$model->data($data)->save();

		$delData = [];
		$delData['id'] = $model->id;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

