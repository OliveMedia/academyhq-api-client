<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use \Mockery as m;
use AcademyHQ\API\ValueObjects\Flag;
use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class FlagTest extends PHPUnit_Framework_TestCase
{
	public function tearDown()
	{
		m::close();
	}

	public function test_assert_flag() {

		$flag = new Flag(true);

		$this->assertEquals($flag->__toBool(), 1);

		$flag = new Flag(1);

		$this->assertEquals($flag->__toBool(), 1);

		$flag = new Flag(false);

		$this->assertEquals($flag->__toBool(), 0);

		$flag = new Flag(0);

		$this->assertEquals($flag->__toBool(), 0);
	}

	public function test_flag_exception() {

		$this->setExpectedException('AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException');
		$flag = new Flag('olive');
	}
}