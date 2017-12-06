<?php

namespace AcademyHQ\API\Repository\WebClient;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class MemberProgramRepository {

	// private $base_url = 'https://api.academyhq.com/api/v2/web/client';
	private $base_url = 'https://api.sandbox.academyhq.olive.media/api/v2/web/client';
	
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

	public function phase_details(VO\Token $token, VO\MemberID $member_id, VO\ProgramID $program_id)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/member_program/member/'.$member_id.'/phase/'.$program_id.'/details'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null,$header_parameters);

		$data = $response->get_data();

		return $data;
	}
}