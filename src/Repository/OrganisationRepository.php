<?php

namespace AcademyHQ\API\Repository;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class OrganisationRepository {
	private $base_url = 'http://api.academyhq.localhost/api/v2';
	// private $base_url = 'https://api.academyhq.com/api/v2';

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}
	/**
	* @return request object according to url and verb
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
	/**
	* @return std organisation objects
	*/
	public function get_all_sub_organisation(){
		$request = $this->make_request_object('/organisation/sub_organisation', 'GET');
		$response = $request->send();
		$data = $response->get_data();
		return $data; //->sub_org_list;
	}

}