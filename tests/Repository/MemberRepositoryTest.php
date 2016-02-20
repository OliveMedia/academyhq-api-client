<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use \Mockery as m;
use AcademyHQ\API\Repository\MemberRepository;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\ValueObjects\AppID;
use AcademyHQ\API\ValueObjects\SecretKey;
use AcademyHQ\API\Repository\Factory;
use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class MemberRepositoryTest extends PHPUnit_Framework_TestCase
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

	public function test_create_member()
	{
		$member_repository = $this->member_repository();

		$member_id = $member_repository->create(
			VO\Name::fromNative($this->create_string(), $this->create_string()),
			new VO\Username($this->create_string()),
			new VO\Email($this->create_email()),
			new VO\Password($this->create_string())
		);

		$this->assertNotNull($member_id);
	}

	public function test_create_member_with_public_id()
	{
		$member_repository = $this->member_repository();

		$member_id = $member_repository->create(
			VO\Name::fromNative($this->create_string(), $this->create_string()),
			new VO\Username($this->create_string()),
			new VO\Email($this->create_email()),
			new VO\Password($this->create_string()),
			new VO\ID('ABC-JOHN')
		);

		$this->assertNotNull($member_id);
	}

	public function test_create_member_exception()
	{
		$member_repository = $this->member_repository();

		$this->setExpectedException('AcademyHQ\API\HTTP\Response\Exception\ResponseException');

		$member_id = $member_repository->create(
			VO\Name::fromNative($this->create_string(), $this->create_string()),
			new VO\Username('kguragai'),
			new VO\Email($this->create_email()),
			new VO\Password($this->create_string())
		);
	}

	public function test_get_member()
	{
		$member_repository = $this->member_repository();

		$member_id = $member_repository->create(
			VO\Name::fromNative('Test Client', 'Test Client'),
			new VO\Username($this->create_string()),
			new VO\Email($this->create_email()),
			new VO\Password($this->create_string())
		);

		$member = $member_repository->get(new VO\MemberID($member_id));

		$this->assertEquals($member->id, $member_id);
		$this->assertEquals($member->first_name, 'Test Client');
		$this->assertEquals($member->last_name, 'Test Client');
	}

	public function test_get_member_exception()
	{
		$member_repository = $this->member_repository();

		$this->setExpectedException('AcademyHQ\API\HTTP\Response\Exception\ResponseException');

		$member = $member_repository->get(new VO\MemberID('1234abcd'));
	}


	public function test_delete_member()
	{
		$member_repository = $this->member_repository();

		$member_id = $member_repository->create(
			VO\Name::fromNative('Test Client', 'Test Client'),
			new VO\Username($this->create_string()),
			new VO\Email($this->create_email()),
			new VO\Password($this->create_string())
		);

		$response = $member_repository->delete(new VO\MemberID($member_id));

		$this->assertEquals($response, 'Member deleted successfully');
	}

	public function test_delete_member_exception()
	{
		$member_repository = $this->member_repository();

		$this->setExpectedException('AcademyHQ\API\HTTP\Response\Exception\ResponseException');

		$response = $member_repository->delete(new VO\MemberID('1234abcd'));
	}

	public function test_save_member()
	{
		$member_repository = $this->member_repository();

		$member_id = $member_repository->create(
			VO\Name::fromNative($this->create_string(), $this->create_string()),
			new VO\Username($this->create_string()),
			new VO\Email($this->create_email()),
			new VO\Password($this->create_string())
		);

		$response = $member_repository->save(
			new VO\MemberID($member_id),
			VO\Name::fromNative('Updated Fname', 'Updated Lname'),
			new VO\Username('updated'.$this->create_string()),
			new VO\Email('updated'.$this->create_email())
		);

		$this->assertEquals($response, 'Member updated successfully');

		$member = $member_repository->get(new VO\MemberID($member_id));

		$this->assertEquals($member->id, $member_id);
		$this->assertEquals($member->first_name, 'Updated Fname');
		$this->assertEquals($member->last_name, 'Updated Lname');
	}

	public function test_save_member_exception()
	{
		$member_repository = $this->member_repository();

		$member_id = $member_repository->create(
			VO\Name::fromNative($this->create_string(), $this->create_string()),
			new VO\Username($this->create_string()),
			new VO\Email($this->create_email()),
			new VO\Password($this->create_string())
		);

		$this->setExpectedException('AcademyHQ\API\HTTP\Response\Exception\ResponseException');

		$response = $member_repository->save(
			new VO\MemberID($member_id),
			VO\Name::fromNative('Updated Fname', 'Updated Lname'),
			new VO\Username('kguragai'),
			new VO\Email('updated'.$this->create_email())
		);
	}

	public function test_change_password()
	{
		$member_repository = $this->member_repository();

		$member_id = $member_repository->create(
			VO\Name::fromNative($this->create_string(), $this->create_string()),
			new VO\Username($this->create_string()),
			new VO\Email($this->create_email()),
			new VO\Password($this->create_string())
		);

		$response = $member_repository->change_password(
			new VO\MemberID($member_id),
			new VO\Password('drowssap')
		);

		$this->assertEquals($response, 'Member password changed successfully');
	}

	public function test_change_password_exception()
	{
		$member_repository = $this->member_repository();

		$this->setExpectedException('AcademyHQ\API\HTTP\Response\Exception\ResponseException');

		$response = $member_repository->change_password(
			new VO\MemberID('1234abcd'),
			new VO\Password('drowssap')
		);
	}
}