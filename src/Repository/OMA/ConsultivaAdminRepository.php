<?php

namespace AcademyHQ\API\Repository\OMA;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;

class ConsultivaAdminRepository extends BaseRepository
{
    public function __construct(Credentials $credentials)
    {
        parent::__construct();
        $this->credentials = $credentials;
        $this->base_url .= '/oma';
    }

    public function listApprenticeship(
        VO\Token $token,
        VO\StringVO $search = null,
        VO\OrganisationID $organisation_id = null,
        VO\Integer $current_page
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/list/apprenticeship'),
            new VO\HTTP\Method('POST')
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(
            'search' => $search ? $search->__toString() : '',
            'current_page' => $current_page->__toInteger(),
            'organisation_id' => $organisation_id ? $organisation_id->__toString() : ''
        );

        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }


    public function list_student(
        VO\Token $token,
        VO\Integer $current_page,
        VO\StringVO $search = null,
        VO\OrganisationID $organisation_id = null,
        VO\ApprenticeshipID $apprenticeship_id = null

    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/list/student'),
            new VO\HTTP\Method('POST')
        );


        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(
            'search' => $search ? $search->__toString() : '',
            'current_page' => $current_page->__toInteger(),
            'organisation_id' => $organisation_id ? $organisation_id->__toString() : '',
            'apprenticeship_id' => $apprenticeship_id ? $apprenticeship_id->__toString() : ''
        );

        $response = $request->send($request_parameters, $header_parameters);
        $data = $response->get_data();

        return $data;
    }



    public function create_student(
        VO\Token $token,
        VO\ApprenticeshipID $apprenticeship_id,
        VO\OrganisationID $organisation_id,
        VO\MemberID $assessor_id,
        VO\Name $name,
        VO\StringVO $gender,
        VO\StringVO $country_code,
        VO\Integer $mobile_number,
        VO\Email $email,
        VO\StringVO $nationality,
        VO\StringVO $street,
        VO\StringVO $city,
        VO\StringVO $state,
        VO\StringVO $country,
        VO\StringVO $postal_code,
        VO\Integer $disability,
        VO\StringVO $image = null,
        VO\StringVO $employment = null,
        VO\StringVO $further_notes = null,
        VO\StringVO $date_of_birth = null,
        VO\StringVO $disability_text = null
    ) {
        $request =new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/create/student'),
            new VO\HTTP\Method('POST')
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(
            'apprenticeship_id' => $apprenticeship_id->__toString(),
            'organisation_id' => $organisation_id->__toString(),
            'assessor_id' => $assessor_id->__toString(),
            'first_name' => $name->get_first_name()->__toString(),
            'last_name' => $name->get_last_name()->__toString(),
            'gender' => $gender->__toString(),
            'country_code' => $country_code->__toString(),
            'mobile_number' => $mobile_number->__toInteger(),
            'email' => $email->__toString(),
            'nationality' => $nationality-> __toString(),
            'street' => $street->__toString(),
            'city' => $city->__toString(),
            'state' => $state->__toString(),
            'country' => $country->__toString(),
            'postal_code' => $postal_code->__toString(),
            'disability' => $disability->__toInteger(),
            'image' => $image ? $image->__toString() : '',
            'employment' => $employment ? $employment->__toString() : '',
            'further_notes' => $further_notes ? $further_notes->__toString() : '',
            'date_of_birth' => $date_of_birth ? $date_of_birth-> __toString() : '',
            'disability_text' => $disability_text ? $disability_text->__toString() : '',
        );

        $response = $request->send($request_parameters, $header_parameters);
        
       
        $data = $response->get_data();

        return $data;
    }


    //member program list 
    public function student_program_list(
        VO\Token $token,
        VO\Integer $member_apprenticeship_id
    
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/list/student/programs'),
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



public function student_program_details(
        VO\Token $token,
        VO\Integer $member_apprenticeship_id,
        VO\Integer $program_id
    
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/student/program/details'),
            new VO\HTTP\Method('POST')
        );
        $request_parameters = array(
            
            'member_apprenticeship_id' => $member_apprenticeship_id->__toInteger(),
            'program_id' => $program_id->__toInteger()
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $response = $request->send($request_parameters, $header_parameters);
       
        $data = $response->get_data();
        
        return $data;
    }

    /*alicrity get program phase details*/
    public function occupation_program_details(
        VO\Token $token,
        VO\Integer $occupation_id


    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/get/occupation/programs/details'),
            new VO\HTTP\Method('POST')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(
            
            'occupation_id'=>$occupation_id->__toInteger(),
       );
        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }

    public function create_member(
        VO\Token $token,
        VO\Name $name,
        VO\Email $email,
        VO\Integer $is_assessor = null,
        VO\Integer $is_verifier = null,
        VO\Integer $is_mentor = null
    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/create/member'),
            new VO\HTTP\Method('POST')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(
            
            'first_name' => $name->get_first_name()->__toString(),
            'last_name' => $name->get_last_name()->__toString(),
            'email' => $email->__toString()
        );

        if(!is_null($is_assessor)){
            $request_parameters['is_assessor']=$is_assessor->__toInteger();
        }

        if(!is_null($is_verifier)){
            $request_parameters['is_verifier']=$is_verifier->__toInteger();
        }

        if(!is_null($is_mentor)){
            $request_parameters['is_mentor']=$is_mentor->__toInteger();
        }

        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }

    public function list_member(
        VO\Token $token,
        VO\StringVO $search,
        VO\Integer $is_assessor = null,
        VO\Integer $is_verifier = null,
        VO\Integer $is_mentor = null
    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/list/members'),
            new VO\HTTP\Method('POST')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(
            'search' => $search->__toString()
        );

        if(!is_null($is_assessor)){
            $request_parameters['is_assessor']=$is_assessor->__toInteger();
        }

        if(!is_null($is_verifier)){
            $request_parameters['is_verifier']=$is_verifier->__toInteger();
        }

        if(!is_null($is_mentor)){
            $request_parameters['is_mentor']=$is_mentor->__toInteger();
        }

        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }

}
