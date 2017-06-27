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

	/**
	* @return request object
	*/
	private function make_request_object($url, $verb){
		$request = new Request(
				new GuzzleClient,
				$this->credentials,
				VO\HTTP\Url::fromNative($this->base_url.$url),
				new VO\HTTP\Method($verb)
			);
		return $request;
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


	/**
	* @return license objects
	*/
	public function fetch_all_organisation_licenses(){
		$request = $this->make_request_object('/organisation/all_license', 'GET');
		$response = $request->send();
		$data = $response->get_data();
		return $data;
	}
	/**
	* @return license objects
	*/
	public function fetch_sub_organisation_licenses($id){
		$request = $this->make_request_object('/organisation/sub_organisation_licenses/'.$id, 'GET');
		$response= $request->send();
		$data = $response->get_data();
		return $data;
	}
}