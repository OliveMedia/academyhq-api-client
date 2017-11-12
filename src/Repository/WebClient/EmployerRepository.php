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
		VO\Name $name,
		VO\Username $username,
		VO\Email $email,
		VO\Password $password = null,
		VO\Password $password_confirmation = null,
		VO\ID $pub_id = null
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

		return $data->member_id;

	}

	public function create_sub_organisation(
		VO\Integer $number_of_employees,
		VO\StringVO $name,
		VO\WebAddress $web_address,
		VO\Email $email_address,
		VO\PhoneNumber $phone_number,
		VO\Address $address,
		VO\FaxNumber $fax_number
	){
	$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/employer/sub_organisation/create'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'number_of_employees' => $number_of_employees->__toInteger(),
			'name' => $name->__toString(),
			'web_address' => $web_address->__toString(),
			'email_address' => $email_address->__toString(),
			'address' => $address->__toString(),
			'fax_number' => $fax_number->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data->organisation_id;
	}
}