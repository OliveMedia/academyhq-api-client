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

    public function get_task_list(
        VO\Token $token,
        VO\Integer $member_apprenticeship_id,
        VO\Integer $is_completed,
        VO\Integer $current_page
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/student/fetch/all/programs'),
            new VO\HTTP\Method('POST')
        );
        $request_parameters = array(
            'member_apprenticeship_id' => $member_apprenticeship_id->__toInteger(),
            'is_completed' => $is_completed->__toInteger(),
            'current_page' => $current_page->__toInteger()
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

	/**
	 * @param VO\Token        $token
	 * @param VO\ID           $member_program_id
	 * @param VO\Integer|null $completed
	 * @param VO\Integer|null $started
	 * @param VO\Integer|null $submitted_for_assessment
	 * @param VO\Integer|null $is_assigned_for_resubmission
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
    public function member_program_status(
        VO\Token $token,
        VO\ID $member_program_id,
        VO\Integer $completed = null,
        VO\Integer $started = null,
        VO\Integer $submitted_for_assessment = null,
		VO\Integer $is_assigned_for_resubmission = null
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

        if(!is_null($submitted_for_assessment)){
            $request_parameters['submitted_for_assessment'] = $submitted_for_assessment->__toInteger();
        }

        if(!is_null($started)){
            $request_parameters['started'] = $started->__toInteger();
        }

        if(!is_null($is_assigned_for_resubmission)){
            $request_parameters['is_assigned_for_resubmission'] = $is_assigned_for_resubmission->__toInteger();
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
        VO\Integer $is_mentor = null,
        VO\Integer $is_student = null,
        VO\OrganisationID $organisation_id = null
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

        if(!is_null($is_student)){
            $request_parameters['is_student']=$is_student->__toInteger();
        }
        
        if(!is_null($organisation_id)){
            $request_parameters['organisation_id']=$organisation_id->__toString();
        }

        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }

    //added api for member program unit-create
    public function member_program_unit_create(
        VO\Token $token,
        VO\ID $program_unit_id,
        VO\ApprenticeshipID $member_apprenticeship_id,
        VO\Integer $is_started = null,
        VO\Integer $is_completed = null,
        VO\Integer $is_submitted_for_assessment = null,
        VO\StringVO $observation

    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/student/member/program/unit/create'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'program_unit_id' => $program_unit_id->__toString(),
            'member_apprenticeship_id' => $member_apprenticeship_id->__toString(),
            'observation' => $observation->__toString()
        );

        if(!is_null($is_started)){
            $request_parameters['is_started'] = $is_started->__toInteger();
        }

        if(!is_null($is_completed)){
            $request_parameters['is_completed'] = $is_completed->__toInteger();
        }

        if(!is_null($is_submitted_for_assessment)){
            $request_parameters['is_submitted_for_assessment'] = $is_submitted_for_assessment->__toInteger();
        }

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }

    //added api for member program unit-view
    public function member_program_unit_view(
        VO\Token $token,
        VO\ID $member_program_unit_id
    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/student/member/program/unit/view'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'member_program_unit_id' => $member_program_unit_id->__toString(),
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }

	/**
	 * added api for member program unit-edit
	 * @param VO\Token         $token
	 * @param VO\ID            $member_program_unit_id
	 * @param VO\StringVO|null $observation
	 * @param VO\Integer|null  $is_started
	 * @param VO\Integer|null  $is_completed
	 * @param VO\Integer|null  $is_submitted_for_assessment
	 * @param VO\Integer|null  $is_resubmission
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
    public function member_program_unit_edit(
        VO\Token $token,
        VO\ID $member_program_unit_id,
        VO\StringVO $observation = null,
        VO\Integer $is_started = null,
        VO\Integer $is_completed = null,
        VO\Integer $is_submitted_for_assessment = null,
        VO\Integer $is_resubmission = null
    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/student/member/program/unit/edit'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'member_program_unit_id' => $member_program_unit_id->__toString(),
        );
        if(!is_null($observation)){
            $request_parameters['observation'] = $observation->__toString();
        }
        if(!is_null($is_started)){
            $request_parameters['is_started'] = $is_started->__toInteger();
        }

        if(!is_null($is_completed)){
            $request_parameters['is_completed'] = $is_completed->__toInteger();
        }

        if(!is_null($is_submitted_for_assessment)){
            $request_parameters['is_submitted_for_assessment'] = $is_submitted_for_assessment->__toInteger();
        }

	    if(!is_null($is_resubmission)){
		    $request_parameters['is_resubmission'] = $is_resubmission->__toInteger();
	    }

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }

    /**
     * Create Or Update Observation for Multiple Unit
     * @param VO\Token $token
     * @param VO\IDArray $program_unit_ids
     * @param VO\ApprenticeshipID $member_apprenticeship_id
     * @param VO\Integer|null $is_started
     * @param VO\Integer|null $is_completed
     * @param VO\Integer|null $is_submitted_for_assessment
     * @param VO\StringVO $observation
     * @return \AcademyHQ\API\HTTP\Response\json
     * @throws VO\Exception\MethodNotAllowedException
     * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
     */
    public function member_program_multiple_unit_create_or_update(
        VO\Token $token,
        VO\IDArray $program_unit_ids,
        VO\ApprenticeshipID $member_apprenticeship_id,
        VO\Integer $is_started = null,
        VO\Integer $is_completed = null,
        VO\Integer $is_submitted_for_assessment = null,
        VO\StringVO $observation
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url . '/student/member/program/multiple-unit/create-update'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'program_unit_ids'          => $program_unit_ids->__toArray(),
            'member_apprenticeship_id'  => $member_apprenticeship_id->__toString(),
            'observation'               => $observation->__toString()
        );

        if(!is_null($is_started)){
            $request_parameters['is_started'] = $is_started->__toInteger();
        }

        if(!is_null($is_completed)){
            $request_parameters['is_completed'] = $is_completed->__toInteger();
        }

        if(!is_null($is_submitted_for_assessment)){
            $request_parameters['is_submitted_for_assessment'] = $is_submitted_for_assessment->__toInteger();
        }

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }

    /**
     * Creates Evidences for each of the program children units
     * @param VO\Token $token
     * @param VO\ID $member_apprenticeship_id
     * @param VO\IDArray $program_units_id
     * @param VO\StringVO $evidence_type
     * @param VO\StringVO $document_url
     * @param VO\StringVO $document_key
     * @param VO\StringVO $address
     * @param VO\StringVO $latitude
     * @param VO\StringVO $longitude
     * @param VO\StringVO|null $description
     * @return \AcademyHQ\API\HTTP\Response\json
     * @throws VO\Exception\MethodNotAllowedException
     * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
     */
    public function create_evidence_for_multiple_unit(
        VO\Token $token,
        VO\ID $member_apprenticeship_id,
        VO\IDArray $program_units_id,
        VO\StringVO $evidence_type,
        VO\StringVO $document_url,
        VO\StringVO $document_key,
        VO\StringVO $address,
        VO\StringVO $latitude,
        VO\StringVO $longitude,
        VO\StringVO $description = null
    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/student/create/evidence/for/multiple/units'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'member_apprenticeship_id'  => $member_apprenticeship_id->__toString(),
            'program_units_id'          => $program_units_id->__toArray(),
            'address'                   => $address->__toString(),
            'latitude'                  => $latitude->__toString(),
            'longitude'                 => $longitude->__toString(),
            'evidence_type'             => $evidence_type->__toString(),
            'document_url'              => $document_url->__toString(),
            'document_key'              => $document_key->__toString()
        );

        if(!is_null($description)){
            $request_parameters['description'] = $description->__toString();
        }

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }

	/**
	 * Get Certificates
	 * @param VO\Token $token
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
    public function getCertificates(
            VO\Token $token
        ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/student/get/certificates'),
            new VO\HTTP\Method('POST')
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $response = $request->send(array(), $header_parameters);
       // dd($response->get_data());
        $data = $response->get_data();

        return $data;
    }

    /**
     * Get Certificates for given enrollment
     * @param VO\Token $token
     * @param VO\ID $enrollment_id
     * @return \AcademyHQ\API\HTTP\Response\json
     * @throws VO\Exception\MethodNotAllowedException
     * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
     */
    public function getCertificatesForEnrollment(
        VO\Token $token,
        VO\ID $enrollment_id
    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/student/get/certificates/enrollment/'. $enrollment_id->__toString() ),
            new VO\HTTP\Method('GET')
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());
        $request_parameters = array();

        $response = $request->send($request_parameters, $header_parameters);
        $data = $response->get_data();

        return $data;
    }


    /**
     *  Member Password Change
     * @param VO\Token $token
     * @param VO\Password $old_password
     * @param VO\Password $new_password
     * @param VO\Password $confirm_password
     * @return \AcademyHQ\API\HTTP\Response\json
     * @throws VO\Exception\MethodNotAllowedException
     * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
     */
    public function change_password(
        VO\Token $token,
        VO\Password $old_password,
        VO\Password $new_password,
        VO\Password $confirm_password,
        VO\Token $mykademy_token=null
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/member/password/change'),
            new VO\HTTP\Method('POST')
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(
            'password_old' => $old_password->__toEncodedString(),
            'password_new' => $new_password->__toEncodedString(),
            'password_new_confirm' => $confirm_password->__toEncodedString()
        );

        if(!is_null($mykademy_token)) {
            $request_parameters['mykademy_token'] = $mykademy_token->__toString();
        }
        $response = $request->send($request_parameters, $header_parameters);
        $data = $response->get_data();

        return $data;
    }

    public function member_program_unit_feedback_create_or_update(
        VO\Token $token,
        VO\ID $member_program_unit_id,
        VO\StringVO $description,
        VO\StringVO $creator_role = null,
        VO\ID $id = null
    ) {

        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/student/member/program/unit/feedback'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'member_program_unit_id' => $member_program_unit_id->__toString(),
            'description' => $description->__toString()
        );

        if(!is_null($creator_role)) {
            $request_parameters['creator_role'] = $creator_role->__toString();
        }

        if(!is_null($id)) {
            $request_parameters['id'] = $id->__toString();
        }

        $header_parameters = array('Authorization' => $token->__toEncodedString());
        $response = $request->send($request_parameters, $header_parameters);
        $data = $response->get_data();

        return $data;
    }

	/**
	 * Edit Profile Details
	 * @param VO\Token         $token
	 * @param VO\Name          $name
	 * @param VO\StringVO|null $gender
	 * @param VO\StringVO      $country_code
	 * @param VO\StringVO      $mobile_number
	 * @param VO\Email         $email
	 * @param VO\StringVO|null $nationality
	 * @param VO\Integer       $disability
	 * @param VO\StringVO|null $street
	 * @param VO\StringVO|null $city
	 * @param VO\StringVO|null $state
	 * @param VO\StringVO|null $country
	 * @param VO\StringVO|null $postal_code
	 * @param VO\StringVO|null $image
	 * @param VO\StringVO|null $employment
	 * @param VO\StringVO|null $further_notes
	 * @param VO\StringVO|null $disability_text
	 * @param VO\StringVO|null $date_of_birth
	 * @param VO\Integer|null  $weekly_learning_hours
	 * @param VO\StringVO|null $custom_fields_data
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
    public function edit_profile_details(
	    VO\Token $token,
	    VO\Name $name,
	    VO\StringVO $gender=null,
	    VO\StringVO $country_code,
	    VO\StringVO $mobile_number,
	    VO\Email $email,
	    VO\StringVO $nationality=null,
	    VO\Integer $disability,
	    VO\StringVO $street = null,
	    VO\StringVO $city = null,
	    VO\StringVO $state = null,
	    VO\StringVO $country = null,
	    VO\StringVO $postal_code = null,
	    VO\StringVO $image = null,
	    VO\StringVO $employment = null,
	    VO\StringVO $further_notes = null,
	    VO\StringVO $disability_text = null,
	    VO\StringVO $date_of_birth = null,
	    VO\Integer $weekly_learning_hours=null,
	    VO\StringVO $custom_fields_data = null,
        VO\Token $mykademy_token=null
    )
    {
	    $request = new Request(
		    new GuzzleClient,
		    $this->credentials,
		    VO\HTTP\Url::fromNative($this->base_url . '/member/profile/change'),
		    new VO\HTTP\Method('POST')
	    );

	    $header_parameters = array('Authorization' => $token->__toEncodedString());

	    $request_parameters = array(
		    'first_name'    => $name->get_first_name()->__toString(),
		    'last_name'     => $name->get_last_name()->__toString(),
		    'country_code'  => $country_code->__toString(),
		    'mobile_number' => $mobile_number->__toString(),
		    'email'         => $email->__toString(),
		    'disability'    => $disability->__toInteger()
	    );

	    if(!is_null($gender)){
		    $request_parameters['gender'] = $gender->__toString();
	    }

	    if(!is_null($nationality)){
		    $request_parameters['nationality'] = $nationality->__toString();
	    }

	    if(!is_null($street)){
		    $request_parameters['street'] = $street->__toString();
	    }

	    if(!is_null($city)){
		    $request_parameters['city'] = $city->__toString();
	    }

	    if(!is_null($state)){
		    $request_parameters['state'] = $state->__toString();
	    }

	    if(!is_null($country)){
		    $request_parameters['country'] = $country->__toString();
	    }

	    if(!is_null($postal_code)){
		    $request_parameters['postal_code'] = $postal_code->__toString();
	    }

	    if(!is_null($image)){
		    $request_parameters['image'] = $image->__toString();
	    }

	    if(!is_null($employment)){
		    $request_parameters['employment'] = $employment->__toString();
	    }

	    if(!is_null($further_notes)){
		    $request_parameters['further_notes'] = $further_notes->__toString();
	    }

	    if(!is_null($date_of_birth)){
		    $request_parameters['date_of_birth'] = $date_of_birth->__toString();
	    }

	    if(!is_null($disability_text)){
		    $request_parameters['disability_text'] = $disability_text->__toString();
	    }

	    if(!is_null($weekly_learning_hours)){
		    $request_parameters['weekly_learning_hours'] = $weekly_learning_hours->__toInteger();
	    }

	    if(!is_null($custom_fields_data)) {
		    $request_parameters['custom_fields_data'] = $custom_fields_data->__toString();
	    }

        if(!is_null($mykademy_token)) {
            $request_parameters['mykademy_token'] = $mykademy_token->__toString();
        }

	    $response = $request->send($request_parameters, $header_parameters);
	    return $response->get_data();
    }

	/**
	 * Create Member Program For Events
	 * @param VO\Token        $token
	 * @param VO\IDArray      $memberIds
	 * @param VO\ID           $programId
	 */
    public function createMemberProgramsForEvents(
	    VO\Token $token,
	    VO\IDArray $memberIds,
		VO\ID $programId
    ){
	    $request = new Request(
		    new GuzzleClient,
		    $this->credentials,
		    VO\HTTP\Url::fromNative($this->base_url . '/member/program/create'),
		    new VO\HTTP\Method('POST')
	    );

	    $header_parameters = array(
	    	'Authorization' => $token->__toEncodedString()
	    );

	    $request_parameters = array(
		    'member_ids'        => $memberIds->__toArray(),
		    'program_id'        => $programId->__toString()
	    );

	    $response = $request->send($request_parameters, $header_parameters);
	    return $response->get_data();
	}

	/**
	 * Patch Member Program for Older Event Users
	 * @param VO\Token $token
	 * @param array    $data
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function patchMemberProgramForOlderEventUsers(
		VO\Token $token,
		VO\StringVO $data
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url . '/member/program/patch/events'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array(
			'Authorization' => $token->__toEncodedString()
		);

		$request_parameters = array(
			'events'            => $data->__toString()
		);

		$response = $request->send($request_parameters, $header_parameters);
		return $response->get_data();

	}

	/**
	 * @param VO\Token    $token
	 * @param VO\StringVO $data
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function syncMasterClassAndLearnerJournalForPivot(
		VO\Token $token,
		VO\StringVO $data
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url . '/member/program/patch/pivots-for-masterclass-and-journals'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array(
			'Authorization' => $token->__toEncodedString()
		);

		$request_parameters = array(
			'studentPrograms'            => $data->__toString()
		);

		$response = $request->send($request_parameters, $header_parameters);
		return $response->get_data();

	}


	/**
	 * @param VO\Token   $token
	 * @param VO\ID      $member_apprenticeship_id
	 * @param VO\IDArray $program_unit_ids
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function get_multiple_member_program_unit_details(
		VO\Token $token,
		VO\ID $member_apprenticeship_id,
		VO\IDArray $program_unit_ids
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/student/multiple-program-unit/details'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'member_apprenticeship_id'  => $member_apprenticeship_id->__toString(),
			'program_unit_ids'          => $program_unit_ids->__toArray()
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

    /**
     * @param VO\Token   $token
     * @param VO\Integer $member_apprenticeship_id
     *
     * @return \AcademyHQ\API\HTTP\Response\json
     * @throws VO\Exception\MethodNotAllowedException
     * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
     */
    public function getProgress(
        VO\Token $token,
        VO\Integer $member_apprenticeship_id
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/learner/progress'),
            new VO\HTTP\Method('POST')
        );
        $request_parameters = array(
            'member_apprenticeship_id'  => $member_apprenticeship_id->__toInteger()
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());
        $response = $request->send($request_parameters, $header_parameters);
        $data = $response->get_data();
        return $data;
    }

	/**
	 * @param VO\Token         $token
	 * @param VO\ID            $member_apprenticeship_id
	 * @param VO\Integer|null  $progress
	 * @param VO\StringVO|null $score
	 * @param VO\Integer       $started_programs_count
	 * @param VO\StringVO|null $status
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException§
	 */
    public function updateMemberApprenticeProgress(
        VO\Token $token,
        VO\ID $member_apprenticeship_id,
        VO\Integer $progress=null,
        VO\StringVO $score = null,
        VO\Integer $started_programs_count,
	    VO\StringVO $status = null
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/student/update-member-apprentice-progress'),
            new VO\HTTP\Method('POST')
        );
        $request_parameters = array(
            'member_apprenticeship_id'  => $member_apprenticeship_id->__toString(),
            'started_programs_count'    => $started_programs_count->__toInteger()
        );
        if(!is_null($progress)){
            $request_parameters['progress'] = $progress->__toInteger();
        }
        if(!is_null($score)){
            $request_parameters['score'] = $score->__toString();
        }
	    if(!is_null($status)){
		    $request_parameters['status'] = $status->__toString();
	    }

        $header_parameters = array('Authorization' => $token->__toEncodedString());
        $response = $request->send($request_parameters, $header_parameters);
        $data = $response->get_data();
        return $data;

    }
}
