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
		VO\Token $token,
		VO\Integer $organisation_id,
		VO\StringVO $name = null,
		VO\Integer $number_of_employees = null,
		VO\WebAddress $web_address = null ,
		VO\Email $email_address = null,
		VO\PhoneNumber $phone_number = null,
		VO\Address $address = null,
		VO\FaxNumber $fax_number = null,
		VO\TaxNumber $tax_number =  null,
		VO\CroNumber $cro_number = null,
		VO\StringVO $latitude = null,
		VO\StringVO $longitude = null,
		VO\StringVO $trade_name = null,
		VO\StringVO $date_of_commence = null,
		VO\StringVO $logo = null
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/edit/organisation'),
			new VO\HTTP\Method('PUT')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'organisation_id' => $organisation_id->__toInteger()
		);

		if($name) {
			$request_parameters['name'] = $name->__toString();
		}

		if($number_of_employees) {
			$request_parameters['number_of_employees'] = $number_of_employees->__toInteger();
		}

		if($web_address) {
			$request_parameters['web_address'] = $web_address->__toString();
		}

		if($email_address) {
			$request_parameters['email_address'] = $email_address->__toString();
		}

		if($phone_number) {
			$request_parameters['phone_number'] = $phone_number->__toString();
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

		if($trade_name) {
			$request_parameters['trade_name'] = $trade_name->__toString();
		}

		if($date_of_commence) {
			$request_parameters['date_of_commence'] = $date_of_commence->__toString();
		}

		if($logo) {
			$request_parameters['logo'] = $logo->__toString();
		}

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function create_base_member(
		VO\Token $token,
		VO\Integer $organisation_id,
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

		$header_parameters = array(
			'Authorization' => $token->__toEncodedString()
		);

		$request_parameters = array(
			'organisation_id' => $organisation_id->__toInteger(),
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString()
		);

		if($role) {
			$request_parameters['role'] = $role->__toString();
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
			$request_parameters['is_mentor'] = $is_mentor->__toInteger();
		}

		if($is_contact_person) {
			$request_parameters['is_contact_person'] = $is_contact_person->__toInteger();
		}

		if($is_verifier) {
			$request_parameters['is_verifier'] = $is_verifier->__toInteger();
		}

		if($send_email_to_set_password) {
			$request_parameters['send_email_to_set_password'] = $send_email_to_set_password->__toInteger();
		}

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function create_candidate(
		VO\Token $token,
		VO\Integer $organisation_id,
		VO\Integer $apprenticeship_id,
		VO\PublicID $pub_id,
		VO\StringVO $date_of_birth,
		VO\Name $name,
		VO\StringVO $gender,
		VO\StringVO $country_code,
		VO\StringVO $mobile_number,
		VO\Email $email,
		VO\Integer $disablility,
		VO\Integer $advice,
		VO\StringVO $street,
		VO\StringVO $city,
		VO\StringVO $state,
		VO\StringVO $country,
		VO\StringVO $postal_code,
		VO\StringVO $disablility_text = null,
		VO\StringVO $advice_text = null,
		VO\Integer $eye_test_document_id = null,
		VO\StringVO $eyetestdataimage = null,
		VO\Integer $mimimum_educational_document_id = null,
		VO\StringVO $minimumeducationaldataimage = null,
		VO\Integer $signature = null,
		VO\StringVO $signaturedataimage = null,
		VO\StringVO $image = null
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/create/candidate'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'organisation_id' => $organisation_id->__toInteger(),
			'apprenticeship_id' => $apprenticeship_id->__toInteger(),
			'pub_id' => $pub_id->__toString(),
			'date_of_birth' => $date_of_birth->__toString(),
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString(),
			'gender' => $gender->__toString(),
			'country_code' => $country_code->__toString(),
			'mobile_number' => $mobile_number->__toString(),
			'email' => $email->__toString(),
			'disablility' => $disablility->__toInteger(),
			'advice' => $advice->__toInteger(),
			'street' => $street->__toString(),
			'city' => $city->__toString(),
			'state' => $state->__toString(),
			'country' => $country->__toString(),
			'postal_code' => $postal_code->__toString()
		);

		if($disablility == '1') {
			$request_parameters['disablility_text'] = $disablility_text->__toString();
		}

		if($advice == '1') {
			$request_parameters['advice_text'] = $advice_text->__toString();
		}

		if($eye_test_document_id) {
			$request_parameters['eye_test_document_id'] = $eye_test_document_id->__toInteger();
			$request_parameters['eyetestdataimage'] = $eyetestdataimage->__toString();
		}

		if($mimimum_educational_document_id) {
			$request_parameters['mimimum_educational_document_id'] = $mimimum_educational_document_id->__toInteger();
			$request_parameters['minimumeducationaldataimage'] = $minimumeducationaldataimage->__toString();
		}

		if($signature) {
			$request_parameters['signature'] = $signature->__toInteger();
			$request_parameters['signaturedataimage'] = $signaturedataimage->__toString();
		}

		if($image) {
			$request_parameters['image'] = $image->__toString();
		}

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function edit_candidate(
		VO\Token $token,
		VO\Integer $member_id,
		VO\Integer $apprenticeship_id = null,
		VO\PublicID $pub_id = null,
		VO\StringVO $date_of_birth = null,
		VO\Name $name = null,
		VO\StringVO $gender = null,
		VO\StringVO $country_code = null,
		VO\StringVO $mobile_number = null,
		VO\Email $email = null,
		VO\Integer $is_approved_by_etb_ao = null,
		VO\Integer $is_approved_by_solas_admin = null,
		VO\StringVO $street = null,
		VO\StringVO $city = null,
		VO\StringVO $state = null,
		VO\StringVO $country = null,
		VO\StringVO $postal_code = null,
		VO\Integer $eye_test_document_id = null,
		VO\StringVO $eyetestdataimage = null,
		VO\Integer $mimimum_educational_document_id = null,
		VO\StringVO $minimumeducationaldataimage = null,
		VO\Integer $signature = null,
		VO\StringVO $signaturedataimage = null,
		VO\StringVO $image = null
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/edit/candidate'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'member_id' => $organisation_id->__toInteger()
		);

		if($apprenticeship_id) {
			$request_parameters['apprenticeship_id'] = $apprenticeship_id->__toInteger();
		}

		if($pub_id) {
			$request_parameters['pub_id'] = $pub_id->__toString();
		}

		if($date_of_birth) {
			$request_parameters['date_of_birth'] = $date_of_birth->__toString();
		}

		if($name) {
			$request_parameters['first_name'] = $name->get_first_name()->__toString();
			$request_parameters['last_name'] = $name->get_last_name()->__toString();
		}

		if($gender) {
			$request_parameters['gender'] = $gender->__toString();
		}

		if($country_code) {
			$request_parameters['country_code'] = $country_code->__toString();
		}

		if($email) {
			$request_parameters['email'] = $email->__toString();
		}

		if($is_approved_by_etb_ao) {
			$request_parameters['is_approved_by_etb_ao'] = $is_approved_by_etb_ao->__toInteger();
		}

		if($is_approved_by_solas_admin) {
			$request_parameters['is_approved_by_solas_admin'] = $is_approved_by_solas_admin->__toString();
		}

		if($street) {
			$request_parameters['street'] = $street->__toString();
		}

		if($city) {
			$request_parameters['city'] = $city->__toString();
		}

		if($state) {
			$request_parameters['state'] = $state->__toString();
		}

		if($country) {
			$request_parameters['country'] = $country->__toString();
		}

		if($postal_code) {
			$request_parameters['postal_code'] = $postal_code->__toString();
		}

		if($eye_test_document_id) {
			$request_parameters['eye_test_document_id'] = $eye_test_document_id->__toInteger();
			$request_parameters['eyetestdataimage'] = $eyetestdataimage->__toString();
		}

		if($mimimum_educational_document_id) {
			$request_parameters['mimimum_educational_document_id'] = $mimimum_educational_document_id->__toInteger();
			$request_parameters['minimumeducationaldataimage'] = $minimumeducationaldataimage->__toString();
		}

		if($signature) {
			$request_parameters['signature'] = $signature->__toInteger();
			$request_parameters['signaturedataimage'] = $signaturedataimage->__toString();
		}

		if($image) {
			$request_parameters['image'] = $image->__toString();
		}

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function get_candidates(
		VO\Token $token,
		VO\Integer $employer_id,
		VO\Integer $is_declined = null,
		VO\Integer $is_approved_by_etb_ao = null,
		VO\Integer $is_approved_by_solas_admin = null,
		VO\Integer $ato_id = null,
		VO\StringVO $order_by_field = null,
		VO\StringVO $order_by_direction = null
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/get/candidates'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'employer_id' => $employer_id->__toInteger()
		);

		if($is_declined) {
			$request_parameters['is_declined'] = $is_declined->__toInteger();
		}

		if($is_approved_by_etb_ao) {
			$request_parameters['is_approved_by_etb_ao'] = $is_approved_by_etb_ao->__toInteger();
		}

		if($is_approved_by_solas_admin) {
			$request_parameters['is_approved_by_solas_admin'] = $is_approved_by_solas_admin->__toInteger();
		}

		if($ato_id) {
			$request_parameters['ato_id'] = $ato_id->__toInteger();
		}

		if($order_by_field) {
			$request_parameters['order_by_field'] = $order_by_field->__toString();
		}

		if($order_by_direction) {
			$request_parameters['order_by_direction'] = $order_by_direction->__toString();
		}

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function fetch_un_registered_member(
		VO\Token $token,
		VO\OrganisationID $organisation_id
	)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/'.$organisation_id.'/list/unregistered'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function create_apprenticeship(
		VO\Token $token,
		VO\Integer $employer_id,
		VO\Integer $occupation_id,
		VO\Integer $sector_id,
		VO\Integer $main_activity_id,
		VO\Integer $industry_id,
		VO\Integer $number_of_qualified_person_in_occupation,
		VO\Integer $verifier_id,
		VO\Integer $contact_person_id,
		VO\Integer $mentor_id,
		VO\Integer $is_submitted = null,
		VO\Integer $is_approved = null,
		VO\Integer $is_declined = null,
		VO\Integer $is_site_visited = null
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/apprenticeship/create'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array(
			'Authorization' => $token->__toEncodedString()
		);

		$request_parameters = array(
			'employer_id' => $employer_id->__toInteger(),
			'occupation_id' => $occupation_id->__toInteger(),
			'sector_id' => $sector_id->__toInteger(),
			'main_activity_id' => $main_activity_id->__toInteger(),
			'industry_id' => $industry_id->__toInteger(),
			'number_of_qualified_person_in_occupation' => $number_of_qualified_person_in_occupation->__toInteger(),
			'verifier_id' => $verifier_id->__toInteger(),
			'contact_person_id' => $contact_person_id->__toInteger(),
			'mentor_id' => $mentor_id->__toInteger()
		);

		if($is_submitted) {
			$request_parameters['is_submitted'] = $is_submitted->__toInteger();
		}

		if($is_approved) {
			$request_parameters['is_approved'] = $is_approved->__toInteger();
		}

		if($is_declined) {
			$request_parameters['is_declined'] = $is_declined->__toInteger();
		}

		if($is_site_visited) {
			$request_parameters['is_site_visited'] = $is_site_visited->__toInteger();
		}

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function create_organisation_etb(
		VO\Token $token,
		VO\Integer $organisation_id,
		VO\Integer $etb_id
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/create/etb'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'organisation_id' => $organisation_id->__toInteger(),
			'etb_id' => $etb_id->__toInteger()
		);

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function get_organisation_etb(VO\Token $token, VO\OrganisationID $organisation_id) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/get/'.$organisation_id.'/etb'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function get_organisation(VO\Token $token, VO\OrganisationID $organisation_id) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/get/'.$organisation_id.'/organisation'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);
		
		$data = $response->get_data();

		return $data;
	}

	public function list_apprenticeships(
		VO\Token $token,
		VO\Integer $employer_id = null,
		VO\Integer $current_page = null,
		VO\Integer $occupation_id = null,
		VO\Integer $industry_id = null,
		VO\Integer $sector_id = null,
		VO\Integer $main_activity_id = null,
		VO\Integer $number_of_qualified_person_in_occupation = null,
		VO\Integer $contact_person_id = null,
		VO\Integer $verifier_id = null,
		VO\Integer $mentor_id = null,
		VO\Integer $is_submitted = null,
		VO\Integer $is_approved = null,
		VO\Integer $is_declined = null,
		VO\Integer $is_site_visited = null,
		VO\Integer $is_confirmed_as_occupation = null,
		VO\StringVO $order_by_field = null,
		VO\StringVO $order_by_direction = null
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/list/apprenticeships'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array();

		if($employer_id) {
			$request_parameters['employer_id'] = $employer_id->__toInteger();
		}

		if($current_page) {
			$request_parameters['current_page'] = $current_page->__toInteger();
		}

		if($occupation_id) {
			$request_parameters['occupation_id'] = $occupation_id->__toInteger();
		}

		if($industry_id) {
			$request_parameters['industry_id'] = $industry_id->__toInteger();
		}

		if($sector_id) {
			$request_parameters['sector_id'] = $sector_id->__toInteger();
		}

		if($main_activity_id) {
			$request_parameters['main_activity_id'] = $main_activity_id->__toInteger();
		}

		if($number_of_qualified_person_in_occupation) {
			$request_parameters['number_of_qualified_person_in_occupation'] = $number_of_qualified_person_in_occupation->__toInteger();
		}

		if($contact_person_id) {
			$request_parameters['contact_person_id'] = $contact_person_id->__toInteger();
		}

		if($verifier_id) {
			$request_parameters['verifier_id'] = $verifier_id->__toInteger();
		}

		if($mentor_id) {
			$request_parameters['mentor_id'] = $mentor_id->__toInteger();
		}

		if($is_submitted) {
			$request_parameters['is_submitted'] = $is_submitted->__toInteger();
		}

		if($is_approved) {
			$request_parameters['is_approved'] = $is_approved->__toInteger();
		}

		if($is_declined) {
			$request_parameters['is_declined'] = $is_declined->__toInteger();
		}

		if($is_site_visited) {
			$request_parameters['is_site_visited'] = $is_site_visited->__toInteger();
		}

		if($is_confirmed_as_occupation) {
			$request_parameters['is_confirmed_as_occupation'] = $is_confirmed_as_occupation->__toInteger();
		}

		if($order_by_field) {
			$request_parameters['order_by_field'] = $order_by_field->__toString();
		}

		if($order_by_direction) {
			$request_parameters['order_by_direction'] = $order_by_direction->__toString();
		}

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function get_nearest_etb(
		VO\Token $token,
		VO\StringVO $latitude,
		VO\StringVO $longitude
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/get/nearest/etb'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'latitude' => $latitude->__toString(),
			'longitude' => $longitude->__toString()
		);

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;

	}

	public function get_etb_admins(VO\Token $token, VO\EtbID $etb_id) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/get/etb/'.$etb_id.'/admins'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);
		
		$data = $response->get_data();

		return $data;
	}

	public function get_etb_authorizing_officer(VO\Token $token, VO\EtbID $etb_id) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/get/etb/'.$etb_id.'/authorizing/officer'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);
		
		$data = $response->get_data();

		return $data;
	}

	public function apprenticeship_details(VO\Token $token, VO\ApprenticeshipID $apprenticeship_id) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/apprenticeship/'.$apprenticeship.'/details'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(nill,$header_parameters);
		
		$data = $response->get_data();

		return $data;
	}

	public function edit_apprenticeship(
		VO\Token $token,
		VO\ApprenticeshipID $apprenticeship_id,
		VO\Integer $occupation_id = null,
		VO\Integer $industry_id = null,
		VO\Integer $sector_id = null,
		VO\Integer $main_activity_id = null,
		VO\Integer $number_of_qualified_person_in_occupation = null,
		VO\Integer $contact_person_id = null,
		VO\Integer $verifier_id = null,
		VO\Integer $mentor_id = null,
		VO\Integer $is_submitted = null,
		VO\Integer $is_approved = null,
		VO\Integer $is_declined = null,
		VO\Integer $is_site_visited = null,
		VO\Integer $is_confirmed_as_occupation = null,
		VO\Integer $is_appealed_to_solas_admin = null,
		VO\Integer $is_approved_by_solas_admin = null,
		VO\Integer $is_rejected_by_solas_admin = null,
		VO\Integer $is_site_visit_booked = null
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/apprenticeship/'.$apprenticeship_id.'/edit'),
			new VO\HTTP\Method('PUT')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		if($current_page) {
			$request_parameters['current_page'] = $current_page->__toInteger();
		}

		if($occupation_id) {
			$request_parameters['occupation_id'] = $occupation_id->__toInteger();
		}

		if($industry_id) {
			$request_parameters['industry_id'] = $industry_id->__toInteger();
		}

		if($sector_id) {
			$request_parameters['sector_id'] = $sector_id->__toInteger();
		}

		if($main_activity_id) {
			$request_parameters['main_activity_id'] = $main_activity_id->__toInteger();
		}

		if($number_of_qualified_person_in_occupation) {
			$request_parameters['number_of_qualified_person_in_occupation'] = $number_of_qualified_person_in_occupation->__toInteger();
		}

		if($contact_person_id) {
			$request_parameters['contact_person_id'] = $contact_person_id->__toInteger();
		}

		if($verifier_id) {
			$request_parameters['verifier_id'] = $verifier_id->__toInteger();
		}

		if($mentor_id) {
			$request_parameters['mentor_id'] = $mentor_id->__toInteger();
		}

		if($is_submitted) {
			$request_parameters['is_submitted'] = $is_submitted->__toInteger();
		}

		if($is_approved) {
			$request_parameters['is_approved'] = $is_approved->__toInteger();
		}

		if($is_declined) {
			$request_parameters['is_declined'] = $is_declined->__toInteger();
		}

		if($is_site_visited) {
			$request_parameters['is_site_visited'] = $is_site_visited->__toInteger();
		}

		if($is_confirmed_as_occupation) {
			$request_parameters['is_confirmed_as_occupation'] = $is_confirmed_as_occupation->__toInteger();
		}

		if($is_appealed_to_solas_admin) {
			$request_parameters['is_appealed_to_solas_admin'] = $is_appealed_to_solas_admin->__toInteger();
		}

		if($is_approved_by_solas_admin) {
			$request_parameters['is_approved_by_solas_admin'] = $is_approved_by_solas_admin->__toInteger();
		}

		if($is_rejected_by_solas_admin) {
			$request_parameters['is_rejected_by_solas_admin'] = $is_rejected_by_solas_admin->__toInteger();
		}

		if($is_site_visit_booked) {
			$request_parameters['is_site_visit_booked'] = $is_site_visit_booked->__toInteger();
		}

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function list_occupations(vo\Token $token)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/list/occupations'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function occupation_details(vo\Token $token, VO\Integer $occupation_id)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/occupation/'.$occupation_id.'/details'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function list_industries(vo\Token $token)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/list/industries'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function industry_details(vo\Token $token, VO\Integer $industry_id)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/industry/'.$industry_id.'/details'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function list_sectors(vo\Token $token)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/list/sectors'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function sector_details(vo\Token $token, VO\Integer $sector_id)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/sector/'.$sector_id.'/details'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function list_main_activities(vo\Token $token)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/list/main_activities'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function main_activity_details(vo\Token $token, VO\Integer $main_activity_id)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/main_activity/'.$main_activity_id.'/details'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function get_member_ids(vo\Token $token, VO\OrganisationID $organisation_id)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/get/org/'.$organisation_id.'/member/ids'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

    public function get_site_visits(vo\Token $token, VO\OrganisationID $organisation_id)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/get/org/'.$organisation_id.'/site_visits'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function apprenticeship_checklist(vo\Token $token, VO\ID $apprenticeship_id)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/get/apprenticeship/'.$apprenticeship_id.'/checklist'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function send_email_to_set_password(
		VO\Token $token,
		VO\Integer $member_id
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/candiate/registration'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array(
			'Authorization' => $token->__toEncodedString()
		);

		$request_parameters = array(
			'member_id' => $member_id->__toInteger()
		);

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function get_assessor_or_verifier(vo\Token $token, VO\OrganisationID $organisation_id)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/get/org/'.$organisation_id.'/assessor/or/verifier'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

}