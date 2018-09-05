<?php

namespace AcademyHQ\API\Repository\WebClient;

use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\HTTP\Request\Request as Request;
use AcademyHQ\API\Repository\BaseRepository;
use AcademyHQ\API\ValueObjects as VO;
use Guzzle\Http\Client as GuzzleClient;

class AssessorRepository extends BaseRepository {

	public function __construct(Credentials $credentials)
	{
		parent::__construct();
		$this->credentials = $credentials;
		$this->base_url .= '/web/client';
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

		return $data->view_url;
	}
	
	public function edit_member_audit(
		VO\Token $token,
		VO\Integer $member_audit_form_id,
		VO\Integer $is_assessed=null,
		VO\Integer $is_verified=null,
		VO\Integer $is_approved=null
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/assessor/edit/member/audit'),
			new VO\HTTP\Method('PUT')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'member_audit_form_id' => $member_audit_form_id->__toInteger(),
		);

		if(!is_null($is_assessed)){
			$request_parameters['is_assessed'] = $is_assessed->__toInteger();
		}

		if(!is_null($is_verified)){
			$request_parameters['is_verified'] = $is_verified->__toInteger();
		}

		if(!is_null($is_approved)){
			$request_parameters['is_approved'] = $is_approved->__toInteger();
		}

		$response = $request->send($request_parameters,$header_parameters);

		$data = $response->get_data();

		return $data;
	}
}