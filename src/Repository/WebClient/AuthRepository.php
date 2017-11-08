<?php

namespace AcademyHQ\API\Repository\WebClient;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class AuthRepository {

	private $base_url = 'https://api.academyhq.com/api/v2/web/client';

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function login(
		VO\Username $username,
		VO\Password $password
	) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/auth/login'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'username' => $username->__toEncodedString(),
			'password' => $password->__toEncodedString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data->token;
	}
}