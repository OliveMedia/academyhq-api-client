<?php

namespace AcademyHQ\API\Repository\Adecco;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;

class AdeccoAuthApiRepository extends BaseRepository {

	public function __construct(Credentials $credentials)
	{
		parent::__construct();
		$this->credentials = $credentials;
		// $this->base_url .= '/web/client';
	}

	public function login_from_email(
		VO\Email $email,
		VO\Password $password
	) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/onscensus/client/auth/login/from/email'),
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

	public function login_from_username(
		VO\Username $username,
		VO\Password $password

	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/onscensus/client/auth/login/from/username'),
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

	public function logout(VO\Token $token) 
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/onscensus/client/auth/logout'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array();

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function reset_learner_password_via_username(
		VO\Username $username
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/onscensus/reset/member/password'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'username' => $username->__toEncodedString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}


	public function reset_learner_password_via_email(
		VO\Email $email
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/onscensus/reset/member/password'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'email' => $email->__toEncodedString(),
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}


	public function set_reset_learner_password(
		VO\Token $token,
		VO\Password $password,
		VO\Password $confirm_password
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/onscensus/reset/member/password/by/hash_key'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'hash_key' 			=> $token->__toEncodedString(),
			'password' 			=> $password->__toEncodedString(),
			'password_confirm' 	=> $confirm_password->__toEncodedString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}
}