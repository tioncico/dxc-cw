<?php

namespace UnitTest\User;


/**
 * AdminUserTest
 * Class AdminUserTest
 * Create With ClassGeneration
 */
class AuthTest extends UserBaseTestCase
{
	public $modelName = '/Auth';

	public function testGetInfo(){
	    $response = $this->request('getInfo');
    }
}

