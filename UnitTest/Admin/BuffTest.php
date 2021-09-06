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
		$data['name'] = '测试文本f10ZUi';
		$data['code'] = '测试文本wkJqIs';
		$data['stackLayer'] = '22350';
		$data['entryCode'] = '测试文本o1ivRO';
		$data['param'] = '测试文本0SpnVu';
		$data['description'] = '测试文本8zrf4J';
		$response = $this->request('add',$data);
		$model = new BuffModel();
		$model->destroy($response->result->buffId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = '测试文本wPjymW';
		$data['code'] = '测试文本2erlFi';
		$data['stackLayer'] = '10390';
		$data['entryCode'] = '测试文本opQWG2';
		$data['param'] = '测试文本vgDyu2';
		$data['description'] = '测试文本ZwxnaO';
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
		$data['name'] = '测试文本oEZSa8';
		$data['code'] = '测试文本phm1GK';
		$data['stackLayer'] = '72291';
		$data['entryCode'] = '测试文本4b8KvQ';
		$data['param'] = '测试文本l6H1Bu';
		$data['description'] = '测试文本sO2y5a';
		$model = new BuffModel();
		$model->data($data)->save();

		$update = [];
		$update['buffId'] = $model->buffId;
		$update['name'] = '测试文本R4cCdy';
		$update['code'] = '测试文本yRqYQj';
		$update['stackLayer'] = '94552';
		$update['entryCode'] = '测试文本kFhuOm';
		$update['param'] = '测试文本R1yZJ4';
		$update['description'] = '测试文本0Cld3p';
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
		$data['name'] = '测试文本2jkl61';
		$data['code'] = '测试文本izu41C';
		$data['stackLayer'] = '69315';
		$data['entryCode'] = '测试文本sfej3x';
		$data['param'] = '测试文本cKQbTi';
		$data['description'] = '测试文本V74hCP';
		$model = new BuffModel();
		$model->data($data)->save();

		$delData = [];
		$delData['buffId'] = $model->buffId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

