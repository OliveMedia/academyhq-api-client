<?php

namespace AcademyHQ\API\Repository\ConnectedRMS;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;

class OrganisationApiRepository extends BaseRepository{

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;

	}

	private function get_url(){
		return $this->base_url.'/crms';
	}

	public function delete_partner(
		VO\OrganisationID $organisation_id
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/delete/partner'),
			new VO\HTTP\Method('POST')
		);
		
		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString()
		);

		$response = $request->send($request_parameters);
		
		$data = $response->get_data();

		return $data;
	}

	public function create_org_package(
		VO\OrganisationID $organisation_id,
		VO\ID $package_id,
		VO\Integer $number_of_license

	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->get_url().'/organisation/org_package/create'),
			new VO\HTTP\Method('POST')
		);
		
		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString(),
			'package_id' => $package_id->__toString(),
			'number_of_license' => $number_of_license->__toInteger()
		);

		$response = $request->send($request_parameters);
		
		$data = $response->get_data();

		return $data;
	
	}
	
}