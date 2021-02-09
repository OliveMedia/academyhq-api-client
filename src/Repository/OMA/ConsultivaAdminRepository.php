<?php

namespace AcademyHQ\API\Repository\OMA;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;

/**
 * Class ConsultivaAdminRepository
 *
 * @package AcademyHQ\API\Repository\OMA
 */
class ConsultivaAdminRepository extends BaseRepository
{

	/**
	 * ConsultivaAdminRepository constructor.
	 *
	 * @param Credentials $credentials
	 */
	public function __construct(Credentials $credentials)
    {
        parent::__construct();
        $this->credentials = $credentials;
        $this->base_url .= '/oma';
    }

	/**
	 * @param VO\Token               $token
	 * @param VO\StringVO|null       $search
	 * @param VO\OrganisationID|null $organisation_id
	 * @param VO\Integer             $current_page
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
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


	/**
	 * @param VO\Token                 $token
	 * @param VO\Integer               $current_page
	 * @param VO\StringVO|null         $search
	 * @param VO\OrganisationID|null   $organisation_id
	 * @param VO\ApprenticeshipID|null $apprenticeship_id
	 * @param VO\MemberID|null         $assessor_id
	 * @param VO\MemberID|null         $verifier_id
	 * @param VO\OccupationID|null     $occupation_id
	 * @param VO\Integer|null          $per_page
	 * @param VO\StringVO|null         $order_by_field
	 * @param VO\StringVO|null         $order_by_direction
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function list_student(
        VO\Token $token,
        VO\Integer $current_page,
        VO\StringVO $search = null,
        VO\OrganisationID $organisation_id = null,
        VO\ApprenticeshipID $apprenticeship_id = null,
        VO\MemberID $assessor_id = null,
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
            VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/list/student'),
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
	 * Create Student
	 * @param VO\Token            $token
	 * @param VO\ApprenticeshipID $apprenticeship_id
	 * @param VO\OrganisationID   $organisation_id
	 * @param VO\MemberID|null    $assessor_id
	 * @param VO\Name             $name
	 * @param VO\StringVO|null    $gender
	 * @param VO\StringVO         $country_code
	 * @param VO\StringVO         $mobile_number
	 * @param VO\Email            $email
	 * @param VO\StringVO|null    $nationality
	 * @param VO\StringVO|null    $street
	 * @param VO\StringVO|null    $city
	 * @param VO\StringVO|null    $state
	 * @param VO\StringVO|null    $country
	 * @param VO\StringVO|null    $postal_code
	 * @param VO\Integer          $disability
	 * @param VO\StringVO|null    $image
	 * @param VO\MemberID|null    $verifier_id
	 * @param VO\StringVO|null    $employment
	 * @param VO\StringVO|null    $further_notes
	 * @param VO\StringVO|null    $disability_text
	 * @param VO\StringVO|null    $date_of_birth
	 * @param VO\Integer|null     $weekly_learning_hours
	 * @param VO\StringVO|null    $custom_fields_data
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function create_student(
        VO\Token $token,
        VO\ApprenticeshipID $apprenticeship_id,
        VO\OrganisationID $organisation_id,
        VO\MemberID $assessor_id=null,
        VO\Name $name,
		VO\StringVO $gender=null,
        VO\StringVO $country_code,
        VO\StringVO $mobile_number,
        VO\Email $email,
		VO\StringVO $nationality=null,
        VO\StringVO $street = null,
        VO\StringVO $city = null,
        VO\StringVO $state = null,
        VO\StringVO $country = null,
        VO\StringVO $postal_code = null,
        VO\Integer $disability,
        VO\StringVO $image = null,
        VO\MemberID $verifier_id = null,
        VO\StringVO $employment = null,
        VO\StringVO $further_notes = null,
        VO\StringVO $disability_text = null,
        VO\StringVO $date_of_birth = null,
        VO\Integer $weekly_learning_hours = null,
		VO\StringVO $custom_fields_data = null
    ) {
        $request =new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/create/student'),
            new VO\HTTP\Method('POST')
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(
            'apprenticeship_id'     => $apprenticeship_id->__toString(),
            'organisation_id'       => $organisation_id->__toString(),
            'first_name'            => $name->get_first_name()->__toString(),
            'last_name'             => $name->get_last_name()->__toString(),
            'country_code'          => $country_code->__toString(),
            'mobile_number'         => $mobile_number->__toString(),
            'email'                 => $email->__toString(),
            'disability'            => $disability->__toInteger()
        );

		if(!is_null($gender)){
			$request_parameters['gender']       = $gender->__toString();
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
        
        if(!is_null($assessor_id)){
            $request_parameters['assessor_id'] = $assessor_id->__toString();
        }
        
        if(!is_null($verifier_id)){
            $request_parameters['verifier_id'] = $verifier_id->__toString();
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
        
       
        $data = $response->get_data();

        return $data;
    }


	/**
	 * member program list
	 * @param VO\Token   $token
	 * @param VO\Integer $member_apprenticeship_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
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


	/**
	 * @param VO\Token   $token
	 * @param VO\Integer $member_apprenticeship_id
	 * @param VO\Integer $program_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
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
            'member_apprenticeship_id'  => $member_apprenticeship_id->__toInteger(),
            'program_id'                => $program_id->__toInteger()
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());
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
            VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/get/occupation/programs/details'),
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
	 * Create Member Apprenticeships
	 * @param VO\Token            $token
	 * @param VO\ApprenticeshipID $apprenticeship_id
	 * @param VO\OrganisationID   $organisation_id
	 * @param VO\MemberID         $member_id
	 * @param VO\MemberID|null    $assessor_id
	 * @param VO\StringVO         $gender
	 * @param VO\StringVO         $country_code
	 * @param VO\StringVO         $mobile_number
	 * @param VO\StringVO         $nationality
	 * @param VO\StringVO|null    $street
	 * @param VO\StringVO|null    $city
	 * @param VO\StringVO|null    $state
	 * @param VO\StringVO|null    $country
	 * @param VO\StringVO|null    $postal_code
	 * @param VO\Integer          $disability
	 * @param VO\StringVO|null    $image
	 * @param VO\MemberID|null    $verifier_id
	 * @param VO\StringVO|null    $employment
	 * @param VO\StringVO|null    $further_notes
	 * @param VO\StringVO|null    $disability_text
	 * @param VO\StringVO|null    $date_of_birth
	 * @param VO\Integer|null     $weekly_learning_hours
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
    public function create_member_apprenticeship(
        VO\Token $token,
        VO\ApprenticeshipID $apprenticeship_id,
        VO\OrganisationID $organisation_id,
        VO\MemberID $member_id,
        VO\MemberID $assessor_id=null,
        VO\StringVO $gender=null,
        VO\StringVO $country_code,
        VO\StringVO $mobile_number,
        VO\StringVO $nationality=null,
        VO\StringVO $street = null,
        VO\StringVO $city = null,
        VO\StringVO $state = null,
        VO\StringVO $country = null,
        VO\StringVO $postal_code = null,
        VO\Integer $disability,
        VO\StringVO $image = null,
        VO\MemberID $verifier_id = null,
        VO\StringVO $employment = null,
        VO\StringVO $further_notes = null,
        VO\StringVO $disability_text = null,
        VO\StringVO $date_of_birth = null,
        VO\Integer $weekly_learning_hours=null,
	    VO\StringVO $custom_fields_data = null
    ) {
        $request =new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/create/member/apprenticeship'),
            new VO\HTTP\Method('POST')
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(
            'apprenticeship_id'     => $apprenticeship_id->__toString(),
            'organisation_id'       => $organisation_id->__toString(),
            'member_id'             => $member_id->__toString(),
            'disability'            => $disability->__toInteger()
        );

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

        if(!is_null($assessor_id)){
            $request_parameters['assessor_id'] = $assessor_id->__toString();
        }

        if(!is_null($verifier_id)){
            $request_parameters['verifier_id'] = $verifier_id->__toString();
        }

        if(!is_null($gender)){
            $request_parameters['gender'] = $gender->__toString();
        }

	    if(!is_null($nationality)){
		    $request_parameters['nationality'] = $nationality->__toString();
	    }

        if(!is_null($country_code)){
            $request_parameters['country_code'] = $country_code->__toString();
        }


        if(!is_null($mobile_number)){
            $request_parameters['mobile_number'] = $mobile_number->__toString();
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

        if(!is_null($weekly_learning_hours)){
            $request_parameters['weekly_learning_hours'] = $weekly_learning_hours->__toInteger();
        }

	    if(!is_null($custom_fields_data)) {
		    $request_parameters['custom_fields_data'] = $custom_fields_data->__toString();
	    }

        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;
    }


	/**
	 * @param VO\Token        $token
	 * @param VO\ID           $member_apprenticeship_id
	 * @param VO\MemberID     $member_id
	 * @param VO\Integer|null $is_verifier
	 * @param VO\Integer|null $is_assessor
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function assign_member_apprenticeship_vip(
        VO\Token $token,
        VO\ID $member_apprenticeship_id,
        VO\MemberID $member_id,
        VO\Integer $is_verifier=null,
        VO\Integer $is_assessor=null
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/member/apprenticeship/assign/vip'),
            new VO\HTTP\Method('POST')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());
        $request_parameters = array(
            'member_apprenticeship_id'  => $member_apprenticeship_id->__toString(),
            'member_id'                 => $member_id->__toString()
        );

        if(!is_null($is_verifier)) {
            $request_parameters['is_verifier'] = $is_verifier->__toInteger();
        }
        if(!is_null($is_assessor)) {
            $request_parameters['is_assessor'] = $is_assessor->__toInteger();
        }
        $response = $request->send($request_parameters, $header_parameters);
        $data = $response->get_data();
        return $data;
    }

	/**
	 * Get Active Program Status for Employer Visualisation
	 * @param VO\Token               $token
	 * @param VO\Integer|null        $is_published
	 * @param VO\OrganisationID|null $organisation_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function getActiveOccupationForVisualisation(
		VO\Token $token,
		VO\OrganisationID $organisation_id,
		VO\Integer $is_published = null
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/list/occupation_viz'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array();
		$request_parameters['organisation_id'] = $organisation_id->__toString();
		if (!is_null($is_published)) {
			$request_parameters['is_published'] = $is_published->__toInteger();
		}

		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;

	}

	/**
	 * Get Active Learner Status for Employer Visualisation
	 * @param VO\Token               $token
	 * @param VO\OrganisationID|null $organisation_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function getActiveStudentForVisualisation(
		VO\Token $token,
		VO\OrganisationID $organisation_id
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/list/students_viz'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array();
		$request_parameters['organisation_id'] = $organisation_id->__toString();
		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * Get Top 7 Programme with maximum number of students with the progress of Students
	 * @param VO\Token               $token
	 * @param VO\OrganisationID|null $organisation_id
	 * @param VO\Integer|null $limit
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function getProgrammeProgressStatusForVisualisation(
		VO\Token $token,
		VO\OrganisationID $organisation_id,
		VO\Integer $limit = null,
		VO\Integer $per_page = null,
		VO\Integer $current_page = null
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/list/students_program_progress_viz'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array();
		$request_parameters['organisation_id'] = $organisation_id->__toString();
		if (!is_null($limit)) {
			$request_parameters['limit'] = $limit->__toInteger();
		}
		if (!is_null($per_page)) {
			$request_parameters['per_page'] = $per_page->__toInteger();
		}
		if (!is_null($current_page)) {
			$request_parameters['current_page'] = $current_page->__toInteger();
		}
		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * Get the Learner Weekly Login Details
	 * @param VO\Token          $token
	 * @param VO\OrganisationID $organisation_id
	 * @param VO\StringVO|null  $to_date
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function getLearnerWeeklyLoginForVisualisation(
		VO\Token $token,
		VO\OrganisationID $organisation_id,
		VO\StringVO $to_date = null
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/list/students_weekly_login_viz'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array();
		$request_parameters['organisation_id'] = $organisation_id->__toString();
		if (!is_null($to_date)) {
			$request_parameters['to_date'] = $to_date->__toString();
		}
		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * Get Learner Programmer Progress Details
	 *
	 * @param VO\Token          $token
	 * @param VO\OrganisationID $organisation_id
	 * @param VO\Integer|null   $apprenticeship
	 * @param VO\Integer|null   $phase
	 * @param VO\StringVO|null  $phase_status
	 * @param VO\StringVO|null  $search
	 * @param VO\Integer        $current_page
	 * @param VO\Integer|null   $is_export
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function getLearnerProgrammeProgressDetailsForVisualisation(
		VO\Token $token,
		VO\OrganisationID $organisation_id,
		VO\Integer $apprenticeship = null,
		VO\Integer $phase = null,
		VO\StringVO $phase_status = null,
		VO\StringVO $search = null,
		VO\Integer $per_page = null,
		VO\Integer $current_page,
		VO\Integer $is_export = null
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/list/students_programme_progress_details_viz'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array();
		$request_parameters['organisation_id'] = $organisation_id->__toString();
		if (!is_null($apprenticeship)) {
			$request_parameters['apprenticeship'] = $apprenticeship->__toInteger();
		}
		if (!is_null($phase)) {
			$request_parameters['phase'] = $phase->__toInteger();
			if (!is_null($phase_status)) {
				$request_parameters['phase_status'] = $phase_status->__toString();
			}
		}
		if (!is_null($search)) {
			$request_parameters['search'] = $search->__toString();
		}
		if (!is_null($per_page)) {
			$request_parameters['per_page'] = $per_page->__toInteger();
		}

		if(!is_null($is_export)){
			$request_parameters['is_export'] = $is_export->__toInteger();
		}

		$request_parameters['current_page'] = $current_page->__toInteger();
		$response = $request->send($request_parameters, $header_parameters);
		$data     = $response->get_data();
		return $data;
	}

	/**
	 * Get Learner Login Details for Visualisation
	 * @param VO\Token          $token
	 * @param VO\OrganisationID $organisation_id
	 * @param VO\Integer|null   $assessor
	 * @param VO\Integer|null   $verifier
	 * @param VO\StringVO|null  $from_date
	 * @param VO\StringVO|null  $to_date
	 * @param VO\StringVO|null  $search
	 * @param VO\Integer        $current_page
	 * @param VO\Integer        $csv
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function getLearnerLoginDetailsForVisualisation(
		VO\Token $token,
		VO\OrganisationID $organisation_id,
		VO\Integer $assessor = null,
		VO\Integer $verifier = null,
		VO\StringVO $from_date = null,
		VO\StringVO $to_date = null,
		VO\StringVO $search = null,
		VO\Integer $per_page = null,
		VO\Integer $current_page
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/list/students_login_details_viz'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array();
		$request_parameters['organisation_id'] = $organisation_id->__toString();
		if (!is_null($assessor)) {
			$request_parameters['assessor'] = $assessor->__toInteger();
		}
		if (!is_null($verifier)) {
			$request_parameters['verifier'] = $verifier->__toInteger();
		}
		if (!is_null($from_date)) {
			$request_parameters['from_date'] = $from_date->__toString();
		}
		if (!is_null($to_date)) {
			$request_parameters['to_date'] = $to_date->__toString();
		}
		if (!is_null($search)) {
			$request_parameters['search'] = $search->__toString();
		}
		if (!is_null($per_page)) {
			$request_parameters['per_page'] = $per_page->__toInteger();
		}
		$request_parameters['current_page'] = $current_page->__toInteger();
		$response = $request->send($request_parameters, $header_parameters);
		$data     = $response->get_data();
		return $data;
	}

	/**
	 * Get login logs of Learner and get assessor and verifier details
	 * @param VO\Token          $token
	 * @param VO\OrganisationID $organisation_id
	 * @param VO\Integer|null   $member
	 * @param VO\StringVO|null  $search
	 * @param VO\Integer        $current_page
	 * @param VO\Integer        $csv
	 */
	public function getLearnerLoginLogsForVisualisation(
		VO\Token $token,
		VO\OrganisationID $organisation_id,
		VO\Integer $member,
		VO\StringVO $search = null,
		VO\Integer $current_page,
		VO\Integer $per_page = null
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/list/students_login_logs_viz'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array();
		$request_parameters['organisation_id'] = $organisation_id->__toString();
		$request_parameters['member'] = $member->__toInteger();
		if (!is_null($search)) {
			$request_parameters['search'] = $search->__toString();
		}
		$request_parameters['current_page'] = $current_page->__toInteger();
		$response = $request->send($request_parameters, $header_parameters);
		$data     = $response->get_data();
		return $data;
	}

	/**
	 * Get Programme Detail
	 * @param VO\Token          $token
	 * @param VO\OrganisationID $organisation_id
	 * @param VO\Integer        $current_page
	 * @param VO\Integer|null   $per_page
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function getActiveProgramProgressDetailsForVisualization(
		VO\Token $token,
		VO\OrganisationID $organisation_id,
		VO\Integer $current_page,
		VO\Integer $per_page = null
	)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/list/occupation_progress_viz'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array();
		$request_parameters['organisation_id'] = $organisation_id->__toString();
		$request_parameters['current_page'] = $current_page->__toInteger();
		if (!is_null($per_page)) {
			$request_parameters['per_page'] = $per_page->__toInteger();
		}
		$response = $request->send($request_parameters, $header_parameters);
		$data     = $response->get_data();
		return $data;
	}

	
	/**
	 * Bulk Member Upload
	 * @param VO\Token          $token
	 * @param VO\OrganisationID $organisation_id
	 * @param VO\ApprenticeshipID        $apprenticeship_id
	 * @param VO\StringVO   $csvFile
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function importBulkMembers(
		VO\Token $token,
		VO\OrganisationID $organisation_id,
		VO\ApprenticeshipID $apprenticeship_id,
		VO\StringVO $csvFile
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/bulk/import_member_apprenticeship'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array(
			'organisation_id' 	=> $organisation_id->__toString(),
			'apprenticeship_id'	=> $apprenticeship_id->__toString(),
			'csvFile'			=> $csvFile->__toString()
		);
		$response = $request->send($request_parameters, $header_parameters);
		$data     = $response->get_data();
		return $data;

	}

	/**
	 * Assessor Inbox
	 * @param VO\Token                 $token
	 * @param VO\Integer               $current_page
	 * @param VO\Integer               $per_page
	 * @param VO\StringVO|null         $search
	 * @param VO\OrganisationID|null   $organisation_id
	 * @param VO\ApprenticeshipID|null $apprenticeship_id
	 * @param VO\MemberID|null         $assessor_id
	 * @param VO\MemberID|null         $verifier_id
	 * @param VO\OccupationID|null     $occupation_id
	 * @param VO\StringVO|null         $status
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function assessor_inbox(
        VO\Token $token,
        VO\Integer $current_page,
        VO\Integer $per_page,
        VO\StringVO $search = null,
        VO\OrganisationID $organisation_id = null,
        VO\ApprenticeshipID $apprenticeship_id = null,
        VO\MemberID $assessor_id = null,
        VO\MemberID $verifier_id = null,
	    VO\OccupationID $occupation_id = null,
		VO\StringVO $status = null
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/assessor/inbox'),
            new VO\HTTP\Method('POST')
        );


        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(
            'search'            => $search ? $search->__toString() : '',
            'current_page'      => $current_page->__toInteger(),
            'per_page'          => $per_page->__toInteger(),
            'organisation_id'   => $organisation_id ? $organisation_id->__toString() : '',
            'apprenticeship_id' => $apprenticeship_id ? $apprenticeship_id->__toString() : ''
        );

        if(!is_null($assessor_id)){
            $request_parameters['assessor_id'] = $assessor_id->__toString();
        }

        if(!is_null($verifier_id)){
            $request_parameters['verifier_id'] = $verifier_id->__toString();
        }

        if(!is_null($occupation_id)){
        	$request_parameters['occupation_id'] = $occupation_id->__toString();
        }

        if(!is_null($status)) {
	        $request_parameters['status'] = $status->__toString();
        }

        $response = $request->send($request_parameters, $header_parameters);
        $data = $response->get_data();

        return $data;
    }

	/**
	 * Get all program ids
	 * @param VO\Token          $token
	 * @param VO\OrganisationID $organisation_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function getAllProgramIds(
		VO\Token $token,
		VO\OrganisationID $organisation_id
	)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/list/occupation_ids'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString()
		);
		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * Preview Scorm Course
	 * @param VO\Token    $token
	 * @param VO\ID       $module_id
	 * @param VO\StringVO $callback_url
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function previewScormCourse(
		VO\Token $token,
		VO\ID $module_id,
		VO\StringVO $callback_url
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url . '/course/scorm/preview'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array(
			'module_id'         => $module_id->__toString(),
			'callback_url'      => $callback_url->__toString()
		);
		$response = $request->send($request_parameters, $header_parameters);
		return $response->get_data();
	}

	/**
	 * Get Course Details with Course ID
	 * @param VO\Token    $token
	 * @param VO\ID       $course_id
	 * @param VO\StringVO $callback_url
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function previewCourseDetailWithCourseId(
		VO\Token $token,
		VO\ID $course_id,
		VO\StringVO $callback_url
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url . '/consultiva/admin/course_detail'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array(
			'course_id'         => $course_id->__toString(),
			'callback_url'      => $callback_url->__toString()
		);
		$response = $request->send($request_parameters, $header_parameters);
		return $response->get_data();

	}

    /**
     * @param VO\Token          $token
     * @param VO\memberId $memberId
     *
     * @return \AcademyHQ\API\HTTP\Response\json
     * @throws VO\Exception\MethodNotAllowedException
     * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
     */
    public function deleteLearner(
        VO\Token $token,
        VO\ID $memberId
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/learner/delete'),
            new VO\HTTP\Method('POST')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());
        $request_parameters['member_id'] = $memberId->__toString();
        $response = $request->send($request_parameters, $header_parameters);
        return $response->get_data();

    }

    /**
     * @param VO\Token          $token
     * @param VO\apprenticeshipId $apprenticeshipId
     *
     * @return \AcademyHQ\API\HTTP\Response\json
     * @throws VO\Exception\MethodNotAllowedException
     * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
     */
    public function deleteMemberApprenticeship(
        VO\Token $token,
        VO\ID $apprenticeshipId
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/apprenticeship/delete'),
            new VO\HTTP\Method('POST')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());
        $request_parameters['apprenticeship_id'] = $apprenticeshipId->__toString();
        $response = $request->send($request_parameters, $header_parameters);
        return $response->get_data();

    }

    public function addQualityAssessor(
        VO\Token $token,
        VO\OrganisationID $organisation_id,
        VO\Name $name,
        VO\Email $email,
        VO\Flag $is_internal,
        VO\StringVO $profile_picture = null
    ){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/add/quality-assessor'),
            new VO\HTTP\Method('POST')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(
            'organisation_id' => $organisation_id->__toString(),
            'first_name'      => $name->get_first_name()->__toString(),
            'last_name'       => $name->get_last_name()->__toString(),
            'email'           => $email->__toString(),
            'is_internal'     => $is_internal->__toBool()
        );

        if(!is_null($profile_picture)){
            $request_parameters['profile_picture'] = $profile_picture->__toString();
        }
        $response = $request->send($request_parameters, $header_parameters);
        return $response->get_data();
    }

    public function updateMemberProgramDeadline(
        VO\Token $token,
        VO\MemberProgramID $member_program_id,
        VO\StringVO $deadline
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/update/member-program/deadline'),
            new VO\HTTP\Method('POST')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());
        $request_parameters = array(
            'member_program_id' => $member_program_id->__toString(),
            'deadline' => $deadline->__toString(),
        );
        $response = $request->send($request_parameters, $header_parameters);
        return $response->get_data();

    }

    public function updateMemberapprenticeshipDeadline(
        VO\Token $token,
        VO\ID $member_apprenticeship_id,
        VO\StringVO $deadline
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/update/member-apprenticeship/deadline'),
            new VO\HTTP\Method('POST')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());
        $request_parameters = array(
            'member_apprenticeship_id' => $member_apprenticeship_id->__toString(),
            'deadline' => $deadline->__toString(),
        );
        $response = $request->send($request_parameters, $header_parameters);
        return $response->get_data();

    }

}
