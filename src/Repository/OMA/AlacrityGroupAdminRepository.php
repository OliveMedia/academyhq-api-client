<?php

namespace AcademyHQ\API\Repository\OMA;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;

class AlacrityGroupAdminRepository extends BaseRepository {

	public function __construct(Credentials $credentials){
		parent::__construct();
		$this->credentials = $credentials;
	}

	public function bravo (){
		
	}

	public function fat(){
		return 'lalala';
	}

	public function ListEmployer( VO\Token $token, VO\StringVO $search, VO\Integer $current_page){
		
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/list/consultiva'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'search' => $search ? $search->__toString() : '',
			'current_page' => $current_page->__toInteger()
		);

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;

	}

	public function createEmployer(
		VO\Token $token,
		VO\Email $email,
		VO\StringVO $employer_name,
		VO\Name $name,
		VO\TaxNumber $tax_number
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/create/employer'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'email' => $email->__toString(),
			'employer_name' => $employer_name->__toString(),
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString(),
			'tax_number' => $tax_number->__toString()
		);

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;

	}

	public function createApprenticeship(
		VO\Token $token,
		VO\OrganisationID $employer_id,
		VO\OccupationID $occupation_id,
		VO\MemberID $contact_person_id
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/create/apprenticeship'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'employer_id' => $employer_id->__toString(),
			'occupation_id' => $occupation_id->__toString(),
			'contact_person_id' => $contact_person_id->__toString()
		);

		$response = $request->send($request_parameters, $header_parameters); 

		$data = $response->get_data();

		return $data;
	}
	
	public function listApprenticeship(
		VO\Token $token,
		VO\StringVO $search,
		VO\Integer $current_page
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/list/apprenticeship'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'search' => $search ? $search->__toString() : '',
			'current_page' => $current_page->__toInteger()
		);

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}


	public function listOccupation(
		VO\Token $token,
		VO\StringVO $search,
		VO\Integer $current_page
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/list/occupation'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'search' => $search ? $search->__toString() : '',
			'current_page' => $current_page->__toInteger()
		);

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}
	
}