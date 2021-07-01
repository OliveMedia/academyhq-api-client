<?php

namespace AcademyHQ\API\Repository\OMA;

use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\ValueObjects as VO;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Repository\BaseRepository;
use AcademyHQ\API\HTTP\Request\Request as Request;

class MSTeamRepository extends BaseRepository
{
    public function __construct(Credentials $credentials)
    {
        parent::__construct();
        $this->credentials = $credentials;
        $this->base_url .= '/oma/msteam';
    }

    /*
    Parameters :
        @current_page : num | null
        @per_page : num | null
        @direction : asc | desc | null
        @sort_by : name | created_at | null
        @search : employer's name | null
        @status : active | inactive | null
    */
    public function list_member_apprenticeship(
        VO\Token $token,
        VO\Integer $current_page,
        VO\Integer $per_page,
        VO\StringVO $direction = null,
        VO\StringVO $sort_by = null,
        VO\StringVO $search = null,
        VO\Integer $status = null

    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/student/list/member/apprenticeship'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'current_page' => $current_page->__toInteger(),
            'per_page' => $per_page->__toInteger(),
            'status' => $status->__toInteger(),
        );

        if ($direction) {
            $request_parameters['direction'] = $direction->__toString();
        }

        if ($sort_by) {
            $request_parameters['sort_by'] = $sort_by->__toString();
        }

        if ($search) {
            $request_parameters['search'] = $search->__toString();
        }


        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }
    public function listOccupation(
        VO\Token $token,
        VO\Integer $current_page,
        VO\StringVO $search = null,
        VO\Integer $is_published = null,
        VO\OrganisationID $organisation_id = null,
        VO\Integer $per_page = null
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/list/occupation'),
            new VO\HTTP\Method('POST')
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(
            'search'        => $search ? $search->__toString() : '',
            'current_page'  => $current_page->__toInteger(),
        );

        if (!is_null($is_published)) {
            $request_parameters['is_published']=$is_published->__toInteger();
        }

        if (!is_null($organisation_id)) {
            $request_parameters['organisation_id']=$organisation_id->__toString();
        }
        if(!is_null($per_page)){
            $request_parameters['per_page'] = $per_page->__toInteger();
        }
        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }

    public function list_student(
        VO\Token $token,
        VO\Integer $current_page,
        VO\StringVO $search = null,
        VO\OrganisationID $organisation_id = null,
        VO\ApprenticeshipID $apprenticeship_id = null,
        VO\MemberID $assessor_id = null,
        VO\MemberID $member_id = null,
        VO\MemberID $verifier_id = null,
	    VO\OccupationID $occupation_id = null,
		/**
		 * @internal Added params to customize the number of students and sort orders
		 */
		VO\Integer $per_page = null,
		VO\StringVO $order_by_field = null,
		VO\StringVO $order_by_direction = null
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/student/list/members'),
            new VO\HTTP\Method('POST')
        );


        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(
            'search'            => $search ? $search->__toString() : '',
            'current_page'      => $current_page->__toInteger(),
            'organisation_id'   => $organisation_id ? $organisation_id->__toString() : '',
            'apprenticeship_id' => $apprenticeship_id ? $apprenticeship_id->__toString() : ''
        );

        if(!is_null($assessor_id)){
            $request_parameters['assessor_id'] = $assessor_id->__toString();
        }
         if(!is_null($member_id)){
            $request_parameters['member_id'] = $member_id->__toString();
        }

        if(!is_null($verifier_id)){
            $request_parameters['verifier_id'] = $verifier_id->__toString();
        }

        if(!is_null($occupation_id)){
        	$request_parameters['occupation_id'] = $occupation_id->__toString();
        }

		/**
		 * @internal Added params to customize the number of students and sort orders
		 */
		if(!is_null($per_page)){
			$request_parameters['per_page'] = $per_page->__toInteger();
		}

		if(!is_null($order_by_field)){
			$request_parameters['order_by_field'] = $order_by_field->__toString();
		}

		if(!is_null($order_by_direction)){
			$request_parameters['order_by_direction'] = $order_by_direction->__toString();
		}

        $response = $request->send($request_parameters, $header_parameters);
        $data = $response->get_data();

        return $data;
    }
    /**
     * List Employer
     * @param VO\Token         $token
     * @param VO\StringVO|null $search
     * @param VO\Integer       $current_page
     *
     * @return \AcademyHQ\API\HTTP\Response\json
     * @throws VO\Exception\MethodNotAllowedException
     * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
     */
    public function ListEmployers(
        VO\Token $token,
        VO\StringVO $search = null,
        VO\Integer $current_page,
        /**
         * @internal Added params to customize the number of students and sort orders
         */
        VO\Integer $per_page = null
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/list/employees'),
            new VO\HTTP\Method('POST')
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(
            'search'        => $search ? $search->__toString() : '',
            'current_page'  => $current_page->__toInteger()
        );

        /**
         * @internal Added params to customize the number of students and sort orders
         */
        if(!is_null($per_page)){
            $request_parameters['per_page'] = $per_page->__toInteger();
        }

        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }
    
    /**
	 * Get Program Phase Details
	 * @param VO\Token   $token
	 * @param VO\Integer $occupation_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
    public function occupation_program_details(
        VO\Token $token,
        VO\Integer $occupation_id
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/get/occupation/programs/details'),
            new VO\HTTP\Method('POST')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());
        $request_parameters = array(
            'occupation_id' => $occupation_id->__toInteger(),
       );
        $response = $request->send($request_parameters, $header_parameters);
        $data = $response->get_data();
        return $data;
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
            VO\HTTP\Url::fromNative($this->base_url . '/program/create'),
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
     * Check Member Program For Events
     * @param VO\Token        $token
     * @param VO\IDArray      $memberIds
     * @param VO\ID           $programId
     */
    public function checkMemberProgramsForEvents(
        VO\Token $token,
        VO\IDArray $memberIds,
        VO\ID $programId
    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url . '/program/check'),
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
    }/**
     * get Member Details
     * @param VO\Token        $token
     * @param VO\IDArray      $memberIds
     * @param VO\ID           $programId
     */
    public function getMemberDetailsByID(
        VO\Token $token,
        VO\IDArray $memberIds
    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url . '/members/details'),
            new VO\HTTP\Method('POST')
        );

        $header_parameters = array(
            'Authorization' => $token->__toEncodedString()
        );

        $request_parameters = array(
            'member_ids'        => $memberIds->__toArray()
        );

        $response = $request->send($request_parameters, $header_parameters);
        return $response->get_data();
    }
     /**
     * @param VO\Token   $token
     * @param VO\Integer $member_apprenticeship_id
     *
     * @return \AcademyHQ\API\HTTP\Response\json
     * @throws VO\Exception\MethodNotAllowedException
     * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
     */
    public function getProgramProgress(
        VO\Token $token,
        VO\Integer $memberid,
         VO\Integer $current_page,
        VO\Integer $per_page,
        VO\StringVO $direction = null,
        VO\StringVO $sort_by = null
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/program/progressdetails'),
            new VO\HTTP\Method('POST')
        );
        $request_parameters = array(
            'memberid'  => $memberid->__toInteger(),
             'current_page'  => $current_page->__toInteger()
        );
         /**
         * @internal Added params to customize the number of students and sort orders
         */
        if(!is_null($per_page)){
            $request_parameters['per_page'] = $per_page->__toInteger();
        }
         if ($direction) {
            $request_parameters['direction'] = $direction->__toString();
        }

        if ($sort_by) {
            $request_parameters['sort_by'] = $sort_by->__toString();
        }
        $header_parameters = array('Authorization' => $token->__toEncodedString());
        $response = $request->send($request_parameters, $header_parameters);
        $data = $response->get_data();
        return $data;
    }/**
     * @param VO\Token   $token
     * @param VO\Integer $member_apprenticeship_id
     *
     * @return \AcademyHQ\API\HTTP\Response\json
     * @throws VO\Exception\MethodNotAllowedException
     * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
     */
    public function updatelastAssessedAt(
        VO\Token $token,
        VO\Integer $member_apprentiship_id
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/updatelastAssessedAt'),
            new VO\HTTP\Method('POST')
        );
        $request_parameters = array(
            'member_apprentiship_id'  => $member_apprentiship_id->__toInteger()
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
    public function getlastAssessedAtWithMemberID(
        VO\Token $token,
        VO\Integer $current_page,
        /**
         * @internal Added params to customize the number of students and sort orders
         */
        VO\Integer $per_page = null,
        VO\Integer $member_id
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/getlastassessedatwithmemberID'),
            new VO\HTTP\Method('POST')
        );
        $request_parameters = array(
            'member_id'  => $member_id->__toInteger(),
             'current_page'  => $current_page->__toInteger()
        );

        /**
         * @internal Added params to customize the number of students and sort orders
         */
        if(!is_null($per_page)){
            $request_parameters['per_page'] = $per_page->__toInteger();
        }
        $header_parameters = array('Authorization' => $token->__toEncodedString());
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
        VO\Password $confirm_password
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/password/change'),
            new VO\HTTP\Method('POST')
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());
        $request_parameters = array(
            'password_old' => $old_password->__toEncodedString(),
            'password_new' => $new_password->__toEncodedString(),
            'password_new_confirm' => $confirm_password->__toEncodedString()
        );

        $response = $request->send($request_parameters, $header_parameters);
        $data = $response->get_data();

        return $data;
    }/**
     *  Member Password Change
     * @param VO\Token $token
     * @param VO\Password $old_password
     * @param VO\Password $new_password
     * @param VO\Password $confirm_password
     * @return \AcademyHQ\API\HTTP\Response\json
     * @throws VO\Exception\MethodNotAllowedException
     * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
     */
    public function getmemberDetails(
        VO\Token $token
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/member/details'),
            new VO\HTTP\Method('POST')
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());
        $request_parameters = array();

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
        VO\StringVO $custom_fields_data = null
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url . '/profile/change'),
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

        $response = $request->send($request_parameters, $header_parameters);
        return $response->get_data();
    }
    /**
     *  plan  Change
     * @param VO\Token $token
     * @param VO\String $plan
     * @return \AcademyHQ\API\HTTP\Response\json
     * @throws VO\Exception\MethodNotAllowedException
     * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
     */
    public function planidUpdateInOrganization(
        VO\Token $token,
        VO\StringVO $plan
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/organisation/update/plan'),
            new VO\HTTP\Method('POST')
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());
        $request_parameters = array(
            'plan' => $plan->__toString()
        );

        $response = $request->send($request_parameters, $header_parameters);
        $data = $response->get_data();

        return $data;
    } 
     public function list_member(
       VO\Token $token,
        VO\Integer $current_page,
        VO\StringVO $search = null,
        VO\Integer $member_id = null,
        VO\Integer $organisation_id = null,
        VO\Integer $per_page = null
    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/list/members'),
            new VO\HTTP\Method('POST')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());

         $request_parameters = array(
            'search'        => $search ? $search->__toString() : '',
            'current_page'  => $current_page->__toInteger(),
        );

        if (!is_null($member_id)) {
            $request_parameters['member_id']=$member_id->__toInteger();
        }

        if (!is_null($organisation_id)) {
            $request_parameters['organisation_id']=$organisation_id->__toInteger();
        }
        if(!is_null($per_page)){
            $request_parameters['per_page'] = $per_page->__toInteger();
        }
        
        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }
    
    public function create_member(
        VO\Token $token,
        VO\Name $name,
        VO\Email $email,
        VO\StringVO $password,
        VO\Integer $is_assessor = null,
        VO\Integer $is_verifier = null
    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/create/member'),
            new VO\HTTP\Method('POST')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(

            'first_name' => $name->get_first_name()->__toString(),
            'last_name' => $name->get_last_name()->__toString(),
            'email' => $email->__toString()
        );
         if(!is_null($password)){
                $request_parameters['password'] = $password->__toString();
            }
        if(!is_null($is_assessor)){
            $request_parameters['is_assessor']=$is_assessor->__toInteger();
        }

        if(!is_null($is_verifier)){
            $request_parameters['is_verifier']=$is_verifier->__toInteger();
        }

        

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
    public function create_learner(
        VO\Token $token,
        VO\Name $name,
        VO\StringVO $password,
        VO\StringVO $country_code=null,
        VO\StringVO $mobile_number=null,
        VO\Email $email,
        VO\Integer $organisation_id = null,
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
        VO\StringVO $custom_fields_data = null
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url . '/create/learner'),
            new VO\HTTP\Method('POST')
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(
            'first_name'    => $name->get_first_name()->__toString(),
            'last_name'     => $name->get_last_name()->__toString(),
            'password'  => $password->__toString(),
            'email'         => $email->__toString()
        );
        if (!is_null($organisation_id)) {
            $request_parameters['organisation_id']=$organisation_id->__toInteger();
        }
        

        if(!is_null($country_code)){
            $request_parameters['country_code'] = $country_code->__toString();
        }
        if(!is_null($mobile_number)){
            $request_parameters['mobile_number'] = $mobile_number->__toString();
        }
        if(!is_null($disability)){
            $request_parameters['disability'] = $disability->__toInteger();
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

        $response = $request->send($request_parameters, $header_parameters);
        return $response->get_data();
    }
   
    public function create_apprentiship(
        VO\Token $token,
        VO\Integer $member_id,
        VO\Integer $program_id,
        VO\Integer $assessor_id = null,
        VO\Integer $verifier_id = null,
        VO\Integer $working_hours=null
    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/create/member_apprentiship'),
            new VO\HTTP\Method('POST')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(

            'member_id' => $member_id->__toInteger(),
            'program_id' => $program_id->__toInteger()
        );
        if(!is_null($assessor_id)){
            $request_parameters['assessor_id']=$assessor_id->__toInteger();
        }

        if(!is_null($verifier_id)){
            $request_parameters['verifier_id']=$verifier_id->__toInteger();
        }
        if(!is_null($working_hours)){
            $request_parameters['working_hours']=$working_hours->__toInteger();
        }

        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    } 
    public function list_assessor_or_verifier(
        VO\Token $token,
        VO\Integer $current_page,
        VO\StringVO $search = null,
        VO\Integer $is_assessor = null,
        VO\Integer $is_verifier = null,
        VO\Integer $per_page = null
    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/list/assessor_or_verifier'),
            new VO\HTTP\Method('POST')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());
        $request_parameters = array(
            'search'        => $search ? $search->__toString() : '',
            'current_page'  => $current_page->__toInteger(),
        );

         if (!is_null($is_assessor)) {
            $request_parameters['is_assessor']=$is_assessor->__toInteger();
        }

        if (!is_null($is_verifier)) {
            $request_parameters['is_verifier']=$is_verifier->__toInteger();
        }
        if(!is_null($per_page)){
            $request_parameters['per_page'] = $per_page->__toInteger();
        }
        

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
    public function edit_member_details(
        VO\Token $token,
        VO\MemberID $member_id,
        VO\StringVO $first_name =null, 
        VO\StringVO $last_name =null, 
        VO\StringVO $gender=null,
        VO\StringVO $country_code =null,
        VO\StringVO $mobile_number =null,
        VO\StringVO $nationality=null,
        VO\Integer $disability =null,
        VO\StringVO $street = null,
        VO\StringVO $city = null,
        VO\StringVO $state = null,
        VO\StringVO $country = null,
        VO\StringVO $postal_code = null,        
        VO\StringVO $image = null,
        VO\StringVO $employment = null,
        VO\StringVO $further_notes = null,
        VO\StringVO $disability_text = null,
        VO\StringVO $custom_fields_data = null
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url . '/edit/member'),
            new VO\HTTP\Method('POST')
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(
            'member_id'     => $member_id->__toString()
        );

        if(!is_null($first_name)){
            $request_parameters['first_name'] = $first_name->__toString();
        }
        if(!is_null($last_name)){
            $request_parameters['last_name'] = $last_name->__toString();
        }
        if(!is_null($country_code)){
            $request_parameters['country_code'] =$country_code->__toString();
        }
        if(!is_null($mobile_number)){
            $request_parameters['mobile_number'] =$mobile_number->__toString();
        }
        if(!is_null($disability)){
            $request_parameters['disability'] =$disability->__toInteger();
        }
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


        if(!is_null($disability_text)){
            $request_parameters['disability_text'] = $disability_text->__toString();
        }

        if(!is_null($custom_fields_data)) {
            $request_parameters['custom_fields_data'] = $custom_fields_data->__toString();
        }

        $response = $request->send($request_parameters, $header_parameters);
        return $response->get_data();
    }
    public function importMember(
        VO\Token $token,
        VO\StringVO $files = null
    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/import/member'),
            new VO\HTTP\Method('POST')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());
        $request_parameters = array(
            'files'        => $files->__toString() 
        );

      

        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }
    public function deleteMemberApprenticeship(
        VO\Token $token,
        VO\Integer $member_apprenticeships_id = null
    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/delete/memberapprentiship'),
            new VO\HTTP\Method('POST')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());
        $request_parameters = array(
            'member_apprenticeships_id'  => $member_apprenticeships_id->__toInteger(),
        );

         

        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }

    /**
    *    @name          : editApprenticeshipClient
    *    @param         : $company_name
    *    @param         : $plan
    *    @param         : $branding_logo_url Base64 data or valid link
    *    @param         : $background_url Base64 data or valid link
    *    @param         : $branding_hex
    *    @param         : $icon
    *    @response     : \AcademyHQ\API\HTTP\Response\json
    *    @IPR 2021 Hiup Solutions
    **/

    public function editApprenticeshipClient(
        VO\Token $token,
        VO\StringVO $company_name=null,
        VO\StringVO $plan=null,
        VO\StringVO $branding_logo_url=null,
        VO\StringVO $background_url=null,
        VO\StringVO $branding_hex=null,
        VO\StringVO $icon=null
        ){
            $request = new Request(
                new GuzzleClient,
                $this->credentials,
                VO\HTTP\Url::fromNative($this->base_url . '/edit/apprenticeship/client'),
                new VO\HTTP\Method('POST')
            );
            $header_parameters = array('Authorization' => $token->__toEncodedString());
            $request_parameters = array();

            if(!is_null($company_name)){
                $request_parameters['company_name'] = $company_name->__toString();
            }
            if(!is_null($plan)){
                $request_parameters['plan'] = $plan->__toString();
            }
            if(!is_null($branding_logo_url)){
                $request_parameters['branding_logo_url'] = $branding_logo_url->__toString();
            }
            if(!is_null($background_url)){
                $request_parameters['background_url'] = $background_url->__toString();
            }
            if(!is_null($branding_hex)){
                $request_parameters['branding_hex'] = $branding_hex->__toString();
            }
            if(!is_null($icon)){
                $request_parameters['icon'] = $icon->__toString();
            }


            $response = $request->send($request_parameters, $header_parameters);
            $data = $response->get_data();
            return $data;
    }

    /**
     * create employer
     * @param VO\Token $token
     * @param VO\String $first_name
     * @param VO\String $last_name
     * @param VO\String $password
     * @param VO\String $employer_name
     * @param VO\String $email
     * @param VO\String $tax_number
     * @param VO\String $image
     * @return \AcademyHQ\API\HTTP\Response\json
     * @throws VO\Exception\MethodNotAllowedException
     * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
     */

     public function createEmployer(
        VO\Token $token,
        VO\StringVO $first_name,
        VO\StringVO $last_name,
        VO\StringVO $password,
        VO\StringVO $employer_name,
        VO\StringVO $email,
        VO\StringVO $tax_number=null,
        VO\StringVO $image=null
    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/create/employer'),
            new VO\HTTP\Method('POST')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(

            'first_name'    => $first_name->__toString(),
            'last_name'     => $last_name->__toString(),
            'password'      =>$password->__toString(),
            'employer_name' => $employer_name->__toString(),
            'email'         => $email->__toString(),


        );
        if(!is_null($tax_number)){
            $request_parameters['tax_number']=$tax_number->__toString();
        }

        if(!is_null($image)){
            $request_parameters['image']=$image->__toString();
        }

        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }

    /**
     * Delete employer
     * @param VO\Token $token
     * @param VO\String $sub_org_id
     */

     public function deleteEmployer(
        VO\Token $token,
        VO\StringVO $sub_org_id
    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/delete/employer'),
            new VO\HTTP\Method('POST')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(
            'sub_org_id'    => $sub_org_id->__toString(),
        );

        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }


    /**
     * create trainer
     * @param VO\Token $token
     * @param VO\String $first_name
     * @param VO\String $last_name
     * @param VO\String $email
     * @param VO\String $password
     * @param VO\String $image
     * @return \AcademyHQ\API\HTTP\Response\json
     * @throws VO\Exception\MethodNotAllowedException
     * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
     */

     public function createTrainer(
        VO\Token $token,
        VO\StringVO $first_name,
        VO\StringVO $last_name,
        VO\StringVO $email,
        VO\StringVO $password,
        VO\StringVO $image = null

    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/create/trainer'),
            new VO\HTTP\Method('POST')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(

            'first_name'    => $first_name->__toString(),
            'last_name'     => $last_name->__toString(),
            'email'         => $email->__toString(),
            'password'      =>$password->__toString(),
        );

        if(!is_null($image)){
            $request_parameters['image']=$image->__toString();
        }

        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }
}
