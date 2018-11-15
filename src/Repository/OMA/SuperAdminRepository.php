<?php

namespace AcademyHQ\API\Repository\OMA;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;

class SuperAdminRepository extends BaseRepository
{
	public function __construct(Credentials $credentials)
	{
		parent::__construct();
		$this->credentials = $credentials;
		// $this->base_url .= '/crms';
	}

	public function get_organisations(
		VO\Integer $current_page,
		VO\StringVO $search = null
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/crms/organisations/get'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'current_page' => $current_page->__toInteger()
		);

		if($search){
			$request_parameters['search'] = $search->__toString();
		}

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}
}
