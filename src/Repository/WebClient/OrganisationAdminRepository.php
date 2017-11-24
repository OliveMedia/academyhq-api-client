<?php

namespace AcademyHQ\API\Repository\WebClient;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class OrganisationAdminRepository {

	private $base_url = 'https://api.academyhq.com/api/v2/web/client';

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function edit_organisation(
		VO\Token $token
		VO\StringVO $name,
		VO\Integer $number_of_employees = null,
		VO\WebAddress $web_address = null ,
		VO\Email $email_address = null,
		VO\PhoneNumber $phone_number = null,
		VO\Address $address = null,
		VO\FaxNumber $fax_number = null,
		VO\TaxNumber $tax_number =  null,
		VO\CroNumber $cro_number = null,
		VO\StringVO $latitude = null,
		VO\StringVO $longitude = null
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/edit/organisation'),
			new VO\HTTP\Method('PUT')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'name' => $name->__toString(),
		);

		if($number_of_employees) {
			$request_parameters['number_of_employees'] = $number_of_employees->__toString();
		}

		if($web_address) {
			$request_parameters['web_address'] = $web_address->__toString();
		}

		if($email_address) {
			$request_parameters['email_address'] = $email_address->__toString();
		}

		if($address) {
			$request_parameters['address'] = $address->__toString();
		}
		
		if($fax_number) {
			$request_parameters['fax_number'] = $fax_number->__toString();
		}

		if($tax_number) {
			$request_parameters['tax_number'] = $tax_number->__toString();
		}

		if($cro_number) {
			$request_parameters['cro_number'] = $cro_number->__toString();
		}

		if($latitude) {
			$request_parameters['latitude'] = $latitude->__toString();
		}

		if($longitude) {
			$request_parameters['longitude'] = $longitude->__toString();
		}

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data->organisation_id;
	}

	public function create_base_member(
		VO\Token $token
		VO\Name $name,
		VO\StringVO $role = null,
		VO\StringVO $qualification = null ,
		VO\StringVO $occupation = null,
		VO\StringVO $comment = null,
		VO\Email $email = null,
		VO\PublicID $pub_id = null,
		VO\Integer $is_mentor =  null,
		VO\Integer $is_contact_person = null,
		VO\Integer $is_verifier = null,
		VO\Integer $send_email_to_set_password = null
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/create/base/member'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'name' => $name->__toString(),
		);

		if($number_of_employees) {
			$request_parameters['number_of_employees'] = $number_of_employees->__toString();
		}

		if($qualification) {
			$request_parameters['qualification'] = $qualification->__toString();
		}

		if($occupation) {
			$request_parameters['occupation'] = $occupation->__toString();
		}

		if($comment) {
			$request_parameters['comment'] = $comment->__toString();
		}
		
		if($email) {
			$request_parameters['email'] = $email->__toString();
		}

		if($pub_id) {
			$request_parameters['pub_id'] = $pub_id->__toString();
		}

		if($is_mentor) {
			$request_parameters['is_mentor'] = $is_mentor->__toString();
		}

		if($is_contact_person) {
			$request_parameters['is_contact_person'] = $is_contact_person->__toString();
		}

		if($is_verifier) {
			$request_parameters['is_verifier'] = $is_verifier->__toString();
		}

		if($send_email_to_set_password) {
			$request_parameters['send_email_to_set_password'] = $send_email_to_set_password->__toString();
		}

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data->organisation_id;
	}
}