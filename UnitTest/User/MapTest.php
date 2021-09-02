<?php

namespace UnitTest\User;

use MapModel;

/**
 * MapTest
 * Class MapTest
 * Create With ClassGeneration
 */
class MapTest extends UserBaseTestCase
{
	public $modelName = 'Map';


	public function testAdd()
	{
		$data = [];
		$data['name'] = '测试文本XSIZzE';
		$data['description'] = '测试文本tPAK3R';
		$data['recommendedLevel'] = '60426';
		$data['isInstanceZone'] = '67646';
		$data['exp'] = '97790';
		$data['gold'] = '69163';
		$data['material'] = '26463';
		$data['equipment'] = '10051';
		$data['pet'] = '13132';
		$data['prop'] = '60677';
		$data['order'] = '72867';
		$response = $this->request('add',$data);
		$model = new MapModel();
		$model->destroy($response->result->mapId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetOne()
	{
		$data = [];
		$data['name'] = '测试文本iCdbSF';
		$data['description'] = '测试文本ZNc3zG';
		$data['recommendedLevel'] = '13401';
		$data['isInstanceZone'] = '33533';
		$data['exp'] = '51215';
		$data['gold'] = '28697';
		$data['material'] = '76421';
		$data['equipment'] = '13163';
		$data['pet'] = '41243';
		$data['prop'] = '35968';
		$data['order'] = '30976';
		$model = new MapModel();
		$model->data($data)->save();

		$data = [];
		$data['mapId'] = $model->mapId;
		$response = $this->request('getOne',$data);
		$model->destroy($model->mapId);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testUpdate()
	{
		$data = [];
		$data['name'] = '测试文本80VFmf';
		$data['description'] = '测试文本fnQYr1';
		$data['recommendedLevel'] = '36374';
		$data['isInstanceZone'] = '52255';
		$data['exp'] = '68029';
		$data['gold'] = '22001';
		$data['material'] = '39234';
		$data['equipment'] = '98187';
		$data['pet'] = '41680';
		$data['prop'] = '87497';
		$data['order'] = '77690';
		$model = new MapModel();
		$model->data($data)->save();

		$update = [];
		$update['mapId'] = $model->mapId;
		$update['name'] = '测试文本70vD98';
		$update['description'] = '测试文本GeJ43p';
		$update['recommendedLevel'] = '63832';
		$update['isInstanceZone'] = '39443';
		$update['exp'] = '61478';
		$update['gold'] = '41618';
		$update['material'] = '87471';
		$update['equipment'] = '66888';
		$update['pet'] = '28571';
		$update['prop'] = '98038';
		$update['order'] = '82189';
		$response = $this->request('update',$update);
		$model->destroy($model->mapId);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testGetList()
	{
		$model = new MapModel();
		$data = [];
		$response = $this->request('getList',$data);

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}


	public function testDel()
	{
		$data = [];
		$data['name'] = '测试文本6L4eax';
		$data['description'] = '测试文本4LBoH9';
		$data['recommendedLevel'] = '62344';
		$data['isInstanceZone'] = '73468';
		$data['exp'] = '99621';
		$data['gold'] = '80408';
		$data['material'] = '98759';
		$data['equipment'] = '72228';
		$data['pet'] = '29372';
		$data['prop'] = '58003';
		$data['order'] = '60340';
		$model = new MapModel();
		$model->data($data)->save();

		$delData = [];
		$delData['mapId'] = $model->mapId;
		$response = $this->request('delete',$delData);
		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}
}

