<?php

namespace AcademyHQ\API\Repository;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class LicenseRepository
{

	private $base_url = 'https://api.academyhq.com/api/v2';

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function get_all()
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/licenses'),
			new VO\HTTP\Method('GET')
		);

		$response = $request->send();

		$data = $response->get_data();
		
		return $data->licenses;
	}

	public function create_license(VO\ID $organisation_id, VO\CourseID $course_id){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/licenses/create/license'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString(),
			'course_id' => $course_id->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();
		
		return $data->license_id;
	}
}