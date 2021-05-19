<?php

namespace AcademyHQ\API\Repository\WebClient;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;

class AuthRepository extends BaseRepository {

	public function __construct(Credentials $credentials)
	{
		parent::__construct();
		$this->credentials = $credentials;
		$this->base_url .= '/web/client';
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

		return $data;
	}

	public function login_cross_organisation(
		VO\Username $username,
		VO\Password $password
	) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/auth/login/cross-organisation'),
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

	public function login_to_academy(
		VO\Username $username,
		VO\Password $password
	) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/auth/login/academy'),
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
			VO\HTTP\Url::fromNative($this->base_url.'/auth/login/from/email'),
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

	public function login_from_duplicate_email(
		VO\Email $email,
		VO\Password $password,
		VO\Integer $organisationId
	) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/auth/login/from/duplicate/email'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'email' => $email->__toEncodedString(),
			'password' => $password->__toEncodedString(),
			'organisation_id' => $organisationId->__toInteger()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function login_from_email_cross_organisation(
		VO\Email $email,
		VO\Password $password
	) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/auth/login/from/email/cross-organisation'),
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
			VO\HTTP\Url::fromNative($this->base_url.'/auth/logout'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array();

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function fetch_members_with_email(
		VO\Email $email
	) 
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/auth/fetch-members-with-email'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'email' => $email->__toEncodedString(),
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}
	public function login_member_with_id_and_password(
		VO\MemberID $member_id,
		VO\Password $password
	) 
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/auth/login-member-with-id-and-password'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'member_id' => $member_id->__toString(),
			'password' => $member_id->__toEncodedString(),
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}
}