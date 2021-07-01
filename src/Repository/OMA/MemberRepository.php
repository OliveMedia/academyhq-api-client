<?php

namespace AcademyHQ\API\Repository\OMA;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;

class MemberRepository extends BaseRepository {

	public function __construct(Credentials $credentials)
	{
		parent::__construct();
		$this->credentials = $credentials;
		$this->base_url .= '/oma';
	}


	public function reset_member_by_email_or_username(
		VO\Email $email = null,
		VO\Username $userName = null
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/reset/member/by/email/or/username'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array();

		if(isset($email)) {
			$request_parameters['email'] = $email->__toEncodedString();
		}

		if(isset($userName)) {
			$request_parameters['userName'] = $userName->__toEncodedString();
		}

		$response = $request->send($request_parameters, null);

		$data = $response->get_data();

		return $data;
	}

	public function reset_password_by_member_id(
		VO\MemberID $member_id
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/reset/password/by/member_id'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'member_id' => $member_id->__toString()
		);

		$response = $request->send($request_parameters, null);

		$data = $response->get_data();

		return $data;
	}

	public function reset_member_by_email_and_organisation(
		VO\Email $email,
		VO\OrganisationID $organisation_id
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/reset/member/by/email/and/organisation'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'email' => $email->__toEncodedString(),
			'organisation_id' => $organisation_id->__toString()
		);

		$response = $request->send($request_parameters, null);

		$data = $response->get_data();

		return $data;
	}

	public function reset_password_by_hash_key_and_password(
		VO\Token $hash_key = null,
		VO\Password $password = null,
		VO\Password $password_confirm = null
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/reset/password/by/hash_key/and/password'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array();

		if(isset($hash_key)) {
			$request_parameters['hash_key'] = $hash_key->__toEncodedString();
		}

		if(isset($password)) {
			$request_parameters['password'] = $password->__toEncodedString();
		}

		if(isset($password_confirm)) {
			$request_parameters['password_confirm'] = $password_confirm->__toEncodedString();
		}
		$response = $request->send($request_parameters, null);

		$data = $response->get_data();

		return $data;
	}

	/**
	 * Get the details of the members
	 * @param VO\IDArray $member_ids
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function base_member_alt(VO\IDArray $member_ids)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/member/details/base_alt'),
			new VO\HTTP\Method('POST')
		);
		$request_parameters = array(
			'member_ids'                => $member_ids->__toArray()
		);
		$response = $request->send($request_parameters, null);
		$data = $response->get_data();
		return $data;
	}


}
