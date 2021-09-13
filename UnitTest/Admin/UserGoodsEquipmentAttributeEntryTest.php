<?php

namespace UnitTest\Admin;

use UserGoodsEquipmentAttributeEntryModel;

/**
 * UserGoodsEquipmentAttributeEntryTest
 * Class UserGoodsEquipmentAttributeEntryTest
 * Create With ClassGeneration
 */
class UserGoodsEquipmentAttributeEntryTest extends AdminBaseTestCase
{
	public $modelName = 'UserGoodsEquipmentAttributeEntry';


	public function testAdd()
	{
		$data = [];
		$data['backpackId'] = '10233';
		$data['code'] = '测试文本ZA7SHD';
		$data['baseCode'] = '测试文本nxXFYB';
		$data['name'] = '测试文本cF0rh1';
		$data['level'] = '69369';
		$data['description'] = '测试文本JqBmj4';
		$data['param'] = '测试文本mzQcpA';
		$response = $this->request('add',$data);
		$model = new UserGoodsEquipmentAttributeEntryModel();
		$model->destroy($response->result->id);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['backpackId'] = '74678';
		$data['code'] = '测试文本o9utLG';
		$data['baseCode'] = '测试文本NT2xrL';
		$data['name'] = '测试文本8OGpYV';
		$data['level'] = '92783';
		$data['description'] = '测试文本7JUAgP';
		$data['param'] = '测试文本fbjad4';
		$model = new UserGoodsEquipmentAttributeEntryModel();
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
		$data['backpackId'] = '63989';
		$data['code'] = '测试文本EVvW9H';
		$data['baseCode'] = '测试文本TEdecl';
		$data['name'] = '测试文本m8thrX';
		$data['level'] = '95548';
		$data['description'] = '测试文本9vZw2L';
		$data['param'] = '测试文本MDwUb0';
		$model = new UserGoodsEquipmentAttributeEntryModel();
		$model->data($data)->save();

		$update = [];
		$update['id'] = $model->id;
		$update['backpackId'] = '74358';
		$update['code'] = '测试文本E97uIX';
		$update['baseCode'] = '测试文本8HcJx7';
		$update['name'] = '测试文本puTEP4';
		$update['level'] = '30067';
		$update['description'] = '测试文本kpC3so';
		$update['param'] = '测试文本9GZ1kS';
		$response = $this->request('update',$update);
		$model->destroy($model->id);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new UserGoodsEquipmentAttributeEntryModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['backpackId'] = '26268';
		$data['code'] = '测试文本Kc7Lok';
		$data['baseCode'] = '测试文本akCBGt';
		$data['name'] = '测试文本zKp63I';
		$data['level'] = '53038';
		$data['description'] = '测试文本JIGgCL';
		$data['param'] = '测试文本BSPeXj';
		$model = new UserGoodsEquipmentAttributeEntryModel();
		$model->data($data)->save();

		$delData = [];
		$delData['id'] = $model->id;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

