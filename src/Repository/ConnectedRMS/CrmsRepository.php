<?php

namespace AcademyHQ\API\Repository\ConnectedRMS;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;

class CrmsRepository extends BaseRepository{

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;

	}
	
	private function get_url(){
		return $this->base_url.'/crms';
	}


	public function create_client(
		VO\StringVO $name,
		VO\StringVO $domain
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/create/client'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'name' => $name->__toString(),
			'domain' => $domain->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function get_courses(
		VO\StringVO $search=null,
		VO\Integer $current_page
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/courses/get'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'search' => $search ? $search->__toString() : '',
			'current_page' => $current_page->__toInteger()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function create_course(
		VO\StringVO $name,
		VO\StringVO $description,
		VO\StringVO $image_url = null
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/create/course'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'name' => $name->__toString(),
			'description' => $description->__toString(),
			'image_url' => $image_url ? $image_url->__toString() : '',
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function find_license(
		VO\OrganisationID $organisation_id,
		VO\CourseID $course_id
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/find/license'),
			new VO\HTTP\Method('post')
		);
		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString(),
			'course_id' => $course_id->__toString()
		);
		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}
	
}