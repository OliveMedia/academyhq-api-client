<?php

namespace AcademyHQ\API\Repository\ConnectedRMS;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;

class CourseApiRepository extends BaseRepository {

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	private function get_url(){
		return $this->base_url.'/crms';
	}

	public function get_licenses(
		VO\StringVO $search=null,
		VO\Integer $current_page,
		$fetch_all=null
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/licenses/get'),
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
	
	public function fetch_all_profiles()
	{

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/profiles/get'),
			new VO\HTTP\Method('POST')
		);


		$request_parameters = array();

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;

	}

	public function fetch_all_modules(VO\CourseID $course_id,VO\StringVO $callback_url)
	{

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/course/modules/get'),
			new VO\HTTP\Method('POST')
		);


		$request_parameters = array(
			'course_id' => $course_id->__toString(),
			'callback_url' => $callback_url->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;

	}

	public function get_license_enrolled_members(
		VO\CourseID $course_id=null,
		VO\LicenseID $license_id=null,
		VO\StringVO $search=null,
		VO\Integer $page =null
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/license/enrolled/members'),
			new VO\HTTP\Method('POST')
		);
		$request_parameters = array(
			'course_id' => $course_id ? $course_id->__toString():'',
			'license_id' => $license_id ? $license_id->__toString():'',
			'search' => $search ? $search->__toString() : '',
			'page' => $page ? $page->__toInteger() : ''
		);
		$response = $request->send($request_parameters);
		$data = $response->get_data();
		return $data;
	}

	public function add_license(
		VO\LicenseID $license_id=null,
		VO\CourseID $course_id=null,
		VO\Integer $number_of_license,
		VO\StringVO $price,
		VO\StringVO $currency,
		VO\StringVO $full_name,
		VO\StringVO $vat_rate,
		VO\StringVO $vat_number,
		VO\Email $email
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/add/license'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'full_name' => $full_name->__toString(),
			'number_of_license' => $number_of_license->__toInteger(),
			'price' => $price->__toString(),
			'currency' => $currency->__toString(),
			'vat_rate' => $vat_rate->__toString(),
			'vat_number' => $vat_number->__toString(),
			'email' => $email->__toString()
		);
		$license_id ? 
			$request_parameters['license_id'] = $license_id->__toString():
		null;
		
		$course_id ?
			$request_parameters['course_id'] = $course_id->__toString():
		null;

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function license_check(VO\CourseID $course_id){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/check/license/'.$course_id->__toString()),
			new VO\HTTP\Method('GET')
		);
		$response = $request->send();

		$data = $response->get_data();

		return $data;
	}

	public function get_organisation_packages(){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/organisation/packages'),
			new VO\HTTP\Method('POST')
		);
		$response = $request->send(array());

		$data = $response->get_data();

		return $data;
	}

	public function get_package_details(VO\ID $id){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/package/'.$id->__toString().'/details'),
			new VO\HTTP\Method('GET')
		);
		$response = $request->send(array());

		$data = $response->get_data();

		return $data;
	}


}