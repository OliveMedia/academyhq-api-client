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

    public function member_apprenticeship_program_evidence(
        VO\Token $token,
        VO\ID $member_apprenticeship_id = null, //required for create
        VO\ID $program_unit_id = null, //required for create
        VO\StringVO $description = null, //required for create
        VO\StringVO $evidence_type = null, //required for create
        VO\StringVO $document_url = null, //required for create
        VO\StringVO $document_key = null, //required for create
        VO\StringVO $address = null, //required for create
        VO\StringVO $latitude = null, //required for create
        VO\StringVO $longitude = null, //required for create
        VO\Integer $approved = null,
        VO\Integer $disapproved = null,
        VO\ID $program_evidence_id = null
    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/student/apprenticeship/program/evidence'),
            new VO\HTTP\Method('POST')
        );

        if(!is_null($member_apprenticeship_id)){
            $request_parameters['member_apprenticeship_id'] = $member_apprenticeship_id->__toString();
        }

        if(!is_null($program_unit_id)){
            $request_parameters['program_unit_id'] = $program_unit_id->__toString();        
        }

        if(!is_null($address)){
            $request_parameters['address'] = $address->__toString();        
        }

        if(!is_null($latitude)){
            $request_parameters['latitude'] = $latitude->__toString();        
        }

        if(!is_null($longitude)){
            $request_parameters['longitude'] = $longitude->__toString();        
        }

        if(!is_null($description)){
            $request_parameters['description'] = $description->__toString();        
        }

        if(!is_null($evidence_type)){
            $request_parameters['evidence_type'] = $evidence_type->__toString();        
        }

        if(!is_null($document_url)){
            $request_parameters['document_url'] = $document_url->__toString();        
        }

        if(!is_null($document_key)){
            $request_parameters['document_key'] = $document_key->__toString();        
        }

        if(!is_null($approved)){
            $request_parameters['approved'] = $approved->__toInteger();        
        }

        if(!is_null($disapproved)){
            $request_parameters['disapproved'] = $disapproved->__toInteger();        
        }

        if(!is_null($program_evidence_id)){
            $request_parameters['program_evidence_id'] = $program_evidence_id->__toString();        
        }

        $header_parameters = array('Authorization' => $token->__toEncodedString());

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
            VO\HTTP\Url::fromNative($this->base_url.'/student/create/member'),
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
        VO\StringVO $search = null,
        VO\Integer $is_assessor = null,
        VO\Integer $is_verifier = null,
        VO\Integer $is_mentor = null
    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/student/list/members'),
            new VO\HTTP\Method('POST')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array();

        if(!is_null($search)){
            $request_parameters['search']=$search->__toString();
        }

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
