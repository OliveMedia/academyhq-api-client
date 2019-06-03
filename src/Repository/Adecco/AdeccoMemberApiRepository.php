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
	
	public function get_learner_details_by_invitation_token(
		VO\StringVo $invitationToken    
	) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/onscensus/member/get/details/'.$invitationToken->__toString()),
			new VO\HTTP\Method('GET')
        );
         
		$header_parameters = array();

		$request_parameters = array();

        $response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}


	public function set_member_user_password(
		VO\StringVo $member_invite_token,
		VO\Name  $name,
		VO\Username $username,
		VO\Password $password,
		VO\Password $password_confirm
	) {
	
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/onscensus/member/set/password'),
			new VO\HTTP\Method('POST')
        );
        
		$header_parameters = array();

		$request_parameters = array(
            'first_name'    		=> $name->get_first_name()->__toString(),
            'last_name'     		=> $name->get_last_name()->__toString(),
            'username'         		=> $username->__toEncodedString(),
			'password'          	=> $password->__toEncodedString(),
			'password_confirm'  	=> $password_confirm->__toEncodedString(),
			'member_invite_token'	=> $member_invite_token->__toString()
			
		);

        $response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}


	public function update_member_password(
		VO\Token $token,
		VO\Password $password_old,
		VO\Password $password_new,
		VO\Password $password_confirm
	) {
	
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/onscensus/update/member/password'),
			new VO\HTTP\Method('POST')
        );
        
		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
	 
			'password_new'          	=> $password_new->__toEncodedString(),
			'password_new_confirm'  	=> $password_confirm->__toEncodedString(),
			'password_old'				=> $password_old->__toEncodedString()
			
		);

        $response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function update_member_profile_image(
		VO\Token $token,
		VO\StringVO $imagePath,
		VO\StringVO $imageFullUrl
	) {
	
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/onscensus/update/member/profile/image'),
			new VO\HTTP\Method('POST')
        );
        
		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
	 
			'image_key'     => $imagePath->__toString(),
			'image_url'  	=> $imageFullUrl->__toString()
			
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