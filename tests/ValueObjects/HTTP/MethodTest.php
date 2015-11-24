<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use \Mockery as m;
use AcademyHQ\API\ValueObjects\HTTP\Method;
use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class MethodTest extends PHPUnit_Framework_TestCase
{
	public function tearDown()
	{
		m::close();
	}

	public function test_set_method()
	{
		$method = new Method('post');

		$this->assertEquals($method->__toString(), 'post');

		$method = new Method('put');

		$this->assertEquals($method->__toString(), 'put');

		$method = new Method('get');

		$this->assertEquals($method->__toString(), 'get');

		$method = new Method('delete');

		$this->assertEquals($method->__toString(), 'delete');
	}

	public function test_not_allowed_method()
	{
		$this->setExpectedException('AcademyHQ\API\ValueObjects\Exception\MethodNotAllowedException');
		$method = new Method('not_allowed_method');
	}
}