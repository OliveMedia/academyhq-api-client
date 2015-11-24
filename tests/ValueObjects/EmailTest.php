<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use \Mockery as m;
use AcademyHQ\API\ValueObjects\Email;
use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class EmailTest extends PHPUnit_Framework_TestCase
{
	public function tearDown()
	{
		m::close();
	}

	public function test_assert_email() 
	{

		$email = new Email('kguragai@olivemedia.co');

		$this->assertEquals($email->toNative(), 'kguragai@olivemedia.co');
		$this->assertEquals($email->__toString(), 'kguragai@olivemedia.co');

		$email = new Email('kiranguragai@gmail.com');

		$this->assertEquals($email->toNative(), 'kiranguragai@gmail.com');
		$this->assertEquals($email->__toString(), 'kiranguragai@gmail.com');
	}

	public function test_assert_email_with_exception() 
	{

		$this->setExpectedException('AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException');
		$email = new Email('kguragai@olive');
	}
}