<?php

namespace UnitTest\User;

use BuffModel;

/**
 * BuffTest
 * Class BuffTest
 * Create With ClassGeneration
 */
class BuffTest extends UserBaseTestCase
{
	public $modelName = 'Buff';


	public function testAdd()
	{
		$data = [];
		$data['name'] = '测试文本0aDtCM';
		$data['isDebuff'] = '1';
		$data['code'] = '测试文本PnTldk';
		$data['stackLayer'] = '52864';
		$data['entryCode'] = '测试文本xOIq6C';
		$data['param'] = '测试文本W8fqkF';
		$data['type'] = '17943';
		$data['description'] = '测试文本M25Oa9';
		$response = $this->request('add',$data);
		$model = new BuffModel();
		$model->destroy($response->result->buffId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = '测试文本Q0c2Ej';
		$data['isDebuff'] = '2';
		$data['code'] = '测试文本zrFpaX';
		$data['stackLayer'] = '35275';
		$data['entryCode'] = '测试文本lXbOct';
		$data['param'] = '测试文本5BfgoG';
		$data['type'] = '36271';
		$data['description'] = '测试文本60sr5m';
		$model = new BuffModel();
		$model->data($data)->save();

		$data = [];
		$data['buffId'] = $model->buffId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->buffId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
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


	public function testGetList()
	{
		$model = new BuffModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['name'] = '测试文本Fw8bWx';
		$data['isDebuff'] = '1';
		$data['code'] = '测试文本C4m0iO';
		$data['stackLayer'] = '31424';
		$data['entryCode'] = '测试文本SuTpei';
		$data['param'] = '测试文本QMJRNV';
		$data['type'] = '21841';
		$data['description'] = '测试文本5V32FY';
		$model = new BuffModel();
		$model->data($data)->save();

		$delData = [];
		$delData['buffId'] = $model->buffId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

