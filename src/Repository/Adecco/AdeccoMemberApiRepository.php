<?php

namespace AcademyHQ\API\Repository\Adecco;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\Common\Credentials;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Repository\BaseRepository;
use AcademyHQ\API\HTTP\Request\Request as Request;

class AdeccoMemberApiRepository extends BaseRepository {

	public function __construct(Credentials $credentials)
	{
		parent::__construct();
		$this->credentials = $credentials; 
	}

	public function register_member_with_email(
		VO\Token $token,
        VO\Name $name,
        VO\Email $email,
        VO\StringVo $team
	) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/onscensus/create/member'),
			new VO\HTTP\Method('POST')
        );
        
        $header_parameters = array('Authorization' => $token->__toEncodedString());

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
		VO\Token $token,
        VO\ID $memberId,
        VO\StringVo $team
	) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/onscensus/promote/member'),
			new VO\HTTP\Method('POST')
        );
        
        $header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
            'member_id'     => $memberId->__toString(),
            'team'          => $team->__toString()
		);

        $response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
    }
    
   
}