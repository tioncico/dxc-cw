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
		$data['name'] = '测试文本Dp9jbZ';
		$data['code'] = '测试文本lxL67Z';
		$data['stackLayer'] = '44358';
		$data['entryCode'] = '测试文本XI1YDg';
		$data['param'] = '测试文本axqdEC';
		$data['type'] = '13885';
		$data['description'] = '测试文本DEdyiO';
		$response = $this->request('add',$data);
		$model = new BuffModel();
		$model->destroy($response->result->buffId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = '测试文本kZCHIP';
		$data['code'] = '测试文本t8Lm3P';
		$data['stackLayer'] = '39120';
		$data['entryCode'] = '测试文本gUw06S';
		$data['param'] = '测试文本xTMAYm';
		$data['type'] = '32290';
		$data['description'] = '测试文本cg9rCu';
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
		$data['name'] = '测试文本sAKvHJ';
		$data['code'] = '测试文本DtGEqn';
		$data['stackLayer'] = '56442';
		$data['entryCode'] = '测试文本PyrpA3';
		$data['param'] = '测试文本g9NVxq';
		$data['type'] = '17868';
		$data['description'] = '测试文本LlmsyW';
		$model = new BuffModel();
		$model->data($data)->save();

		$update = [];
		$update['buffId'] = $model->buffId;
		$update['name'] = '测试文本ouTmNL';
		$update['code'] = '测试文本oWXilE';
		$update['stackLayer'] = '69508';
		$update['entryCode'] = '测试文本HjMYXD';
		$update['param'] = '测试文本WUENfO';
		$update['type'] = '38330';
		$update['description'] = '测试文本EPXpGA';
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
		$data['name'] = '测试文本VrupiO';
		$data['code'] = '测试文本Qadw1D';
		$data['stackLayer'] = '71467';
		$data['entryCode'] = '测试文本r2cG8E';
		$data['param'] = '测试文本7GUdg1';
		$data['type'] = '37907';
		$data['description'] = '测试文本07sE6M';
		$model = new BuffModel();
		$model->data($data)->save();

		$delData = [];
		$delData['buffId'] = $model->buffId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

