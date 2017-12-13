<?php

namespace AcademyHQ\API\Repository\WebClient;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class LearnerRepository {

	private $base_url = 'https://api.academyhq.com/api/v2/web/client';
	
	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function member_documents(VO\Token $token)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/learner/member/documents'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function member_document_details(VO\Token $token, VO\MemberDocuementID $member_document_id)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/learner/member/document/'.$member_document_id.'/details'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function documents_list(VO\Token $token)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/learner/organisation/documents/list'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);

		$data = $response->get_data();

		return $data;
	}
	
	public function required_document_list(VO\Token $token)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/learner/organisation/required/documents/list'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function member_enrolment_certificate(VO\Token $token, VO\EnrolmentID $enrolment_id)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/learner/ennrolment/'.$enrolment_id.'/certificate/get'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function certificates(VO\Token $token)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/learner/certificates/get'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function download_certificate(VO\Token $token, VO\MemberCertificateID $member_certificate_id)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/learner/certificate/'.$member_certificate_id.'/download'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function profile_update(
		VO\Token $token,
		VO\PublicID $pub_id = null,
		VO\Name $name = null,
		VO\Email $email = null,
		VO\PhoneNumber $mobile_number = null,
		VO\StringVO $date_of_birth = null,
		VO\StringVO $gender = null,
		VO\StringVO $country = null,
		VO\StringVO $state = null,
		VO\StringVO $city = null,
		VO\StringVO $street = null,
		VO\StringVO $postal_code = null,
		VO\StringVO $image = null
	)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/learner/profile/update'),
			new VO\HTTP\Method('PUT')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		if($pub_id) {
			$request_parameters['pub_id'] = $pub_id->__toString();
		}

		if($name) {
			$request_parameters['first_name'] = $name->get_first_name()->__toString();
			$request_parameters['last_name'] = $name->get_last_name()->__toString();
		}

		if($email) {
			$request_parameters['email'] = $email->__toString();
		}

		if($mobile_number) {
			$request_parameters['mobile_number'] = $mobile_number->__toString();
		}

		if($date_of_birth) {
			$request_parameters['date_of_birth'] = $date_of_birth->__toString();
		}

		if($gender) {
			$request_parameters['gender'] = $gender->__toString();
		}

		if($country) {
			$request_parameters['country'] = $country->__toString();
		}

		if($state) {
			$request_parameters['state'] = $state->__toString();
		}

		if($city) {
			$request_parameters['city'] = $city->__toString();
		}

		if($street) {
			$request_parameters['street'] = $street->__toString();
		}

		if($postal_code) {
			$request_parameters['postal_code'] = $postal_code->__toString();
		}

		if($image) {
			$request_parameters['image'] = $image->__toString();
		}

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data->member_id;

	}

	public function get_profile(VO\Token $token)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/learner/get/profile'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);

		$data = $response->get_data();

		return $data->member_profile_details;
	}

	public function enrolment_launch_url(VO\Token $token, VO\EnrolmentID $enrolment_id)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/learner/get/enrolment/'.$enrolment_id.'/launch/url'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);

		$data = $response->get_data();

		return $data->member_profile_details;
	}

	public function enrolment_callback(VO\Token $token, VO\EnrolmentID $enrolment_id)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/learner/get/enrolment/'.$enrolment_id.'/callback'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);

		$data = $response->get_data();

		return $data->member_profile_details;
	}

	public function get_member(VO\Token $token, VO\MemberID $member_id)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/learner/get/member/'.$member_id),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);

		$data = $response->get_data();

		return $data->member_profile_details;
	}
}