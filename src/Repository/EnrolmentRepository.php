<?php

namespace AcademyHQ\API\Repository;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Service\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class EnrolmentRepository
{

	private $base_url = 'https://api.sandbox.academyhq.olive.media/api/v2';

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	/**
	* @return enrolment_id
	*/

	public function create(VO\MemberID $member_id, VO\LicenseID $license_id)
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
}