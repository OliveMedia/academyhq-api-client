<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use \Mockery as m;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\ValueObjects\AppID;
use AcademyHQ\API\ValueObjects\SecretKey;
use AcademyHQ\API\Repository\Factory;
use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class FactoryTest extends PHPUnit_Framework_TestCase
{
	public function tearDown()
	{
		m::close();
	}

	public function test_factory()
	{
		$credentials = new Credentials(
			new AppID('0PM6J17JBYZ7T7JJ3X82'),
			new SecretKey('uV3F3YluFpal1cknvbcGwgjvx4QpvB+leU8dUj2m')
		);

		$factory = new Factory($credentials);

		$license_repository = $factory->get_license_repository();
		$enrolment_repository = $factory->get_enrolment_repository();
		$member_repository = $factory->get_member_repository();

		$this->assertInstanceOf('AcademyHQ\API\Repository\LicenseRepository', $license_repository);
		$this->assertInstanceOf('AcademyHQ\API\Repository\MemberRepository', $member_repository);
		$this->assertInstanceOf('AcademyHQ\API\Repository\EnrolmentRepository', $enrolment_repository);
	}
}