<?php

namespace AcademyHQ\API\Repository\WebClient;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class ETBAORepository {

	private $base_url = 'https://api.academyhq.com/api/v2/web/client';

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function create_site_visit(
		VO\Token $token,
		VO\Integer $employer_id,
		VO\EtbID $etb_id,
		VO\ApprenticeshipID $apprenticeship_id,
		VO\StringVO $booked_at
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/etb/authorising_officer/create/site_visit'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'employer_id' => $employer_id->__toInteger(),
			'etb_id' => $etb_id->__toString(),
			'apprenticeship_id' => $apprenticeship_id->__toString(),
			'booked_at' => $booked_at->__toString()
		);

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function edit_site_visit(
		VO\Token $token,
		VO\Integer $site_visit_id,
		VO\StringVO $booked_at,
		VO\Integer $is_visited,
		VO\StringVO $site_visited_at
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/etb/authorising_officer/edit/site_visit'),
			new VO\HTTP\Method('PUT')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'site_visit_id' => $site_visit_id->__toInteger(),
			'booked_at' => $booked_at->__toString(),
			'is_visited' => $is_visited->__toInteger(),
			'site_visited_at' => $site_visited_at->__toString()
		);

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}
}