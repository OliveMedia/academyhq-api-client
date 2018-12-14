<?php

namespace AcademyHQ\API\Repository\ConnectedRMS;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;

class OrganisationApiRepository extends BaseRepository{

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;

	}

	public function delete_partner(
		VO\OrganisationID $organisation_id
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/delete/partner'),
			new VO\HTTP\Method('POST')
		);
		
		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString()
		);

		$response = $request->send($request_parameters);
		
		$data = $response->get_data();

		return $data;
	}
	
}