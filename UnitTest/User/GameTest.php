<?php

namespace UnitTest\User;


/**
 * BuffTest
 * Class BuffTest
 * Create With ClassGeneration
 */
class GameTest extends UserBaseTestCase
{
	public $modelName = 'Game';


	public function testAdd()
	{
		$data = [];
		$data['name'] = '测试文本0aDtCM';
		$response = $this->request('add',$data);
		var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$response = $this->request('userInfo',$data);
		var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['name'] = '测试文本ecMtmd';
		$data['isDebuff'] = '1';
		$data['code'] = '测试文本n6zbDs';
		$data['stackLayer'] = '86326';
		$data['entryCode'] = '测试文本KUQeDS';
		$data['param'] = '测试文本tMCaso';
		$data['type'] = '40558';
		$data['description'] = '测试文本8NWrzm';
		$model = new BuffModel();
		$model->data($data)->save();

		$update = [];
		$update['buffId'] = $model->buffId;
		$update['name'] = '测试文本vGjNIL';
		$update['isDebuff'] = '0';
		$update['code'] = '测试文本TbP4L0';
		$update['stackLayer'] = '92163';
		$update['entryCode'] = '测试文本a5jl4B';
		$update['param'] = '测试文本WlFYxb';
		$update['type'] = '42336';
		$update['description'] = '测试文本v1LMGd';
		$response = $this->request('update',$update);
		$model->destroy($model->buffId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


}

