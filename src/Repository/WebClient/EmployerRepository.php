<?php

namespace AcademyHQ\API\Repository\WebClient;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class EmployerRepository {

	private $base_url = 'https://api.academyhq.com/api/v2/web/client';

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function create_sub_organisation_admin(
		VO\ID $id,
		VO\Name $name,
		VO\Username $username,
		VO\Email $email,
		VO\Password $password = null,
		VO\Password $password_confirmation = null,
		VO\PublicID $pub_id = null
	){
		$sub_org_id = $id->__toString();
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/employer/sub_organisation/'.$sub_org_id.'/admin/create'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString(),
			'username' => $username->__toString(),
			'email' => $email->__toString()
			
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

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;

	}

	public function create_sub_organisation(
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
		VO\StringVO $longitude = null,
		VO\StringVO $trade_name = null,
		VO\StringVO $date_of_commence = null
	){
	$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/employer/sub_organisation/create'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'name' => $name->__toString(),
		);

		if($number_of_employees) {
			$request_parameters['number_of_employees'] = $number_of_employees->__toInteger();
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

		if($trade_name) {
			$request_parameters['trade_name'] = $trade_name->__toString();
		}

		if($date_of_commence) {
			$request_parameters['date_of_commence'] = $date_of_commence->__toString();
		}


		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function create_sub_organisation_inherit_domain(
		VO\PublicID $pub_id,
		VO\Integer $number_of_employees,
		VO\StringVO $name
	){
	$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/employer/sub_organisation/create/inherit/domain'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'pub_id' => $pub_id->__toString(),
			'number_of_employees' => $number_of_employees->__toInteger(),
			'name' => $name->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function create_apprenticeship_organisation(
		VO\StringVO $company_name,
		VO\TaxNumber $tax_number,
		VO\Name $name,
		VO\Email $email,
		VO\StringVO $trade_name = null,
		VO\StringVO $date_of_commence = null 
	){
	$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/employer/create/apprenticeship/organisation'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'name' => $company_name->__toString(),
			'tax_number' => $tax_number->__toString(),
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString(),
			'email' => $email->__toString()
		);

		if($trade_name) {
			$request_parameters['trade_name'] = $trade_name->__toString();
		}

		if($date_of_commence) {
			$request_parameters['date_of_commence'] = $date_of_commence->__toString();
		}

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function registration_completion_for_admin(
		VO\MemberID $member_id,
		VO\Name $name,
		VO\Password $password,
		VO\Password $password_confirmation
	){
	$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/employer/admin/registration/completion'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'member_id' => $member_id->__toString(),
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString(),
			'password' => $password->__toString(),
			'password_confirmation' => $password_confirmation->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function base_member(VO\MemberID $member_id) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/employer/base/member/'.$member_id.'/get'),
			new VO\HTTP\Method('GET')
		);

		$response = $request->send();

		$data = $response->get_data();

		return $data;
	}

	public function registration_completion_for_candidate(
		VO\MemberID $member_id,
		VO\Name $name,
		VO\Password $password,
		VO\Password $password_confirmation
	){
	$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/employer/candidate/registration/completion'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'member_id' => $member_id->__toString(),
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString(),
			'password' => $password->__toString(),
			'password_confirmation' => $password_confirmation->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function create_sub_org_admin(
		VO\OrganisationID $organisation_id,
		VO\CourseID $course_id,
		VO\Name $name,
		VO\Email $email
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/employer/create/sub_org/admin'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'organisation_id' => $organisation_id->__toInteger(),
			'course_id' => $course_id->__toInteger(),
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString(),
			'email' => $email->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;

	}
}