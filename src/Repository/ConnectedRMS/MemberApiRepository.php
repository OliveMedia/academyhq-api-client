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
			VO\HTTP\Url::fromNative($this->base_url.'/enrolment/create'),
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

		return $data->enrolment_id;
	}

}