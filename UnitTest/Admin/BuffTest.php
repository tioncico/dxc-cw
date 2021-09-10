<?php

namespace UnitTest\Admin;

use BuffModel;

/**
 * BuffTest
 * Class BuffTest
 * Create With ClassGeneration
 */
class BuffTest extends AdminBaseTestCase
{
	public $modelName = 'Buff';


	public function testAdd()
	{
		$data = [];
		$data['name'] = '测试文本qAYPlT';
		$data['isDebuff'] = '3';
		$data['code'] = '测试文本Yi5nZf';
		$data['stackLayer'] = '81540';
		$data['entryCode'] = '测试文本ILQV2q';
		$data['param'] = '测试文本L5E4Yj';
		$data['type'] = '37538';
		$data['description'] = '测试文本r9uEcy';
		$response = $this->request('add',$data);
		$model = new BuffModel();
		$model->destroy($response->result->buffId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = '测试文本vKP3wq';
		$data['isDebuff'] = '0';
		$data['code'] = '测试文本S05CaV';
		$data['stackLayer'] = '43200';
		$data['entryCode'] = '测试文本FblkHz';
		$data['param'] = '测试文本D4foN7';
		$data['type'] = '82071';
		$data['description'] = '测试文本T1yoSQ';
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
		$data['name'] = '测试文本XWUY24';
		$data['isDebuff'] = '3';
		$data['code'] = '测试文本Dl6fRk';
		$data['stackLayer'] = '74849';
		$data['entryCode'] = '测试文本WR2Phr';
		$data['param'] = '测试文本ApH2yM';
		$data['type'] = '53588';
		$data['description'] = '测试文本8wg9uA';
		$model = new BuffModel();
		$model->data($data)->save();

		$update = [];
		$update['buffId'] = $model->buffId;
		$update['name'] = '测试文本M345iR';
		$update['isDebuff'] = '0';
		$update['code'] = '测试文本7I1vx9';
		$update['stackLayer'] = '20978';
		$update['entryCode'] = '测试文本7qHfFi';
		$update['param'] = '测试文本aFbhkA';
		$update['type'] = '14856';
		$update['description'] = '测试文本bJ90fx';
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
		$data['name'] = '测试文本NSMiqG';
		$data['isDebuff'] = '2';
		$data['code'] = '测试文本XqQ3Ml';
		$data['stackLayer'] = '65188';
		$data['entryCode'] = '测试文本m92XRw';
		$data['param'] = '测试文本nu6Cwi';
		$data['type'] = '26442';
		$data['description'] = '测试文本0EhGcM';
		$model = new BuffModel();
		$model->data($data)->save();

		$delData = [];
		$delData['buffId'] = $model->buffId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

