<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use \Mockery as m;
use AcademyHQ\API\Repository\LicenseRepository;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\ValueObjects\AppID;
use AcademyHQ\API\ValueObjects\SecretKey;
use AcademyHQ\API\Repository\Factory;
use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class LicenseRepositoryTest extends PHPUnit_Framework_TestCase
{
	public function tearDown()
	{
		m::close();
	}

	private function license_repository()
	{
		$credentials = new Credentials(
			new AppID('abcdef'),
			new SecretKey('abcdef')
		);

		$factory = new Factory($credentials);

		$license_repository = $factory->get_license_repository();

		return $license_repository;
	}

	public function test_get_all_licenses()
	{
		$license_repository = $this->license_repository();

		$licenses = $license_repository->get_all();

		$this->assertEquals(count($licenses), 5);

		$this->assertEquals($licenses[0]->course->name, 'Barcode 1');
		$this->assertEquals($licenses[0]->course->modules[0]->name, 'Test Module 6');
	}
}