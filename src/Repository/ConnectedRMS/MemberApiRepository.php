<?php

namespace AcademyHQ\API\Repository\ConnectedRMS;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class MemberApiRepository {

	private $base_url = 'https://api.academyhq.com/api/v2/crms';

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function get_members(
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
			VO\HTTP\Url::fromNative($this->base_url.'/members/get/'),
			new VO\HTTP\Method('POST')
		);

		$response = $request->send($request_parameters);
		
		$data = $response->get_data();

		return $data;
	}

}