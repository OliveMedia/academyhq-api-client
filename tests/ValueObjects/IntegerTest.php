<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use \Mockery as m;
use AcademyHQ\API\ValueObjects\Integer;
use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class EmailTest extends PHPUnit_Framework_TestCase
{
	public function tearDown()
	{
		m::close();
	}

	public function test_integer()
	{
		$integer = new Integer(12);

		$this->assertEquals($integer->toNative(), 12);
		$this->assertEquals($integer->__toInteger(), 12);

		$integer = new Integer('24');

		$this->assertEquals($integer->toNative(), 24);
		$this->assertEquals($integer->__toInteger(), 24);
	}

	public function test_invalid_integer()
	{
		$this->setExpectedException('AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException');
		$integer = new Integer('abc');
	}

	public function test_null_integer()
	{
		$integer = new Integer(null);

		$this->assertEquals($integer->toNative(), 0);
	}
}