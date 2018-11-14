<?php

namespace AcademyHQ\API\Repository\ConnectedRMS;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;

class MemberApiRepository extends BaseRepository{

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;

	}

	private function get_url(){
		return $this->base_url.'/crms';
	}

	public function get_members(
		VO\StringVO $search=null,
		VO\Integer $current_page,
		$fetch_all=null
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/members/get'),
			new VO\HTTP\Method('POST')
		);
		
		$request_parameters = array(
			'search' => $search ? $search->__toString() : '',
			'current_page' => $current_page->__toInteger()
		);

		if($fetch_all)
			$request_parameters['fetch_all'] = true;

		$response = $request->send($request_parameters);
		
		$data = $response->get_data();

		return $data;
	}

	public function check_course_enrollment(
		VO\MemberID $member_id,
		VO\CourseID $course_id
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/member/course/enrollment/check'),
			new VO\HTTP\Method('POST')
		);
		
		$request_parameters = array(
			'member_id' => $member_id->__toString(),
			'course_id' => $course_id->__toString()
		);

		$response = $request->send($request_parameters);
		
		$data = $response->get_data();

		return $data;
	}

	public function check_package_enrollment(
		VO\MemberID $member_id,
		VO\ID $package_id
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/member/package/enrollment/check'),
			new VO\HTTP\Method('POST')
		);
		
		$request_parameters = array(
			'member_id' => $member_id->__toString(),
			'package_id' => $package_id->__toString()
		);

		$response = $request->send($request_parameters);
		
		$data = $response->get_data();

		return $data;
	}


	public function create_enrolment(VO\MemberID $member_id, VO\CourseID $course_id, VO\Flag $send_email = null)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/enrolment/create'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'member_id' => $member_id->__toString(),
			'course_id' => $course_id->__toString()
		);

		if($send_email) {
			$request_parameters['send_email'] = $send_email->__toBool();
		}
		$response = $request->send($request_parameters);
		
		$data = $response->get_data();

		return $data;
	}

	public function create_member(
		VO\Name $name,
		VO\Username $username,
		VO\Password $password,
		VO\Password $password_confirm,
		VO\PublicID $pub_id = null,
		VO\StringVO $email,
		VO\Integer $is_admin = null
	)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/member/create'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString(),
			'username' => $username->__toString(),
			'password' => $password->__toString(),
			'password_confirm' => $password_confirm->__toString(),
			'email' => $email->__toString()
		);

		if($pub_id) {
			$request_parameters['pub_id'] = $pub_id->__toString();
		}
		if($is_admin) {
			$request_parameters['is_admin'] = $is_admin->__toInteger();
		}

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}


	public function member_get(VO\MemberID $id)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/get/member/'.$id->__toString().'/details'),
			new VO\HTTP\Method('GET')
		);

		$response = $request->send();

		$data = $response->get_data();

		return $data;
	}

	public function fetch_profile_members(
		VO\ID $profile_id,
		VO\Integer $current_page,
		VO\StringVO $search = null
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/profile/members'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'profile_id' => $profile_id->__toString()
		);

		if(!is_null($current_page)){
			$request_parameters['current_page'] = $current_page->__toInteger();
		}

		if(!is_null($search)){
			$request_parameters['search'] = $search->__toString();
		}

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

}