<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use \Mockery as m;
use AcademyHQ\API\ValueObjects\Username;
use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class UsernameTest extends PHPUnit_Framework_TestCase
{
	public function tearDown() 
	{
		m::close();
	}

	public function test_assert_id() 
	{

		$username = new Username('kguragai');

		$this->assertEquals($username->toNative(), 'kguragai');
		$this->assertEquals($username->__toString(), 'kguragai');
	}

	public function test_assert_string_with_exception() 
	{

		$this->setExpectedException('AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException');
		$username = new Username(1234);
	}
}