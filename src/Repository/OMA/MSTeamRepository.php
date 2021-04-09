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

}
