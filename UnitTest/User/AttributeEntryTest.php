<?php

namespace UnitTest\User;

use AttributeEntryModel;

/**
 * AttributeEntryTest
 * Class AttributeEntryTest
 * Create With ClassGeneration
 */
class AttributeEntryTest extends UserBaseTestCase
{
	public $modelName = 'AttributeEntry';


	public function testAdd()
	{
		$data = [];
		$data['code'] = '测试文本4REIFj';
		$data['description'] = '测试文本WgFae3';
		$response = $this->request('add',$data);
		$model = new AttributeEntryModel();
		$model->destroy($response->result->entryId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['code'] = '测试文本8qjQ7a';
		$data['description'] = '测试文本OXjxaW';
		$model = new AttributeEntryModel();
		$model->data($data)->save();

		$data = [];
		$data['entryId'] = $model->entryId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->entryId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['code'] = '测试文本xszl3U';
		$data['description'] = '测试文本AMrN1W';
		$model = new AttributeEntryModel();
		$model->data($data)->save();

		$update = [];
		$update['entryId'] = $model->entryId;
		$update['code'] = '测试文本mzebgh';
		$update['description'] = '测试文本hayDIZ';
		$response = $this->request('update',$update);
		$model->destroy($model->entryId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new AttributeEntryModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['code'] = '测试文本Hb15nZ';
		$data['description'] = '测试文本tgpHeb';
		$model = new AttributeEntryModel();
		$model->data($data)->save();

		$delData = [];
		$delData['entryId'] = $model->entryId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

