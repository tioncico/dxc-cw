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
		$data['name'] = '测试文本bszIW1';
		$data['isDeBuff'] = '3';
		$data['code'] = '测试文本ryKce0';
		$data['stackLayer'] = '10247';
		$data['entryCode'] = '测试文本nzoUJk';
		$data['param'] = '测试文本4Olc1C';
		$data['type'] = '68985';
		$data['description'] = '测试文本W4HXFp';
		$data['expireType'] = '25396';
		$data['expireTime'] = '53580';
		$response = $this->request('add',$data);
		$model = new BuffModel();
		$model->destroy($response->result->buffId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = '测试文本iwz7EF';
		$data['isDeBuff'] = '0';
		$data['code'] = '测试文本uK23j8';
		$data['stackLayer'] = '53506';
		$data['entryCode'] = '测试文本xSneki';
		$data['param'] = '测试文本bPMfFi';
		$data['type'] = '44740';
		$data['description'] = '测试文本QbFjBl';
		$data['expireType'] = '33563';
		$data['expireTime'] = '29948';
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
		$data['name'] = '测试文本JeK568';
		$data['isDeBuff'] = '1';
		$data['code'] = '测试文本JPk14F';
		$data['stackLayer'] = '27360';
		$data['entryCode'] = '测试文本BvSFUJ';
		$data['param'] = '测试文本lKMjYP';
		$data['type'] = '74032';
		$data['description'] = '测试文本RqI62Y';
		$data['expireType'] = '63282';
		$data['expireTime'] = '66803';
		$model = new BuffModel();
		$model->data($data)->save();

		$update = [];
		$update['buffId'] = $model->buffId;
		$update['name'] = '测试文本QsXI7u';
		$update['isDeBuff'] = '0';
		$update['code'] = '测试文本JNL7hp';
		$update['stackLayer'] = '94828';
		$update['entryCode'] = '测试文本V9Dh2g';
		$update['param'] = '测试文本8lgHR6';
		$update['type'] = '35470';
		$update['description'] = '测试文本I6wp5B';
		$update['expireType'] = '85966';
		$update['expireTime'] = '26327';
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
		$data['name'] = '测试文本VoX7cR';
		$data['isDeBuff'] = '3';
		$data['code'] = '测试文本DZHmXO';
		$data['stackLayer'] = '67488';
		$data['entryCode'] = '测试文本VZQuts';
		$data['param'] = '测试文本iz1xcL';
		$data['type'] = '32107';
		$data['description'] = '测试文本1G8oMT';
		$data['expireType'] = '87357';
		$data['expireTime'] = '77133';
		$model = new BuffModel();
		$model->data($data)->save();

		$delData = [];
		$delData['buffId'] = $model->buffId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

