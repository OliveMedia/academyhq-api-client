<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use \Mockery as m;
use AcademyHQ\API\ValueObjects\Password;
use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class PasswordTest extends PHPUnit_Framework_TestCase
{
	public function tearDown() 
	{
		m::close();
	}

	public function test_assert_id() 
	{

		$password = new Password('drowssap');

		$this->assertEquals($password->toNative(), 'drowssap');
		$this->assertEquals($password->__toString(), 'drowssap');
	}

	public function test_assert_string_with_exception() 
	{

		$this->setExpectedException('AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException');
		$password = new Password(1234);
	}
}