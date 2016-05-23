<?php

namespace AcademyHQ\API\Repository;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class EnrolmentRepository
{

	private $base_url = 'https://api.academyhq.com/api/v2';

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	/**
	* @return enrolment_id
	*/

	public function create(VO\MemberID $member_id, VO\LicenseID $license_id, VO\Flag $send_email = null)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/enrolment/create'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'member_id' => $member_id->__toString(),
			'license_id' => $license_id->__toString()
		);

		if($send_email) {
			$request_parameters['send_email'] = $send_email->__toBool();
		}

		$response = $request->send($request_parameters);
		$data = $response->get_data();

		return $data->enrolment_id;
	}

	public function create_for_organisation(VO\MemberID $member_id)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/enrolment/create/organisation'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'member_id' => $member_id->__toString()
		);

		$response = $request->send($request_parameters);
		$data = $response->get_data();

		return $data->enrolment_ids;
	}

	public function create_enrolments(VO\MemberID $member_id, VO\LicenseIDArray $license_id_array, VO\Flag $send_email = null) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/enrolment/create'),
			new VO\HTTP\Method('POST')
		);

		$license_ids = $license_id_array->__toArray();
		$enrolment_ids = array();

		foreach($license_ids as $license_id) {
			$request_parameters = array(
				'member_id' => $member_id->__toString(),
				'license_id' => $license_id
			);

			if($send_email) {
				$request_parameters['send_email'] = $send_email->__toBool();
			}

			$response = $request->send($request_parameters);
			$data = $response->get_data();

			$enrolment_ids[] = $data->enrolment_id;
		}
	
		return $enrolment_ids;
	}

	public function create_offline_enrolment(VO\MemberID $member_id, VO\CourseId $course_id, VO\StringVO $file_name, VO\Integer $hrs, VO\Integer $mins, VO\Integer $sec, VO\StringVO $issued_at, VO\StringVO $expire_at, VO\Flag $send_email = null)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/enrolment/offline/create'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'member_id' => $member_id->__toString(),
			'course_id' => $course_id->__toString(),
			'file' => $file_name->__toString(),
			'hrs' => $hrs->__toInteger(),
			'mins' => $mins->__toInteger(),
			'sec' => $sec->__toInteger(),
			'expire_at' => $expire_at->__toString(),
			'issued_at' => $issued_at->__toString()
		);

		if($send_email) {
			$request_parameters['send_email'] = $send_email->__toBool();
		}

		$response = $request->send($request_parameters);
		$data = $response->get_data();

		return $data->enrolment_id;
	}

	/**
	* @return array of enrolment std objects
	*/

	public function get_all_for_member(VO\MemberID $member_id)
	{
		$member_id = $member_id->__toString();
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/member_enrolments/'.$member_id.'/get'),
			new VO\HTTP\Method('GET')
		);

		$response = $request->send();
		$data = $response->get_data();

		return $data->enrolments;
	}

	/**
	* @return enrolment std object
	*/

	public function get(VO\EnrolmentID $enrolment_id)
	{
		$enrolment_id = $enrolment_id->__toString();
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/enrolment/'.$enrolment_id.'/get'),
			new VO\HTTP\Method('GET')
		);

		$response = $request->send();
		$data = $response->get_data();

		return $data->enrolment;
	}

	/**
	* @return success message
	*/

	public function delete(VO\EnrolmentID $enrolment_id)
	{
		$enrolment_id = $enrolment_id->__toString();
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/enrolment/'.$enrolment_id.'/delete'),
			new VO\HTTP\Method('DELETE')
		);

		$response = $request->send();
		$data = $response->get_data();

		return $data->message;
	}

	/**
	* @return launch url
	*/

	public function get_launch_url(VO\EnrolmentID $enrolment_id, VO\HTTP\Url $callback_url)
	{
		$enrolment_id = $enrolment_id->__toString();
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/enrolment/'.$enrolment_id.'/launch/url'),
			new VO\HTTP\Method('GET')
		);

		$callback_url = $callback_url->__toString();

		$response = $request->send(array('callback_url' => $callback_url));;
		$data = $response->get_data();

		return $data->launch_url;
	}

	public function sync_result(VO\EnrolmentID $enrolment_id)
	{
		$enrolment_id = $enrolment_id->__toString();
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/enrolment/'.$enrolment_id.'/callback'),
			new VO\HTTP\Method('GET')
		);

		$response = $request->send();
		$data = $response->get_data();

		return $data->enrolment;
	}

	public function get_certificate(VO\MemberCertificateID $member_certificate_id) {

		$member_certificate_id = $member_certificate_id->__toString();
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/certificate/'.$member_certificate_id.'/get'),
			new VO\HTTP\Method('GET')
		);

		$response = $request->send();
		$data = $response->get_data();

		return $data->certificate;
	}

	public function get_certificate_url(VO\MemberCertificateID $member_certificate_id) {

		$member_certificate_id = $member_certificate_id->__toString();
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/certificate/'.$member_certificate_id.'/download'),
			new VO\HTTP\Method('GET')
		);

		$response = $request->send();
		$data = $response->get_data();

		return $data->certificate_url;
	}
}