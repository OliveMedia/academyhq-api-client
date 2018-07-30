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
		VO\Integer $current_page
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


}