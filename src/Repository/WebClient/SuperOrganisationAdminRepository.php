<?php

namespace AcademyHQ\API\Repository\WebClient;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class SuperOrganisationAdminRepository {

	private $base_url = 'https://api.academyhq.com/api/v2/web/client';

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function create_etb(
		VO\Token $token,
		VO\Address $address,
		VO\Latitude $latitude,
		VO\Longitude $longitude,
		VO\Id $pub_id,
		VO\Name $name

	) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'super_organisation/etb/create'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => 'ZjdhMzBiZWI1MjllYjU0Zg==');

		$request_parameters = array(
			'address' => $address->__toString(),
			'latitude' => $latitude->__toString(),
			'longitude' => $longitude->__toString(),
			'pub_id' => $pub_id->__toString(),
			'name' => $name->get_fist_name()->__toString()
			
		);

		$response = $request->send($header_parameters, $request_parameters);

		$data = $response->get_data();

		return $data->etb_id;
	}

	
}