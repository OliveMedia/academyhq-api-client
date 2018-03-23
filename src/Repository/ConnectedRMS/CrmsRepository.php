<?php

namespace AcademyHQ\API\Repository\ConnectedRMS;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class CrmsRepository {

	private $base_url = 'https://api.academyhq.com/api/v2/crms';

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function create_client(
		VO\StringVO $name,
		VO\StringVO $domain
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/create/client'),
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

		$request_parameters = array(
			'search' => $search ? $search->__toString() : '',
			'current_page' => $current_page->__toInteger()
		);

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/courses/get/'),
			new VO\HTTP\Method('POST')
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
			VO\HTTP\Url::fromNative($this->base_url.'/create/course'),
			new VO\HTTP\Method('GET')
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
	
}