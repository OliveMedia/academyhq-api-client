<?php

namespace AcademyHQ\API\Repository\WebClient;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class ETBAdminRepository {

	private $base_url = 'https://api.academyhq.com/api/v2/web/client';

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function assign_ao_to_apprenticeship_application(
		VO\Token $token,
		VO\ApprenticeshipID $apprenticeship_id,
		VO\Integer $authorising_officer_id
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/etb/admin/assign/authorising_officer/to/apprenticeship/application'),
			new VO\HTTP\Method('PUT')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'apprenticeship_id' => $apprenticeship_id->__toString(),
			'authorising_officer_id' => $authorising_officer_id->__toInteger()
		);

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}
}