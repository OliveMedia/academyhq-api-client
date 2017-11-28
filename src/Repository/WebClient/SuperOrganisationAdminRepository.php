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
		VO\ID $pub_id,
		VO\StringVO $name,
		VO\StringVO $contact_person,
		VO\PhoneNumber $contact_number

	) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/super_organisation/etb/create'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'address' => $address->__toString(),
			'latitude' => $latitude->__toString(),
			'longitude' => $longitude->__toString(),
			'pub_id' => $pub_id->__toString(),
			'name' => $name->__toString(),
			'contact_person' => $contact_person->__toString(),
			'contact_number' => $contact_number->__toString()
			
		);

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function create_etb_admin(
		VO\Token $token,
		VO\Name $name,
		VO\Username $username,
		VO\Email $email,
		VO\ID $pub_id = null,
		VO\Password $password = null,
		VO\Password $password_confirmation = null
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/super_organisation/etb/admin/create'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString(),
			'username' => $username->__toString(),
			'email' => $email->__toString(),
			
		);

		if($pub_id) {
			$request_parameters['pub_id'] = $pub_id->__toString();
		}

		if($password) {
			$request_parameters['password'] = $password->__toString();
		}

		if($password_confirmation) {
			$request_parameters['password_confirmation'] = $password_confirmation->__toString();
		}

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function create_etb_authorizing_officer(
		VO\Token $token,
		VO\Name $name,
		VO\Username $username,
		VO\Email $email,
		VO\ID $pub_id = null,
		VO\Password $password = null,
		VO\Password $password_confirmation = null
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/super_organisation/etb/authorising/officer/create'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString(),
			'username' => $username->__toString(),
			'email' => $email->__toString(),
			
		);

		if($pub_id) {
			$request_parameters['pub_id'] = $pub_id->__toString();
		}

		if($password) {
			$request_parameters['password'] = $password->__toString();
		}

		if($password_confirmation) {
			$request_parameters['password_confirmation'] = $password_confirmation->__toString();
		}

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}


}