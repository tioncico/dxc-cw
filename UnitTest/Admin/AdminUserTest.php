<?php

namespace UnitTest\Admin;

use App\Model\Admin\AdminUserModel;

/**
 * AdminUserTest
 * Class AdminUserTest
 * Create With ClassGeneration
 */
class AdminUserTest extends AdminBaseTestCase
{
	public $modelName = 'AdminUser';

	public function testAdd()
	{
		$data = [];
		$data['adminName'] = '测试文本RP5fLm';
		$data['adminAccount'] = '测试文本J5ujXL'.mt_rand(10000,99999);
		$data['adminPassword'] = '测试文本4yNRuK';
		$data['addTime'] = '0';
		$data['lastLoginTime'] = '1';
		$data['lastLoginIp'] = '测试文本1ZTQ9g';
		$data['adminSession'] = '测试文本qz3igd';
		$response = $this->request('add',$data);
		$model = new AdminUserModel();
		$model->destroy($response->result->adminId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['adminName'] = '测试文本oOte0M';
		$data['adminAccount'] = '测试文本J5ujXL'.mt_rand(10000,99999);
		$data['adminPassword'] = '测试文本iZ7TlA';
		$data['addTime'] = '1';
		$data['lastLoginTime'] = '0';
		$data['lastLoginIp'] = '测试文本PAMgxr';
		$data['adminSession'] = '测试文本Woe1wB';
		$model = new AdminUserModel();
		$model->data($data)->save();

		$data = [];
		$data['adminId'] = $model->adminId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->adminId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['adminName'] = '测试文本KH5Aym';
		$data['adminAccount'] = '测试文本hdXPxs';
        $data['adminAccount'] = '测试文本J5ujXL'.mt_rand(10000,99999);
        $data['addTime'] = '1';
		$data['lastLoginTime'] = '1';
		$data['lastLoginIp'] = '测试文本D9ebRn';
		$data['adminSession'] = '测试文本QjJhM0';
		$model = new AdminUserModel();
		$model->data($data)->save();

		$update = [];
		$update['adminId'] = $model->adminId;
		$update['adminName'] = '测试文本bJMO5B';
		$update['adminAccount'] = '测试文本J5ujXL'.mt_rand(10000,99999);
		$update['adminPassword'] = '测试文本sdIPNM';
		$update['addTime'] = '1';
		$update['lastLoginTime'] = '0';
		$update['lastLoginIp'] = '测试文本gdD8fS';
		$update['adminSession'] = '测试文本uFBQ21';
		$response = $this->request('update',$update);
		$model->destroy($model->adminId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new AdminUserModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['adminName'] = '测试文本IfSEXk';
		$data['adminAccount'] = '测试文本J5ujXL'.mt_rand(10000,99999);
		$data['adminPassword'] = '测试文本zxiQw4';
		$data['addTime'] = '0';
		$data['lastLoginTime'] = '2';
		$data['lastLoginIp'] = '测试文本TPH1sZ';
		$data['adminSession'] = '测试文本uAYKFi';
		$model = new AdminUserModel();
		$model->data($data)->save();

		$delData = [];
		$delData['adminId'] = $model->adminId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

