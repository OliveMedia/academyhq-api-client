<?php

namespace AcademyHQ\API\Repository\Adecco;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\Common\Credentials;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Repository\BaseRepository;
use AcademyHQ\API\HTTP\Request\Request as Request;

class AdeccoThirdPartyClient extends BaseRepository {

	public function __construct(Credentials $credentials)
	{
		parent::__construct();
		$this->credentials = $credentials; 
	}

	public function register_member_with_email(
        VO\Name $name,
        VO\Email $email,
        VO\StringVo $team
	) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/onscensus/member/create'),
			new VO\HTTP\Method('POST')
        );
        
        $header_parameters = array();

		$request_parameters = array(
            'first_name'    => $name->get_first_name()->__toString(),
            'last_name'     => $name->get_last_name()->__toString(),
            'email'         => $email->__toEncodedString(),
            'team'          => $team->__toString()
		);

        $response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}
	

	public function promote_member(
        VO\ID $pubId,
        VO\StringVo $team
	) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/onscensus/member/promote'),
			new VO\HTTP\Method('POST')
        );
        
        $header_parameters = array();

		$request_parameters = array(
            'pub_id'        => $pubId->__toString(),
            'team'          => $team->__toString()
		);

        $response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
    }

    public function member_package_progress_details(
        VO\ID $pubId,
        VO\StringVo $team,
        $bundleIds
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/onscensus/get/member/package/progress/details'),
            new VO\HTTP\Method('Post')
        );

        $requestParameters = array(
            'pub_id'     => $pubId->__toString(),
            'package_ids'    => $bundleIds,
            'team'  => $team->__toString()
        );

        $header_parameters = array();

        $response = $request->send($requestParameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }


    public function get_member_teams(
        VO\ID $pubId
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/onscensus/get/member/team/details'),
            new VO\HTTP\Method('Post')
        );

        $requestParameters = array(
            'pub_id'     => $pubId->__toString(),
        );

        $header_parameters = array();

        $response = $request->send($requestParameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }


    public function change_member_status(
        VO\ID $pubId,
        VO\StringVo $status
    ) {

         $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/onscensus/change/member/status'),
            new VO\HTTP\Method('Post')
        );

        $requestParameters = array(
            'pub_id'     => $pubId->__toString(),
            'change_status' =>  $status->__toString()
        );

        $header_parameters = array();

        $response = $request->send($requestParameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }

    




   
}