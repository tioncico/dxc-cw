<?php

namespace UnitTest\Admin;

use App\Model\Admin\AdminUserModel;

/**
 * AdminUserTest
 * Class AdminUserTest
 * Create With ClassGeneration
 */
class AuthTest extends AdminBaseTestCase
{
	public $modelName = '/Auth';

	public function testGetInfo(){
	    $response = $this->request('getInfo');
    }
}

