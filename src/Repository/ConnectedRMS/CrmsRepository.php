<?php

namespace AcademyHQ\API\Repository\ConnectedRMS;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;

class CrmsRepository extends BaseRepository{

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;

	}
	
	private function get_url(){
		return $this->base_url.'/crms';
	}


	public function create_client(
		VO\StringVO $name,
		VO\StringVO $domain
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/create/client'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'name' => $name->__toString(),
			'domain' => $domain->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function get_courses(
		VO\StringVO $search=null,
		VO\Integer $current_page
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/courses/get'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'search' => $search ? $search->__toString() : '',
			'current_page' => $current_page->__toInteger()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function create_course(
		VO\StringVO $name,
		VO\StringVO $description,
		VO\StringVO $image_url = null
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/create/course'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'name' => $name->__toString(),
			'description' => $description->__toString(),
			'image_url' => $image_url ? $image_url->__toString() : '',
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function find_license(
		VO\OrganisationID $organisation_id,
		VO\CourseID $course_id
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/find/license'),
			new VO\HTTP\Method('post')
		);
		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString(),
			'course_id' => $course_id->__toString()
		);
		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function find_org_package(
		VO\OrganisationID $organisation_id,
		VO\ID $package_id
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/find/org_package'),
			new VO\HTTP\Method('post')
		);
		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString(),
			'package_id' => $package_id->__toString()
		);
		$response = $request->send($request_parameters);
		$data = $response->get_data();

		return $data;
	}

	public function get_organisations(
		VO\Integer $current_page,
		VO\Integer $per_page = null,
		VO\StringVO $search = null
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/organisations/get'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'current_page' => $current_page->__toInteger()
		);

		if(!is_null($per_page)){
			$request_parameters['per_page'] = $per_page->__toInteger();
		}

		if(!is_null($search)){
			$request_parameters['search'] = $search->__toString();
		}

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function get_packages(
		// VO\StringVO $search=null,
		// VO\Integer $current_page
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/packages/get'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			// 'search' => $search ? $search->__toString() : '',
			// 'current_page' => $current_page->__toInteger()
		);

		// $response = $request->send($request_parameters);
		$response = $request->send(array());
		$data = $response->get_data();

		return $data;
	}
	
	public function create_org_admin(
		VO\OrganisationID $organisation_id,
		VO\Name $name,
		VO\Email $email
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/create/org/admin'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString(),
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString(),
			'email' => $email->__toString()
		);

		// dd($request);
		$response = $request->send($request_parameters);
		$data = $response->get_data();

		return $data;

	}

	public function get_all_courses(
		VO\Integer $current_page=null,
		VO\Integer $per_page=null

	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/courses/get'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'current_page' => $current_page->__toInteger(),
			'per_page' => $per_page->__toInteger()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function fetch_organisation_api(VO\OrganisationID $organisation_id){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/fetch/org/api'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function rollback(
		VO\MemberID $member_id=null,
		VO\OrganisationID $organisation_id
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/rollback/member/org'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'member_id' => $member_id ? $member_id->__toString() : '',
			'organisation_id' => $organisation_id->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function update_organisation_subscription(
		VO\OrganisationID $organisation_id,
		VO\ID $subscription_id = null,
		VO\CourseIDArray $subscription_courses,
		VO\CourseIDArray $subscription_bundles,
		VO\Integer $max_enrolments,
		VO\Integer $max_licenses,
		VO\Integer $max_members
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/update/organisation_subscription'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'subscription_id' => $subscription_id ? $subscription_id->__toString() : '',
			'organisation_id' => $organisation_id->__toString(),
			'subscription_courses' => $subscription_courses->__toArray(),
			'subscription_bundles' => $subscription_bundles->__toArray(),
			'max_enrolments' => $max_enrolments->__toInteger(),
			'max_licenses' => $max_licenses->__toInteger(),
			'max_members' => $max_members->__toInteger()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function delete_organisation_subscription(
		VO\OrganisationID $organisation_id,
		VO\ID $subscription_id = null,
		VO\CourseIDArray $subscription_courses,
		VO\CourseIDArray $subscription_bundles,
		VO\Integer $max_enrolments,
		VO\Integer $max_licenses,
		VO\Integer $max_members
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/delete/organisation_subscription'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'subscription_id' => $subscription_id ? $subscription_id->__toString() : '',
			'organisation_id' => $organisation_id->__toString(),
			'subscription_courses' => $subscription_courses->__toArray(),
			'subscription_bundles' => $subscription_bundles->__toArray(),
			'max_enrolments' => $max_enrolments->__toInteger(),
			'max_licenses' => $max_licenses->__toInteger(),
			'max_members' => $max_members->__toInteger()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function transfer_member(
		VO\OrganisationID $organisation_id,
		VO\Name $name,
		VO\Email $email,
		VO\Integer $is_admin
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/create/member'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString(),
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString(),
			'email' => $email->__toString(),
			'is_admin' => $is_admin->__toInteger()
		);

		$response = $request->send($request_parameters);
		$data = $response->get_data();

		return $data;

	}

	public function member_enrolment_to_course(
		VO\CourseID $course_id,
		VO\MemberID $member_id
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/create/member/course/enrolment'),
			new VO\HTTP\Method('POST')
		);
		$request_parameters = array(
			'course_id' => $course_id->__toString(),
			'member_id' => $member_id->__toString()
		);

		$response = $request->send($request_parameters);
		$data = $response->get_data();

		return $data;

	}

	public function member_enrolment_to_package(
		VO\ID $package_id,
		VO\MemberID $member_id
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/create/member/package/enrolment'),
			new VO\HTTP\Method('POST')
		);
		$request_parameters = array(
			'package_id' => $package_id->__toString(),
			'member_id' => $member_id->__toString()
		);
		
		$response = $request->send($request_parameters);
		$data = $response->get_data();

		return $data;

	}

	public function get_all_members_id(VO\OrganisationID $org_id)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/get/all/members/id/'.$org_id->__toString()),
			new VO\HTTP\Method('GET')
		);

		$response = $request->send();

		$data = $response->get_data();

		return $data;
	}

	public function create_member_and_enroll(
		VO\OrganisationID $organisation_id,
		VO\Name $name,
		VO\Email $email,
		VO\Integer $is_admin = null,
		VO\StringVO $token = null
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/create/member/enroll_to/package'),
			new VO\HTTP\Method('post')
		);

		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString(),
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString(),
			'email' => $email->__toString()			
		);

		if(!is_null($is_admin)){
			$request_parameters['is_admin'] = $is_admin->__toInteger();
		}

		if(!is_null($token)){
			$request_parameters['token'] = $token->__toString();
		}

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function get_organisation_details(VO\OrganisationID $organisation_id){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/organisation/'.$organisation_id->__toString().'/details'),
			new VO\HTTP\Method('get')
		);
		$response = $request->send();

		$data = $response->get_data();

		return $data;
	}

	public function third_party_member_create(
		VO\OrganisationID $organisation_id,
		VO\Name $name,
		VO\Email $email,
		VO\Username $username,
		VO\Integer $is_admin,
		VO\PublicID $pub_id = null,
		VO\Password $password = null,
		VO\Integer $mobile_number = null,
		VO\StringVO $street = null,
		VO\StringVO $city = null,
		VO\StringVO $state = null,
		VO\StringVO $country = null ,
		VO\StringVO $postal_code = null
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/thirdParty/member/create'),
			new VO\HTTP\Method('post')
		);

		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString(),
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString(),
			'email' => $email->__toString(),
			'username' => $username->__toString(),
			'is_admin' => $is_admin->__toInteger()
		);

		if(!is_null($pub_id)){
			$request_parameters['pub_id'] = $pub_id->__toString();
		}

		if(!is_null($password)){
			$request_parameters['password'] = $password->__toString();
		}

		if(!is_null($mobile_number)){
			$request_parameters['mobile_number'] = $mobile_number->__toInteger();
		}

		if(!is_null($street)){
			$request_parameters['street'] = $street->__toString();
		}

		if(!is_null($city)){
			$request_parameters['city'] = $city->__toString();
		}

		if(!is_null($state)){
			$request_parameters['state'] = $state->__toString();
		}

		if(!is_null($country)){
			$request_parameters['country'] = $country->__toString();
		}

		if(!is_null($postal_code)){
			$request_parameters['postal_code'] = $postal_code->__toString();
		}

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function third_party_member_edit(
		VO\OrganisationID $organisation_id,
		VO\PublicID $pub_id,
		VO\Name $name = null,
		VO\Email $email = null ,
		VO\Username $username =null,
		VO\Integer $is_admin = null,
		VO\Password $password = null,
		VO\Integer $mobile_number = null,
		VO\Integer $is_deleted = null,
		VO\StringVO $street = null,
		VO\StringVO $city = null,
		VO\StringVO $state = null,
		VO\StringVO $country = null ,
		VO\StringVO $postal_code = null
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/thirdParty/member/edit'),
			new VO\HTTP\Method('post')
		);

		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString(),
			'pub_id' => $pub_id->__toString()
		);

		if(!is_null($name)){
			$request_parameters['first_name'] = $name->get_first_name()->__toString();
			$request_parameters['last_name'] = $name->get_last_name()->__toString();
		}

		if(!is_null($email)){
			$request_parameters['email'] = $email->__toString();

		}

		if(!is_null($username)){
			$request_parameters['username'] = $username->__toString();

		}

		if(!is_null($is_admin)){
			$request_parameters['is_admin'] = $is_admin->__toInteger();

		}

		if(!is_null($is_deleted)){
			$request_parameters['is_deleted'] = $is_deleted->__toInteger();

		}

		if(!is_null($password)){
			$request_parameters['password'] = $password->__toString();
		}

		if(!is_null($mobile_number)){
			$request_parameters['mobile_number'] = $mobile_number->__toInteger();
		}

		if(!is_null($street)){
			$request_parameters['street'] = $street->__toString();
		}

		if(!is_null($city)){
			$request_parameters['city'] = $city->__toString();
		}

		if(!is_null($state)){
			$request_parameters['state'] = $state->__toString();
		}

		if(!is_null($country)){
			$request_parameters['country'] = $country->__toString();
		}

		if(!is_null($postal_code)){
			$request_parameters['postal_code'] = $postal_code->__toString();
		}

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function third_party_member_fetch(
		VO\OrganisationID $organisation_id,
		VO\PublicID $pub_id){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/thirdParty/member/fetch'),
			new VO\HTTP\Method('post')
		);

		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString(),
			'pub_id' => $pub_id->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;

	}

	public function classroom_courses_details(
		VO\CourseIDArray $courses_ids
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/classroom/courses/details'),
			new VO\HTTP\Method('post')
		);

		$request_parameters = array(
			'courses_ids' => $courses_ids->__toArray(),
			
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}
	
	public function create_organisation_and_admin(
		VO\StringVO $organisation_name,
		VO\StringVO $domain,
		VO\Email $email,
		VO\Name $name,
		VO\StringVO $contact_number = null,
		VO\StringVO $billing_address = null,
		VO\StringVO $tax_code = null,
		VO\StringVO $company_website = null,
		VO\StringVO $branding_logo_url = null,
		VO\StringVO $background_url = null,
		VO\OrganisationID $organisation_id = null
	){	
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/organisation/and/admin/create'),
			new VO\HTTP\Method('post')
		);

		$request_parameters = array(
			'organisation_name' => $organisation_name->__toString(),
			'domain' => $domain->__toString(),
			'email_address' => $email->__toString(),
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString(),
		);
		if(!is_null($contact_number)){
			$request_parameters['contact_number'] = $contact_number->__toString();
		}
		if(!is_null($billing_address)){
			$request_parameters['billing_address'] = $billing_address->__toString();
		}
		if(!is_null($tax_code)){
			$request_parameters['tax_code'] = $tax_code->__toString();
		}
		if(!is_null($company_website)){
			$request_parameters['company_website'] = $company_website->__toString();
		}
		if(!is_null($branding_logo_url)){
			$request_parameters['branding_logo_url'] = $branding_logo_url->__toString();
		}
		if(!is_null($background_url)){
			$request_parameters['background_url'] = $background_url->__toString();
		}
		if(!is_null($organisation_id)){
			$request_parameters['organisation_id'] = $organisation_id->__toString();
		}

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function create_bulk_licenses(
		VO\OrganisationID $organisation_id,
		VO\CourseIDArray $courses_ids,
		VO\Integer $no_of_licenses
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/create/bulk/licenses'),
			new VO\HTTP\Method('post')
		);

		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString(),
			'courses_ids' => $courses_ids->__toArray(),
			'no_of_licenses' => $no_of_licenses->__toInteger()
			
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function register_member(
		VO\MemberID $member_id,
		VO\Password $password,
		VO\Username $username = null
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/complete/registration'),
			new VO\HTTP\Method('post')
		);

		$request_parameters = array(
			'member_id' => $member_id->__toString(),
			'password' => $password->__toString(),
			
		);
		
		if(!is_null($username)){
			$request_parameters['username'] = $username->__toString();		
		}

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}
	
	public function classroom_course_typeahead(
		VO\StringVO $search
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/classroom/courses/search'),
			new VO\HTTP\Method('post')
		);

		$request_parameters = array(
			'search' => $search->__toString(),
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function notify_classroom_admin(
		VO\OrganisationID $organisation_id,
		VO\MemberID $admin_id,
		VO\StringVO $classroom_ids_and_seats
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/notify_classroom_admin'),
			new VO\HTTP\Method('post')
		);

		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString(),
			'admin_id' => $admin_id->__toString(),
			'classroom_ids_and_seats' => $classroom_ids_and_seats->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function check_email_exist(
		VO\Email $email
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/check/email'),
			new VO\HTTP\Method('get')
		);
		
		$response = $request->send(array('email'=>$email->__toString()));

		$data = $response->get_data();

		return $data;
	}

	public function check_sub_domain_exist(
		VO\StringVo $sub_domain
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/check/sub_domain/' . $sub_domain->__toString()),
			new VO\HTTP\Method('get')
		);

		$response = $request->send(array());

		$data = $response->get_data();

		return $data;
	}

	public function member_register_or_create(
		VO\Email $email,
		VO\OrganisationID $organisation_id,
		VO\Name $name,
		VO\Integer $is_admin,
		VO\Password $password
	){	
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/member/createORregister'),
			new VO\HTTP\Method('post')
		);

		$request_parameters = array(
			'email' => $email->__toString(),
			'organisation_id' => $organisation_id->__toString(),
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString(),
			'is_admin' => $is_admin->__toInteger(),
			'password' => $password->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data;
	}

}