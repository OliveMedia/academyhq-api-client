<?php

namespace AcademyHQ\API\Repository\WebClient;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class MemberProgramRepository {

	private $base_url = 'https://api.academyhq.com/api/v2/web/client';
	
	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function fetch_all_member_program(VO\Token $token, VO\MemberID $member_id){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/member_program/'.$member_id.'/all_member_programs'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function member_program_detail(VO\Token $token, VO\MemberProgramID $member_program_id){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/member_program/'.$member_program_id.'/member_program_detail'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function member_journey_list(VO\Token $token, VO\MemberID $member_id, VO\OccupationID $occupation_id){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/member_program/member/'.$member_id.'/occupation/'.$occupation_id.'/journey/list'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function phase_details(VO\Token $token, VO\ID $member_program_id)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/member_program/member/phase/'.$member_program_id.'/details'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function create_program_evidence(
		VO\Token $token,
		VO\ProgramID $program_id,
		VO\MemberID $member_id,
		VO\OccupationID $occupation_id,
		VO\Integer $program_unit_id,
		VO\Address $address,
		VO\Latitude $latitude,
		VO\Longitude $longitude,
		VO\StringVO $evidence_image
	)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/member_program/create/program/evidence'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'program_id' => $program_id->__toString(),
			'member_id' => $member_id->__toString(),
			'occupation_id' => $occupation_id->__toString(),
			'program_unit_id' => $program_unit_id->__toInteger(),
			'address' => $address->__toString(),
			'latitude' => $latitude->__toString(),
			'longitude' => $longitude->__toString(),
			'evidence_image' => $evidence_image->__toString()
		);

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function program_evidence(VO\Token $token, VO\ID $program_evidence_id)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/member_program/get/program/evidence/'.$program_evidence_id),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function fetch_member_journey(VO\Token $token, VO\MemberID $member_id){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/member_program/fetch/member/'.$member_id.'/journey'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function update_member_phase_code(VO\Token $token, VO\Integer $member_id, VO\StringVO $phase_code, VO\Integer $apprenticeship_id){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/member_program/update/member/phase/code'),
			new VO\HTTP\Method('PUT')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'member_id' => $member_id->__toInteger(),
			'phase_code' => $phase_code->__toString(),
			'apprenticeship_id' => $apprenticeship_id->__toInteger()
		);

		$response = $request->send($request_parameters,$header_parameters);

		$data = $response->get_data();

		return $data;
	}
}