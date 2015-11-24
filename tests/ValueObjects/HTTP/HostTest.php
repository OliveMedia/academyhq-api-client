<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use \Mockery as m;
use AcademyHQ\API\ValueObjects\HTTP\Host;
use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class HostTest extends PHPUnit_Framework_TestCase
{
	public function tearDown()
	{
		m::close();
	}

	public function test_host()
	{
		$host = new Host('www.academyhq.com');

		$this->assertEquals($host->toNative(), 'www.academyhq.com');
		$this->assertEquals($host->__toString(), 'www.academyhq.com');

		$host = new Host('olivemedia.co');

		$this->assertEquals($host->toNative(), 'olivemedia.co');
		$this->assertEquals($host->__toString(), 'olivemedia.co');

		$host = new Host('microsoft.net');

		$this->assertEquals($host->toNative(), 'microsoft.net');
		$this->assertEquals($host->__toString(), 'microsoft.net');
	}

	public function test_invalid_host()
	{
		$this->setExpectedException('AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException');
		$host = new Host('ab%cd');
	}
}