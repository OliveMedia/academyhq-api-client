<?php

namespace AcademyHQ\API\Repository\WebClient;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class AssessorRepository {

	private $base_url = 'https://api.academyhq.com/api/v2/web/client';

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function test(VO\Token $token) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/assessor/test'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null, $header_parameters);

		$data = $response->get_data();

		return $data->message;
	}

	public function edit_program_evidence(
		VO\Token $token,
		VO\Integer $program_evidence_id,
		VO\Integer $is_approved_by_assessor,
		VO\Integer $is_rejected_by_assessor
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/assessor/edit/program/evidence'),
			new VO\HTTP\Method('PUT')
		);

		$header_parameters = array(
			'Authorization' => $token->__toEncodedString()
		);

		$request_parameters = array(
			'program_evidence_id' => $program_evidence_id->__toInteger(),
			'is_approved_by_assessor' => $is_approved_by_assessor->__toInteger(),
			'is_rejected_by_assessor' => $is_rejected_by_assessor->__toInteger()
		);

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function edit_member_program(
		VO\Token $token,
		VO\Integer $member_program_id,
		VO\Integer $is_completed
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/assessor/edit/member/program'),
			new VO\HTTP\Method('PUT')
		);

		$header_parameters = array(
			'Authorization' => $token->__toEncodedString()
		);

		$request_parameters = array(
			'member_program_id' => $member_program_id->__toInteger(),
			'is_completed' => $is_completed->__toInteger()
		);

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function member_audits(
		VO\Token $token,
		VO\ID $member_program_id
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/assessor/get/member/phase/'.$member_program_id.'/audits'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array(
			'Authorization' => $token->__toEncodedString()
		);

		$response = $request->send(null, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function member_audit_launch(VO\Token $token, VO\ID $member_audit_form_id, VO\HTTP\Url $callback_url)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/assessor/get/member/audit/'.$member_audit_form_id.'/launch'),
			new VO\HTTP\Method('GET')
		);

		$callback_url = $callback_url->__toString();

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(array('callback_url' => $callback_url),$header_parameters);

		$data = $response->get_data();

		return $data->launch_url;
	}

	public function member_audit_view(VO\Token $token, VO\ID $member_audit_form_id, VO\HTTP\Url $callback_url)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/assessor/get/member/audit/'.$member_audit_form_id.'/view'),
			new VO\HTTP\Method('GET')
		);

		$callback_url = $callback_url->__toString();

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(array('callback_url' => $callback_url),$header_parameters);

		$data = $response->get_data();

		return $data->launch_url;
	}
}