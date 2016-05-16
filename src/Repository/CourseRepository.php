<?php

namespace AcademyHQ\API\Repository;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class CourseRepository {

	private $base_url = 'https://api.academyhq.com/api/v2';

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function get_all() {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/courses'),
			new VO\HTTP\Method('GET')
		);

		$response = $request->send();

		$data = $response->get_data();
		
		return $data->courses;
	}

	public function get(VO\CourseID $id) {

		$course_id = $id->__toString();
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/course/'.$course_id.'/get'),
			new VO\HTTP\Method('GET')
		);

		$response = $request->send();

		$data = $response->get_data();
		return $data->course;
	}

	public function get_by_pub_id(VO\ID $id) {

		$pub_id = $id->__toString();
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/course_by_pub_id/'.$pub_id.'/get'),
			new VO\HTTP\Method('GET')
		);

		$response = $request->send();

		$data = $response->get_data();
		return $data->course;
	}
}