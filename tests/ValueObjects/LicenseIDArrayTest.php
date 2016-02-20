<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use \Mockery as m;
use AcademyHQ\API\ValueObjects\LicenseID;
use AcademyHQ\API\ValueObjects\LicenseIDArray;
use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class LicenseIDArrayTest extends PHPUnit_Framework_TestCase
{

	public function tearDown() 
	{
		m::close();
	}

	public function test_from_native() {

		$license_ids = array('id1', 'id2', 'id3');

		$license_id_array = LicenseIDArray::fromNative($license_ids);

		$license_ids = $license_id_array->get_licenses();

		$this->assertTrue(is_array($license_ids));

		$this->assertEquals($license_ids[0]->__toString(), 'id1');

		$array = $license_id_array->__toArray();

		$this->assertEquals($array[1], 'id2');
	}
}