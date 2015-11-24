<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use \Mockery as m;
use AcademyHQ\API\ValueObjects\String;
use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class StringTest extends PHPUnit_Framework_TestCase
{
	public function tearDown() 
	{
		m::close();
	}

	public function test_assert_string() 
	{

		$string = new String('Api Client');

		$this->assertEquals($string->toNative(), 'Api Client');
		$this->assertEquals($string->__toString(), 'Api Client');
	}

	public function test_assert_string_with_exception() 
	{

		$this->setExpectedException('AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException');
		$string = new String(1234);
	}

	public function test_is_empty()
	{
		$string = new String('');

		$this->assertTrue($string->isEmpty());
	}
}