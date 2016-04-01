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
			new AppID('abcdef'),
			new SecretKey('abcdef')
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

	public function test_create_enrolments() {

		$member_repository = $this->member_repository();

		$member_id = $member_repository->create(
			VO\Name::fromNative($this->create_string(), $this->create_string()),
			new VO\Username($this->create_string()),
			new VO\Email($this->create_email()),
			new VO\Password($this->create_string())
		);

		$enrolment_repository = $this->enrolment_repository();

		$enrolment_ids = $enrolment_repository->create_enrolments(
			new VO\MemberID($member_id),
			VO\LicenseIDArray::fromNative(array('6', '7', '8'))
		);

		$this->assertEquals(count($enrolment_ids), 3);
	}

	public function test_create_enrolments_send_email() {

		$member_repository = $this->member_repository();

		$member_id = $member_repository->create(
			VO\Name::fromNative($this->create_string(), $this->create_string()),
			new VO\Username($this->create_string()),
			new VO\Email($this->create_email()),
			new VO\Password($this->create_string())
		);

		$enrolment_repository = $this->enrolment_repository();

		$enrolment_ids = $enrolment_repository->create_enrolments(
			new VO\MemberID($member_id),
			VO\LicenseIDArray::fromNative(array('6', '7', '8')),
			new VO\SendEmail(1)
		);

		$this->assertEquals(count($enrolment_ids), 3);
	}

	public function test_create_enrolment()
	{
		$member_repository = $this->member_repository();

		$member_id = $member_repository->create(
			VO\Name::fromNative($this->create_string(), $this->create_string()),
			new VO\Username($this->create_string()),
			new VO\Email($this->create_email()),
			new VO\Password($this->create_string())
		);

		$enrolment_repository = $this->enrolment_repository();

		$enrolment_id = $enrolment_repository->create(
			new VO\MemberID($member_id),
			new VO\LicenseID('6'),
			new VO\SendEmail(1)
		);

		$this->assertNotNull($enrolment_id);
	}

	public function test_create_enrolment_send_email()
	{
		$member_repository = $this->member_repository();

		$member_id = $member_repository->create(
			VO\Name::fromNative($this->create_string(), $this->create_string()),
			new VO\Username($this->create_string()),
			new VO\Email($this->create_email()),
			new VO\Password($this->create_string())
		);

		$enrolment_repository = $this->enrolment_repository();

		$enrolment_id = $enrolment_repository->create(
			new VO\MemberID($member_id),
			new VO\LicenseID('6')
		);

		$this->assertNotNull($enrolment_id);
	}

	public function test_create_enrolment_exception()
	{
		$member_repository = $this->member_repository();

		$member_id = $member_repository->create(
			VO\Name::fromNative($this->create_string(), $this->create_string()),
			new VO\Username($this->create_string()),
			new VO\Email($this->create_email()),
			new VO\Password($this->create_string())
		);

		$enrolment_repository = $this->enrolment_repository();

		$this->setExpectedException('AcademyHQ\API\HTTP\Response\Exception\ResponseException');

		$enrolment_id = $enrolment_repository->create(
			new VO\MemberID($member_id),
			new VO\LicenseID('607')
		);
	}

	public function test_create_enrolment_for_organisation()
	{
		$member_repository = $this->member_repository();

		$member_id = $member_repository->create(
			VO\Name::fromNative($this->create_string(), $this->create_string()),
			new VO\Username($this->create_string()),
			new VO\Email($this->create_email()),
			new VO\Password($this->create_string())
		);

		$enrolment_repository = $this->enrolment_repository();

		$enrolment_ids = $enrolment_repository->create_for_organisation(
			new VO\MemberID($member_id)
		);

		$this->assertEquals(count($enrolment_ids), 5);
	}

	public function test_get_launch_url()
	{
		$enrolment_repository = $this->enrolment_repository();
		$launch_url = $enrolment_repository->get_launch_url(new VO\EnrolmentID('4708'), VO\HTTP\Url::fromNative('https://www.youtube.com/watch?v=CHQ4Sr1JzBo'));

		$this->assertNotNull($launch_url);
	}

	public function test_get_launch_url_exception()
	{
		$enrolment_repository = $this->enrolment_repository();
		$this->setExpectedException('AcademyHQ\API\HTTP\Response\Exception\ResponseException');
		$launch_url = $enrolment_repository->get_launch_url(new VO\EnrolmentID('1234'), VO\HTTP\Url::fromNative('https://www.youtube.com/watch?v=CHQ4Sr1JzBo'));
	}

	public function test_get()
	{
		$enrolment_repository = $this->enrolment_repository();
		$enrolment = $enrolment_repository->get(new VO\EnrolmentID('4668'));

		$this->assertEquals($enrolment->course, 'Barcode 1');
		$this->assertEquals($enrolment->registrations[0]->is_successful, 1);
	}

	public function test_get_exception()
	{
		$enrolment_repository = $this->enrolment_repository();

		$this->setExpectedException('AcademyHQ\API\HTTP\Response\Exception\ResponseException');

		$enrolment = $enrolment_repository->get(new VO\EnrolmentID('1234'));
	}

	public function test_delete()
	{
		$member_repository = $this->member_repository();

		$member_id = $member_repository->create(
			VO\Name::fromNative($this->create_string(), $this->create_string()),
			new VO\Username($this->create_string()),
			new VO\Email($this->create_email()),
			new VO\Password($this->create_string())
		);

		$enrolment_repository = $this->enrolment_repository();

		$enrolment_id = $enrolment_repository->create(
			new VO\MemberID($member_id),
			new VO\LicenseID('610')
		);

		$response = $enrolment_repository->delete(new VO\EnrolmentID($enrolment_id));

		$this->assertEquals($response, 'Enrolment deleted successfully');
	}

	public function test_delete_exception()
	{
		$enrolment_repository = $this->enrolment_repository();

		$this->setExpectedException('AcademyHQ\API\HTTP\Response\Exception\ResponseException');

		$response = $enrolment_repository->delete(new VO\EnrolmentID('1234'));
	}

	public function test_get_all_member_enrolments()
	{
		$member_repository = $this->member_repository();

		$member_id = $member_repository->create(
			VO\Name::fromNative($this->create_string(), $this->create_string()),
			new VO\Username($this->create_string()),
			new VO\Email($this->create_email()),
			new VO\Password($this->create_string())
		);

		$enrolment_repository = $this->enrolment_repository();

		$enrolment_id = $enrolment_repository->create(
			new VO\MemberID($member_id),
			new VO\LicenseID('610')
		);

		$enrolments = $enrolment_repository->get_all_for_member(new VO\MemberID($member_id));

		$this->assertEquals($enrolments[0]->course, 'Barcode 1');
	}

	public function test_get_all_member_enrolments_exception()
	{
		$enrolment_repository = $this->enrolment_repository();

		$this->setExpectedException('AcademyHQ\API\HTTP\Response\Exception\ResponseException');

		$response = $enrolment_repository->get_all_for_member(new VO\MemberID('1234'));
	}

	public function test_sync_result()
	{
		$enrolment_repository = $this->enrolment_repository();
		$enrolment = $enrolment_repository->sync_result(new VO\EnrolmentID('4708'));

		$this->assertEquals($enrolment->is_successful, 1);
		$this->assertNull($enrolment->next_registration);
	}

	public function test_sync_result_exception()
	{
		$enrolment_repository = $this->enrolment_repository();
		$this->setExpectedException('AcademyHQ\API\HTTP\Response\Exception\ResponseException');
		$enrolment = $enrolment_repository->sync_result(new VO\EnrolmentID('4647'));
	}
}