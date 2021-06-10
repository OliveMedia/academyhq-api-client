<?php

namespace AcademyHQ\API\Repository\OMA;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;

/**
 * Class OffSessionRepository
 *
 * @package AcademyHQ\API\Repository\OMA
 */
class OffSessionRepository extends BaseRepository
{

	/**
	 * OffSessionRepository constructor.
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
	 * Get Program Details
	 * @param VO\Integer $occupation_id
	 * @param VO\Integer $employer_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function get_occupation_details(
		VO\Integer $occupation_id,
		VO\Integer $employer_id=null
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/out_session/occupation/details'),
			new VO\HTTP\Method('POST')
		);
		$request_parameters = array(
			'occupation_id'     => $occupation_id->__toInteger(),
		);
		if(!is_null($employer_id)){
			$request_parameters['organisation_id'] = $employer_id->__toInteger();
		}

		$response = $request->send($request_parameters, null);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * @param VO\OrganisationID $employer_id
	 * @param VO\OccupationID   $occupation_id
	 * @param VO\MemberID|null  $assessor_id
	 * @param VO\Name           $name
	 * @param VO\StringVO|null  $gender
	 * @param VO\StringVO       $country_code
	 * @param VO\StringVO        $mobile_number
	 * @param VO\Email          $email
	 * @param VO\StringVO|null  $nationality
	 * @param VO\StringVO|null  $street
	 * @param VO\StringVO|null  $city
	 * @param VO\StringVO|null  $state
	 * @param VO\StringVO|null  $country
	 * @param VO\StringVO|null  $postal_code
	 * @param VO\Integer        $disability
	 * @param VO\StringVO|null  $image
	 * @param VO\MemberID|null  $verifier_id
	 * @param VO\StringVO|null  $employment
	 * @param VO\StringVO|null  $further_notes
	 * @param VO\StringVO|null  $disability_text
	 * @param VO\StringVO|null  $date_of_birth
	 * @param VO\Integer|null   $weekly_learning_hours
	 * @param VO\StringVO|null  $custom_fields_data
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function create_student(
		VO\OrganisationID $employer_id,
		VO\OccupationID $occupation_id,
		VO\MemberID $assessor_id = null,
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
		VO\Integer $weekly_learning_hours=null,
		VO\StringVO $custom_fields_data=null
	) {
		$request =new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/out_session/student/create'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'employer_id'       => $employer_id->__toString(),
			'occupation_id'     => $occupation_id->__toString(),
			'first_name'        => $name->get_first_name()->__toString(),
			'last_name'         => $name->get_last_name()->__toString(),
			'country_code'      => $country_code->__toString(),
			'mobile_number'     => $mobile_number->__toString(),
			'email'             => $email->__toString(),
			'disability'        => $disability->__toInteger()
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

		$response = $request->send($request_parameters, null);
		$data = $response->get_data();

		return $data;
	}

	/**
	 * Get Organisation details
	 * @param VO\OrganisationID $organisation_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function getOrganisationDetails(
		VO\OrganisationID $organisation_id
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/out_session/organisation/details'),
			new VO\HTTP\Method('POST')
		);
		$request_parameters = array(
			'organisation_id' => $organisation_id->__toString(),
		);
		$response = $request->send($request_parameters, null);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * Check if email address exists in AHQ database
	 * @param VO\Email $email
	 * @param VO\OrganisationID $organisation = null
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function checkIfEmailExistsInAHQ(
		VO\Email $email,
		VO\OrganisationID $organisation_id = null
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/out_session/check/existing/email/ahq'),
			new VO\HTTP\Method('POST')
		);
		$request_parameters = array(
			'email' => $email->__toString()
		);

		if(!is_null($organisation_id)){
			$request_parameters['organisation_id'] = $organisation_id->__toString();
		}
		$response = $request->send($request_parameters);
		$data = $response->get_data();
		return $data;

	}
	public function checkOrganizationPlan(
        VO\OrganisationID $organization_id
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/out_session/check/check_organization_plan'),
            new VO\HTTP\Method('POST')
        );
        $request_parameters = array(
            'organization_id' => $organization_id->__toString()
        );
        $response = $request->send($request_parameters);
        $data = $response->get_data();

        return $data;
    }

	/**
	 * Create Member Apprenticeships
	 * @param VO\ApprenticeshipID $apprenticeship_id
	 * @param VO\MemberID         $member_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function create_student_from_member(
		VO\ApprenticeshipID $apprenticeship_id,
		VO\MemberID $member_id
	) {
		$request =new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/out_session/create/member/apprenticeship'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'apprenticeship_id' => $apprenticeship_id->__toString(),
			'member_id'         => $member_id->__toString()
		);

		$response = $request->send($request_parameters, null);

		$data = $response->get_data();

		return $data;
	}

	/**
	 * @param VO\OccupationID $occupation_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function get_occupation_program_details(
		VO\OccupationID $occupation_id
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/out_session/occupation/program/details'),
			new VO\HTTP\Method('POST')
		);
		$request_parameters = array(
			'occupation_id'     => $occupation_id->__toString()
		);

		$response = $request->send($request_parameters, null);
		$data = $response->get_data();
		return $data;
	}


	/**
	 * @param VO\OrganisationID $organisation_id
	 * @param VO\OccupationID   $parent_occupation_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function checkOccupationExist(
        VO\OrganisationID $organisation_id,
        VO\OccupationID $parent_occupation_id
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/out_session/check/occupation/exist'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'organisation_id'      => $organisation_id->__toString(),
            'parent_occupation_id' => $parent_occupation_id->__toString()
        );

        $response = $request->send($request_parameters, null);
        $data = $response->get_data();
        return $data;
    }


	/**
	 * @param VO\OccupationID $occupation_id
	 * @param VO\Integer      $total_seats
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function addOccupationSeat(
        VO\OccupationID $occupation_id,
        VO\Integer $total_seats
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/out_session/add/occupation/seat'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'occupation_id'     => $occupation_id->__toString(),
            'total_seats'		=> $total_seats->__toInteger()
        );

        $response = $request->send($request_parameters, null);
        $data = $response->get_data();
        return $data;
    }

	/**
	 * @param VO\Integer $occupation_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function occupationProgramDetails(
	    VO\Integer $occupation_id
    ) {
	    $request = new Request(
		    new GuzzleClient,
		    $this->credentials,
		    VO\HTTP\Url::fromNative($this->base_url.'/out_session/get/occupation/programs/details'),
		    new VO\HTTP\Method('POST')
	    );
	    $request_parameters = array(
		    'occupation_id' => $occupation_id->__toInteger(),
	    );
	    $response = $request->send($request_parameters, null);
	    $data = $response->get_data();
	    return $data;
    }

	/**
	 * @param VO\StringVO          $name
	 * @param VO\OrganisationID    $organisation_id
	 * @param VO\StringVO|null     $description
	 * @param VO\StringVO|null     $logo
	 * @param VO\Integer|null      $occupation_id
	 * @param VO\Integer|null      $has_weeks
	 * @param VO\Integer|null      $weeks
	 * @param VO\StringVO|null     $banner_image
	 * @param VO\StringVO|null     $banner_description
	 * @param VO\StringVO|null     $subject
	 * @param VO\StringVO|null     $signature
	 * @param VO\StringVO|null     $body
	 * @param VO\Flag|null         $is_unlimited
	 * @param VO\OccupationID|null $parent_occupation_id
	 * @param VO\Integer|null      $no_of_seats
	 * @param VO\Integer|null      $duration
	 * @param VO\Flag|null         $lock_after_duration
	 * @param VO\StringVO|null     $start_duration_after
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function createOccupation(
		VO\StringVO $name,
		VO\OrganisationID $organisation_id,
		VO\StringVO $description = null,
		VO\StringVO $logo = null,
		VO\Integer $occupation_id = null,
		VO\Integer $has_weeks = null,
		VO\Integer $weeks = null,
		VO\StringVO $banner_image = null,
		VO\StringVO $banner_description = null,
		VO\StringVO $subject = null,
		VO\StringVO $signature = null,
		VO\StringVO $body = null,
		VO\Flag $is_unlimited = null,
		VO\OccupationID $parent_occupation_id = null,
		VO\Integer $no_of_seats = null,
		VO\Integer $duration = null,
		VO\Flag $lock_after_duration = null,
		VO\StringVO $start_duration_after = null
	) {
		$request =new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/out_session/create/occupation'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'name'              => $name->__toString(),
			'organisation_id'   => $organisation_id->__toString()
		);
		if(!is_null($description)){
			$request_parameters['description'] = $description->__toString();
		}
		if(!is_null($logo)){
			$request_parameters['logo'] = $logo->__toString();
		}
		if(!is_null($has_weeks)) {
			$request_parameters['has_weeks'] = $has_weeks->__toInteger();
		}
		if(!is_null($weeks)) {
			$request_parameters['weeks'] = $weeks->__toInteger();
		}
		if(!is_null($occupation_id)){
			$request_parameters['occupation_id'] = $occupation_id->__toInteger();
		}
		if(!is_null($banner_image)){
			$request_parameters['banner_image'] = $banner_image->__toString();
		}
		if(!is_null($banner_description)){
			$request_parameters['banner_description'] = $banner_description->__toString();
		}
		if(!is_null($subject)){
			$request_parameters['subject'] = $subject->__toString();
		}
		if(!is_null($signature)){
			$request_parameters['signature'] = $signature->__toString();
		}
		if(!is_null($body)){
			$request_parameters['body'] = $body->__toString();
		}
		if(!is_null($is_unlimited)){
			$request_parameters['is_unlimited'] = $is_unlimited->__toBool();
		}
		if(!is_null($parent_occupation_id)){
			$request_parameters['parent_occupation_id'] = $parent_occupation_id->__toString();
		}
		if(!is_null($no_of_seats)){
			$request_parameters['no_of_seats'] = $no_of_seats->__toInteger();
		}
		if(!is_null($duration)){
			$request_parameters['duration'] = $duration->__toInteger();
		}
		if(!is_null($lock_after_duration)){
			$request_parameters['lock_after_duration'] = $lock_after_duration->__toBool();
		}
		if(!is_null($start_duration_after)){
			$request_parameters['start_duration_after'] = $start_duration_after->__toString();
		}
		$response = $request->send($request_parameters, null);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * Create Program
	 * @param VO\StringVO       $name
	 * @param VO\OrganisationID $organisation_id
	 * @param VO\StringVO|null  $description
	 * @param VO\StringVO|null  $should_start_by
	 * @param VO\StringVO|null  $should_end_by
	 * @param VO\Integer|null   $off_the_job_training
	 * @param VO\Integer|null   $required_hours
	 * @param VO\Integer|null   $program_id
	 * @param VO\StringVO|null  $behavior
	 * @param VO\StringVO|null  $endpoint
	 * @param VO\StringVO|null  $final_review
	 * @param VO\StringVO|null  $gateway
	 * @param VO\Integer|null   $duration
	 * @param VO\Integer|null   $holidays
	 * @param VO\StringVO|null  $journal
	 * @param VO\StringVO|null  $skill
	 * @param VO\StringVO|null  $knowledge
	 * @param VO\StringVO|null  $score
	 * @param VO\StringVO|null  $video
	 * @param VO\StringVO|null  $week
	 * @param VO\StringVO|null  $day
	 * @param VO\StringVO|null  $pdp
	 * @param VO\StringVO|null  $documentation
	 * @param VO\StringVO|null  $gap_template
	 * @param VO\StringVO|null  $program_image
	 * @param VO\StringVO|null  $is_communication_forum
	 * @param VO\StringVO|null  $phase_title
	 * @param VO\Integer|null   $on_the_job_training
	 * @param VO\Integer|null   $on_the_job_training_required_hours
	 * @param VO\Integer|null   $off_the_job_training_usa
	 * @param VO\Integer|null   $off_the_job_training_usa_required_hours
	 * @param VO\Flag|null      $editable
	 * @param VO\Integer|null   $program_duration
	 * @param VO\Flag|null      $lock_after_program_duration
	 * @param VO\StringVO|null  $start_duration_after
	 * @param VO\Flag|null      $editable
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function createProgram(
		VO\StringVO $name,
		VO\OrganisationID $organisation_id,
		VO\StringVO $description = null,
		VO\StringVO $should_start_by = null,
		VO\StringVO $should_end_by = null,
		VO\Integer $off_the_job_training = null,
		VO\Integer $required_hours = null,
		VO\Integer $program_id = null,
		VO\StringVO $behavior = null,
		VO\StringVO $endpoint = null,
		VO\StringVO $final_review = null,
		VO\StringVO $gateway = null,
		VO\Integer $duration = null,
		VO\Integer $holidays = null,
		VO\StringVO $journal = null,
		VO\StringVO $skill = null,
		VO\StringVO $knowledge = null,
		VO\StringVO $score = null,
		VO\StringVO $video = null,
		VO\StringVO $week = null,
		VO\StringVO $day = null,
		VO\StringVO $pdp = null,
		VO\StringVO $documentation = null,
		VO\StringVO $gap_template = null,
		VO\StringVO $program_image = null,
		VO\StringVO $is_communication_forum = null,
		VO\StringVO $phase_title = null,
		VO\Integer $on_the_job_training = null,
		VO\Integer $on_the_job_training_required_hours = null,
		VO\Integer $off_the_job_training_usa = null,
		VO\Integer $off_the_job_training_usa_required_hours = null,
		VO\Flag $editable = null,
		VO\Integer $program_duration = null,
		VO\Flag $lock_after_program_duration = null,
		VO\StringVO $start_duration_after = null,
		VO\Flag $editable = null
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/out_session/create/program'),
			new VO\HTTP\Method('POST')
		);
		$request_parameters = array(
			'name'              => $name->__toString(),
			'organisation_id'   => $organisation_id->__toString(),
			'should_start_by'   => !is_null($should_start_by) ? $should_start_by->__toString() : '',
			'should_end_by'     => !is_null($should_end_by) ? $should_end_by->__toString() : ''
		);

		if(!is_null($description)){
			$request_parameters['description'] = $description->__toString();
		}

		if(!is_null($off_the_job_training)){
			$request_parameters['off_the_job_training'] = $off_the_job_training->__toInteger();
		}

		if(!is_null($required_hours)){
			$request_parameters['required_hours'] = $required_hours->__toInteger();
		}

		if(!is_null($duration)){
			$request_parameters['duration'] = $duration->__toInteger();
		}

		if(!is_null($holidays)){
			$request_parameters['holidays'] = $holidays->__toInteger();
		}

		if(!is_null($behavior)){
			$request_parameters['behavior'] = $behavior->__toString();
		}

		if(!is_null($endpoint)){
			$request_parameters['endpoint'] = $endpoint->__toString();
		}

		if(!is_null($gateway)){
			$request_parameters['gateway'] = $gateway->__toString();
		}

		if(!is_null($final_review)){
			$request_parameters['final_review'] = $final_review->__toString();
		}

		if(!is_null($journal)){
			$request_parameters['journal'] = $journal->__toString();
		}

		if(!is_null($skill)){
			$request_parameters['skill'] = $skill->__toString();
		}

		if(!is_null($knowledge)){
			$request_parameters['knowledge'] = $knowledge->__toString();
		}

		if(!is_null($score)){
			$request_parameters['score'] = $score->__toString();
		}

		if(!is_null($video)){
			$request_parameters['video'] = $video->__toString();
		}

		if(!is_null($week)){
			$request_parameters['week'] = $week->__toString();
		}

		if(!is_null($day)){
			$request_parameters['day'] = $day->__toString();
		}

		if(!is_null($pdp)){
			$request_parameters['pdp'] = $pdp->__toString();
		}
		if(!is_null($documentation)){
			$request_parameters['documentation'] = $documentation->__toString();
		}
		if(!is_null($gap_template)){
			$request_parameters['gap_template'] = $gap_template->__toString();
		}
		if(!is_null($program_id)){
			$request_parameters['program_id'] = $program_id->__toInteger();
		}
		if(!is_null($program_image)){
			$request_parameters['program_image'] = $program_image->__toString();
		}
		if(!is_null($is_communication_forum)){
			$request_parameters['is_communication_forum'] = $is_communication_forum->__toString();
		}
		if(!is_null($phase_title)){
			$request_parameters['phase_title'] = $phase_title->__toString();
		}
		/**
		 * On Thee Job Meter
		 */
		if(!is_null($on_the_job_training)){
			$request_parameters['on_the_job_training'] = $on_the_job_training->__toInteger();
		}

		if(!is_null($on_the_job_training_required_hours)){
			$request_parameters['on_the_job_training_required_hours'] = $on_the_job_training_required_hours->__toInteger();
		}

		/**
		 * Off The Job Training USA
		 */
		if(!is_null($off_the_job_training_usa)){
			$request_parameters['off_the_job_training_usa'] = $off_the_job_training_usa->__toInteger();
		}
		if(!is_null($off_the_job_training_usa_required_hours)){
			$request_parameters['off_the_job_training_usa_required_hours'] = $off_the_job_training_usa_required_hours->__toInteger();
		}
		if(!is_null($editable)){
			$request_parameters['editable'] = $editable->__toBool();
		}
		if(!is_null($program_duration)){
			$request_parameters['program_duration'] = $program_duration->__toInteger();
		}
		if(!is_null($lock_after_program_duration)){
			$request_parameters['lock_after_program_duration'] = $lock_after_program_duration->__toBool();
		}

		if(!is_null($start_duration_after)){
			$request_parameters['start_duration_after'] = $start_duration_after->__toString();
		}
		if(!is_null($editable)){
			$request_parameters['editable'] = $editable->__toBool();
		}

		$response = $request->send($request_parameters, null);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * Create Occupation Program
	 * @param VO\Integer $occupation_id
	 * @param VO\Integer $program_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function createOccupationProgram(
		VO\Integer $occupation_id,
		VO\Integer $program_id

	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/out_session/create/occupation/program'),
			new VO\HTTP\Method('POST')
		);
		$request_parameters = array(
			'occupation_id' => $occupation_id->__toInteger(),
			'program_id'    => $program_id->__toInteger(),
		);
		$response = $request->send($request_parameters, null);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * Create Program Course
	 * @param VO\Integer       $program_id
	 * @param VO\CourseIDArray $courses_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function createProgramCourse(
		VO\Integer $program_id,
		VO\CourseIDArray $courses_id

	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/out_session/create/program/course'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'program_id'    => $program_id->__toInteger(),
			'courses_id'    => $courses_id->__toArray(),
		);

		$response = $request->send($request_parameters, null);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * Create On The Job Phase
	 * @param VO\Integer        $program_id
	 * @param VO\StringVO       $on_the_job_id
	 * @param VO\Integer|null   $member_apprenticeship_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function createOnTheJobPhase(
		VO\Integer $program_id,
		VO\StringVO $on_the_job_id,
		VO\Integer $member_apprenticeship_id = null
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/out_session/create/program/on/the/job/training'),
			new VO\HTTP\Method('POST')
		);
		$request_parameters = array(
			'program_id'        => $program_id->__toInteger(),
			'on_the_job_id'     => $on_the_job_id->__toString()
		);
		if (!is_null($member_apprenticeship_id)) {
			$request_parameters['member_apprenticeship_id'] = $member_apprenticeship_id->__toInteger();
		}
		$response = $request->send($request_parameters, null);
		$data     = $response->get_data();
		return $data;

	}

	/**
	 * Create Program Welcome Resource
	 * @param VO\StringVo      $name
	 * @param VO\Integer       $program_id
	 * @param VO\StringVo      $document
	 * @param VO\StringVo|null $description
	 * @param VO\StringVo      $link
	 * @param VO\ID|null       $welcome_resource_id
	 * @param VO\StringVo|null $video
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function createProgramWelcomeResource(
		VO\StringVO $name,
		VO\Integer $program_id,
		VO\StringVO $document,
		VO\StringVO $description = null,
		VO\StringVO $link,
		VO\ID $welcome_resource_id = null,
		VO\StringVO $video = null
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/out_session/create/program/welcome_resource'),
			new VO\HTTP\Method('POST')
		);
		$request_parameters = array(
			'name'          => $name->__toString(),
			'program_id'    => $program_id->__toInteger(),
			'document'      => $document->__toString(),
			'link'          => $link->__toString()
		);
		if(!is_null($description)){
			$request_parameters['description'] = $description->__toString();
		}

		if(!is_null($video)){
			$request_parameters['video'] = $video->__toString();
		}

		if(!is_null($welcome_resource_id)){
			$request_parameters['welcome_resourse_id'] = $welcome_resource_id->__toString();
		}
		$response = $request->send($request_parameters, null);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * Create Program Unit
	 * @param VO\StringVo      $name
	 * @param VO\StringVO|null $header
	 * @param VO\StringVO|null $description
	 * @param VO\Integer       $is_evidence_required
	 * @param VO\Integer       $image
	 * @param VO\Integer       $video
	 * @param VO\Integer       $attachment
	 * @param VO\Integer       $program_id
	 * @param VO\Integer|null  $program_unit_id
	 * @param VO\Integer|null  $parent_unit_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function createProgramUnit(
		VO\StringVO $name,
		VO\StringVO $header = null,
		VO\StringVO $description = null,
		VO\Integer $is_evidence_required,
		VO\Integer $image,
		VO\Integer $video,
		VO\Integer $attachment,
		VO\Integer $program_id,
		VO\Integer $program_unit_id = null,
		VO\Integer $parent_unit_id = null
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/out_session/create/program/unit'),
			new VO\HTTP\Method('POST')
		);
		$request_parameters = array(
			'name'                  => $name->__toString(),
			'is_evidence_required'  => $is_evidence_required->__toInteger(),
			'image'                 => $image->__toInteger(),
			'video'                 => $video->__toInteger(),
			'attachment'            => $attachment->__toInteger(),
			'program_id'            => $program_id->__toInteger(),
		);
		if(!is_null($header)){
			$request_parameters['header'] = $header->__toString();
		}

		if(!is_null($description)){
			$request_parameters['description'] = $description->__toString();
		}

		if(!is_null($program_unit_id)){
			$request_parameters['program_unit_id'] = $program_unit_id->__toInteger();
		}

		if(!is_null($parent_unit_id)){
			$request_parameters['parent_unit_id'] = $parent_unit_id->__toInteger();
		}

		$response = $request->send($request_parameters, null);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * @param VO\OrganisationID $organisation_id
	 * @param VO\CourseIDArray  $courses_ids
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function licenseCheckOrMake(
		VO\OrganisationID $organisation_id,
		VO\CourseIDArray $courses_ids
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/out_session/check_or_make/license'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'organisation_id'      => $organisation_id->__toString(),
			'courses_ids'       => $courses_ids->__toArray()
		);

		$response = $request->send($request_parameters, null);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * Create Off The Job USA Phase
	 * @param VO\Integer        $program_id
	 * @param VO\StringVO       $off_the_job_usa_id
	 * @param VO\Integer|null   $member_apprenticeship_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function createOffTheJobUSAPhase(
		VO\Integer $program_id,
		VO\StringVO $off_the_job_usa_id,
		VO\Integer $member_apprenticeship_id = null
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/out_session/create/program/off/the/job/training/usa'),
			new VO\HTTP\Method('POST')
		);
		$request_parameters = array(
			'program_id'            => $program_id->__toInteger(),
			'off_the_job_usa_id'    => $off_the_job_usa_id->__toString()
		);
		if (!is_null($member_apprenticeship_id)) {
			$request_parameters['member_apprenticeship_id'] = $member_apprenticeship_id->__toInteger();
		}
		$response = $request->send($request_parameters, null);
		$data     = $response->get_data();
		return $data;

	}

	/**
	 * @param VO\OrganisationID $organisation_id
	 * @param VO\OccupationID   $occupation_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function checkOccupationExistsForOrganisation(
		VO\OrganisationID $organisation_id,
		VO\OccupationID $occupation_id
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/out_session/check/occupation/exist_for_organisation'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'organisation_id'       => $organisation_id->__toString(),
			'occupation_id'         => $occupation_id->__toString()
		);

		$response = $request->send($request_parameters, null);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * @param VO\OccupationID $occupation_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function makeOccupationUnlimitedSeats(
		VO\OccupationID $occupation_id
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative( $this->base_url . '/out_session/add/occupation/unlimited_seats' ),
			new VO\HTTP\Method( 'POST' )
		);

		$request_parameters = array(
			'occupation_id' => $occupation_id->__toString()
		);

		$response = $request->send( $request_parameters, null );
		$data     = $response->get_data();

		return $data;
	}

}
