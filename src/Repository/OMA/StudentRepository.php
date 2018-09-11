<?php

namespace AcademyHQ\API\Repository\OMA;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;

class StudentRepository extends BaseRepository
{
    public function __construct(Credentials $credentials)
    {
        parent::__construct();
        $this->credentials = $credentials;
        $this->base_url .= '/oma';
    }

    public function list_member_apprenticeship(
        VO\Token $token
       
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/student/list/member/apprenticeship'),
            new VO\HTTP\Method('POST')
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $response = $request->send(array(), $header_parameters);

        $data = $response->get_data();

        return $data;
    }


    public function list_vip_members(
        VO\Token $token
    
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/student/list/vip/members'),
            new VO\HTTP\Method('POST')
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $response = $request->send(array(), $header_parameters);

        $data = $response->get_data();

        return $data;
    }


    public function member_apprenticeship_details(
        VO\Token $token,
        VO\Integer $member_apprenticeship_id
    
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/student/member/apprenticeship/details'),
            new VO\HTTP\Method('POST')
        );
        $request_parameters = array(
            
            'member_apprenticeship_id' => $member_apprenticeship_id->__toInteger()
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $response = $request->send($request_parameters, $header_parameters);
       
        $data = $response->get_data();

        return $data;
    }
    public function program_units_list(
        VO\Token $token,
        VO\Integer $program_id
    
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/student/program/units/list'),
            new VO\HTTP\Method('POST')
        );
        $request_parameters = array(
            
            'program_id' => $program_id->__toInteger()
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $response = $request->send($request_parameters, $header_parameters);
       
        $data = $response->get_data();

        return $data;
    }



    public function member_program_unit_details(
        VO\Token $token,
        VO\Integer $program_unit_id,
        VO\Integer $member_apprenticeship_id
    
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/student/apprenticeship/program/unit/view'),
            new VO\HTTP\Method('POST')
        );
        $request_parameters = array(
            
            'program_unit_id' => $program_unit_id->__toInteger(),
            'member_apprenticeship_id' => $member_apprenticeship_id->__toInteger()
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $response = $request->send($request_parameters, $header_parameters);
       
        $data = $response->get_data();
    
        return $data;
    }

    public function member_enrolment_details(
        VO\Token $token,
        VO\EnrolmentID $enrolment_id
    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/student/enrolment/details'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            
            'enrolment_id' => $enrolment_id->__toString(),
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $response = $request->send($request_parameters, $header_parameters);
       
        $data = $response->get_data();
    
        return $data;
    }

    public function member_program_status(
        VO\Token $token,
        VO\ID $member_program_id,
        VO\Integer $completed = null,
        VO\Integer $started = null
    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/student/member/program/status'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            
            'member_program_id' => $member_program_id->__toString(),
        );

        if(!is_null($completed)){
            $request_parameters['completed'] = $completed->__toInteger();
        }

        if(!is_null($started)){
            $request_parameters['started'] = $started->__toInteger();
        }

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $response = $request->send($request_parameters, $header_parameters);
       
        $data = $response->get_data();
    
        return $data;
    }


}
