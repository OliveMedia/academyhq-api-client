<?php

namespace AcademyHQ\API\Repository\Adecco;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\Common\Credentials;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Repository\BaseRepository;
use AcademyHQ\API\HTTP\Request\Request as Request;

class AdeccoCliApiRepository extends BaseRepository {

	public function __construct(Credentials $credentials)
	{
		parent::__construct();
		$this->credentials = $credentials; 
	}

	public function fetch_organisation_member_with_inprogress_bundle()
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/onscensus/organisation/get/members/with/bundle/inprogress'),
			new VO\HTTP\Method('GET')
        );

        $header_parameters = array();

        $request_parameters = array();

        $response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function fetch_organisation_team_member_with_completed_bundle($teamBundleIds)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/onscensus/organisation/get/members/with/bundle/completed'),
			new VO\HTTP\Method('GET')
        );


        $header_parameters = array();

        $request_parameters = array(
            'team_bundle_ids'    => $teamBundleIds
        );
        $response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;

	}

	public function fetch_organisation_member_with_no_enrollment() 
	{
		
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/onscensus/organisation/get/members/not/enroll'),
			new VO\HTTP\Method('GET')
        );

        $header_parameters = array();

        $request_parameters = array();

        $response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function fetch_organisation_member_with_enrollment() 
	{
		
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/onscensus/organisation/get/members/enroll'),
			new VO\HTTP\Method('GET')
        );

        $header_parameters = array();

        $request_parameters = array();

        $response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}
	


   
}