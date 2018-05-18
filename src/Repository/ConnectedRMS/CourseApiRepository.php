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

}