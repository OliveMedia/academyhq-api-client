<?php

namespace AcademyHQ\API\Repository\WebClient;

use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\HTTP\Request\Request as Request;
use AcademyHQ\API\Repository\BaseRepository;
use AcademyHQ\API\ValueObjects as VO;
use Guzzle\Http\Client as GuzzleClient;

class GDPRRepository extends BaseRepository {

	public function __construct(Credentials $credentials)
	{
		parent::__construct();
		$this->credentials = $credentials;
		$this->base_url .= '/web/client';
	}

	public function sub_org_create_inherit_domain(
		VO\StringVO $name
	){
	$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/gdpr/create/sub_org/inherit/domain'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'name' => $name->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function create_partner_with_apis(
		VO\StringVO $name
	){
	$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/gdpr/create/partner'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'name' => $name->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	} 

	public function create_sub_org_admin(
		VO\OrganisationID $organisation_id,
		VO\Name $name,
		VO\Email $email
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/gdpr/create/sub_org/admin'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString(),
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString(),
			'email' => $email->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;

	}

	public function create_license(
		VO\OrganisationID $organisation_id,
		VO\CourseID $course_id,
		VO\MemberID $admin_id,
		VO\Integer $number_of_license,
		VO\StringVO $price,
		VO\StringVO $currency,
		VO\StringVO $vat_rate,
		VO\StringVO $vat_number,
		VO\StringVO $address_line_one,
		VO\StringVO $address_line_two,
		VO\StringVO $city,
		VO\StringVO $postal_code,
		VO\StringVO $country
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/gdpr/create/license'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString(),
			'course_id' => $course_id->__toString(),
			'admin_id' => $admin_id->__toString(),
			'number_of_license' => $number_of_license->__toInteger(),
			'price' => $price->__toString(),
			'currency' => $currency->__toString(),
			'vat_rate' => $vat_rate->__toString(),
			'vat_number' => $vat_number->__toString(),
			'address_line_one' => $address_line_one->__toString(),
			'address_line_two' => $address_line_two->__toString(),
			'city' => $city->__toString(),
			'postal_code' => $postal_code->__toString(),
			'country' => $country->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;

	}

	public function create_licenses(
		VO\OrganisationID $organisation_id,
		VO\CourseIDArray $course_ids,
		VO\MemberID $admin_id,
		VO\Integer $number_of_license,
		VO\StringVO $price,
		VO\StringVO $unit_price,
		VO\StringVO $discount,
		VO\StringVO $currency,
		VO\StringVO $vat_rate,
		VO\StringVO $vat_number
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/gdpr/create/licenses'),
			new VO\HTTP\Method('POST')
		);

		$course_ids = $course_ids->__toArray();

		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString(),
			'course_ids' => $course_ids,
			'admin_id' => $admin_id->__toString(),
			'number_of_license' => $number_of_license->__toInteger(),
			'price' => $price->__toString(),
			'unit_price' => $unit_price->__toString(),
			'discount' => $discount->__toString(),
			'currency' => $currency->__toString(),
			'vat_rate' => $vat_rate->__toString(),
			'vat_number' => $vat_number->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;

	}

	public function create_license_new(
		VO\OrganisationID $organisation_id,
		VO\CourseID $course_id,
		VO\MemberID $admin_id,
		VO\Integer $number_of_license,
		VO\StringVO $price,
		VO\StringVO $currency,
		VO\StringVO $vat_rate,
		VO\StringVO $vat_number
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/gdpr/create/newlicense'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString(),
			'course_id' => $course_id->__toString(),
			'admin_id' => $admin_id->__toString(),
			'number_of_license' => $number_of_license->__toInteger(),
			'price' => $price->__toString(),
			'currency' => $currency->__toString(),
			'vat_rate' => $vat_rate->__toString(),
			'vat_number' => $vat_number->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;

	}

	public function create_license_for_individual(
		VO\OrganisationID $organisation_id,
		VO\CourseID $course_id,
		VO\MemberID $admin_id,
		VO\Integer $number_of_license,
		VO\StringVO $price,
		VO\StringVO $currency,
		VO\StringVO $vat_rate,
		VO\StringVO $vat_number,
		VO\StringVO $address_line_one,
		VO\StringVO $address_line_two,
		VO\StringVO $city,
		VO\StringVO $postal_code,
		VO\StringVO $country
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/gdpr/create/license/for/individual'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString(),
			'course_id' => $course_id->__toString(),
			'admin_id' => $admin_id->__toString(),
			'number_of_license' => $number_of_license->__toInteger(),
			'price' => $price->__toString(),
			'currency' => $currency->__toString(),
			'vat_rate' => $vat_rate->__toString(),
			'vat_number' => $vat_number->__toString(),
			'address_line_one' => $address_line_one->__toString(),
			'address_line_two' => $address_line_two->__toString(),
			'city' => $city->__toString(),
			'postal_code' => $postal_code->__toString(),
			'country' => $country->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;

	}

	public function create_member(
		VO\OrganisationID $organisation_id,
		VO\Name $name,
		VO\Email $email
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/gdpr/create/member'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString(),
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString(),
			'email' => $email->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function create_enrolment(
		VO\MemberID $member_id,
		VO\CourseID $course_id,
		VO\Flag $send_email = null
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/gdpr/create/enrolment'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'member_id' => $member_id->__toString(),
			'course_id' => $course_id->__toString()
		);

		if($send_email) {
			$request_parameters['send_email'] = $send_email->__toBool();
		}

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function check_license(VO\LicenseID $id){
		$license_id = $id->__toString();
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/gdpr/is/license/'.$license_id.'/available'),
			new VO\HTTP\Method('GET')
		);

		$response = $request->send();

		$data = $response->get_data();

		return $data; 
	}

	public function rollback(
		VO\MemberID $member_id,
		VO\OrganisationID $organisation_id
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/gdpr/rollback'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'member_id' => $member_id->__toString(),
			'organisation_id' => $organisation_id->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function rollback_member(
		VO\MemberID $member_id
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/gdpr/member/rollback'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'member_id' => $member_id->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function vat_validate(
		VO\StringVO $country_code,
		VO\StringVO $vat_number,
		VO\StringVO $organisation_name
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/gdpr/validate/vat_number'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'country_code' => $country_code->__toString(),
			'vat_number' => $vat_number->__toString(),
			'organisation_name'=>$organisation_name->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;

	}

}