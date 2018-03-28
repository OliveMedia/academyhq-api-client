<?php

namespace AcademyHQ\API\Repository\WebClient;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;


class AuthRepository extends BaseRepository{

	private function get_url(){		
		return $this->base_url.'/web/client';
	}

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
			VO\HTTP\Url::fromNative($this->get_url().'/auth/login'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'username' => $username->__toEncodedString(),
			'password' => $password->__toEncodedString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function login_from_email(
		VO\Email $email,
		VO\Password $password
	) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/auth/login/from/email'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'email' => $email->__toEncodedString(),
			'password' => $password->__toEncodedString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function logout(VO\Token $token) 
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/auth/logout'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array();

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}
}