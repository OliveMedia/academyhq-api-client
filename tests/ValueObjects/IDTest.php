<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use \Mockery as m;
use AcademyHQ\API\ValueObjects\ID;
use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class IDTest extends PHPUnit_Framework_TestCase
{
	public function tearDown() 
	{
		m::close();
	}

	public function test_assert_id() 
	{

		$id = new ID('123');

		$this->assertEquals($id->toNative(), '123');
		$this->assertEquals($id->__toString(), '123');
	}

	public function test_assert_string_with_exception() 
	{

		$this->setExpectedException('AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException');
		$id = new ID(1234);
	}
}