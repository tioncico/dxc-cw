<?php

namespace UnitTest\Common;

use App\Model\ServerModel;

/**
 * ServerTest
 * Class ServerTest
 * Create With ClassGeneration
 */
class ServerTest extends CommonBaseTest
{
	public $modelName = 'Server';


	public function testGetList()
	{
		$model = new ServerModel();
		$data = [];
		$response = $this->request('getList',$data);

		var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}

}

