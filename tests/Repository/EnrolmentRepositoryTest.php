<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use \Mockery as m;
use AcademyHQ\API\Repository\EnrolmentRepository;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\ValueObjects\AppID;
use AcademyHQ\API\ValueObjects\SecretKey;
use AcademyHQ\API\Repository\Factory;
use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class EnrolmentRepositoryTest extends PHPUnit_Framework_TestCase
{
	public function tearDown()
	{
		m::close();
	}

	private function create_string()
	{
		$keys = array_merge(range(0,9), range('a', 'z'));

		$string = '';

	    for($i=0; $i < 12; $i++) {
	        $string .= $keys[array_rand($keys)];
	    }
	    return $string;
	}

	private function create_email()
	{
		$string1 = $this->create_string();
		$string2 = $this->create_string();

		return $string1.'@'.$string2.'.com';
	}

	private function enrolment_repository()
	{
		$credentials = new Credentials(
			new AppID('0PM6J17JBYZ7T7JJ3X82'),
			new SecretKey('uV3F3YluFpal1cknvbcGwgjvx4QpvB+leU8dUj2m')
		);

		$factory = new Factory($credentials);

		$enrolment_repository = $factory->get_enrolment_repository();

		return $enrolment_repository;
	}

	private function member_repository()
	{
		$credentials = new Credentials(
			new AppID('0PM6J17JBYZ7T7JJ3X82'),
			new SecretKey('uV3F3YluFpal1cknvbcGwgjvx4QpvB+leU8dUj2m')
		);

		$factory = new Factory($credentials);

		$member_repository = $factory->get_member_repository();

		return $member_repository;
	}

	// public function test_create_enrolment()
	// {
	// 	$member_repository = $this->member_repository();

	// 	$member_id = $member_repository->create(
	// 		VO\Name::fromNative($this->create_string(), $this->create_string()),
	// 		new VO\Username($this->create_string()),
	// 		new VO\Email($this->create_email()),
	// 		new VO\Password($this->create_string())
	// 	);

	// 	$enrolment_repository = $this->enrolment_repository();

	// 	$enrolment_id = $enrolment_repository->create(
	// 		new VO\ID($member_id),
	// 		new VO\ID('610')
	// 	);

	// 	$this->assertNotNull($enrolment_id);
	// }

	// public function test_create_enrolment_exception()
	// {
	// 	$member_repository = $this->member_repository();

	// 	$member_id = $member_repository->create(
	// 		VO\Name::fromNative($this->create_string(), $this->create_string()),
	// 		new VO\Username($this->create_string()),
	// 		new VO\Email($this->create_email()),
	// 		new VO\Password($this->create_string())
	// 	);

	// 	$enrolment_repository = $this->enrolment_repository();

	// 	$this->setExpectedException('AcademyHQ\API\HTTP\Response\Exception\ResponseException');

	// 	$enrolment_id = $enrolment_repository->create(
	// 		new VO\ID($member_id),
	// 		new VO\ID('607')
	// 	);
	// }

	// public function test_get_launch_url()
	// {
	// 	$enrolment_repository = $this->enrolment_repository();
	// 	$launch_url = $enrolment_repository->get_launch_url(new VO\ID('4668'));

	// 	$file = fopen('filename', 'w+');
	// 	fwrite($file, $launch_url);

	// 	echo PHP_EOL;
	// 	print_r($launch_url);
	// 	echo PHP_EOL;

	// 	// header("Location: $launch_url" );
	// }

	public function test_get()
	{

	}

	public function test_get_exception()
	{
		
	}

	public function test_delete()
	{
		
	}

	public function test_delete_exception()
	{
		
	}
}