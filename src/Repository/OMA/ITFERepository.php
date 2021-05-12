<?php

namespace AcademyHQ\API\Repository\OMA;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;

/**
 * Class ITFERepository
 *
 * @package AcademyHQ\API\Repository\OMA
 */
class ITFERepository extends BaseRepository
{

	/**
	 * ITFERepository constructor.
	 *
	 * @param Credentials $credentials
	 */
	public function __construct(Credentials $credentials)
	{
		parent::__construct();
		$this->credentials = $credentials;
        $this->app_url = isset($_SERVER['APP_URL']) ? $_SERVER['APP_URL'] : null;
		$this->base_url .= '/oma';
	}

	/*
		Fetch all enrolments completed after the last_sent_at date under provided organisation
		@params : organisation_id, last_sent_at
	*/
	public function recentEnrolments(
        VO\Integer $organisation_id,
        VO\StringVO $last_sent_at
        ){
        $request = new Request(
                new GuzzleClient,
                $this->credentials,
                VO\HTTP\Url::fromNative($this->base_url . '/itfe/recent/enrolments'),
                new VO\HTTP\Method('POST')
            );
        $request_parameters = array(
            'organisation_id' => $organisation_id->__toInteger(),
            'last_sent_at' => $last_sent_at->__toString(),
        );
        $response = $request->send($request_parameters);
        $data = $response->get_data();
        return $data;
    }

    /*
        Fetch details of member apprenticeships with provided information
        @params : employer_name, program_name, student_name
    */
    public function apprenticeshipReport(
        VO\StringVO $employer_name,
        VO\StringVO $program_name,
        VO\StringVO $student_name
        ){
        $request = new Request(
                new GuzzleClient,
                $this->credentials,
                VO\HTTP\Url::fromNative($this->base_url . '/itfe/apprenticeship-report'),
                new VO\HTTP\Method('POST')
            );
        $request_parameters = array(
            'employer_name' => $employer_name->__toString(),
            'program_name' => $program_name->__toString(),
            'student_name' => $student_name->__toString()
        );
        $response = $request->send($request_parameters);
        $data = $response->get_data();
        return $data;
    }

    /*
        Optional program_id as array
        get array of program_id with summative assessment phase's id
    */
    public function getProgramIdWithSummativeAsessmentPhase(
        VO\StringVO $program_id =null
    ) {
        $request = new Request(
                new GuzzleClient,
                $this->credentials,
                VO\HTTP\Url::fromNative($this->base_url . '/itfe/summative-assessments'),
                new VO\HTTP\Method('POST')
            );
        $request_parameters = array();

        if(isset($program_id)) {
            $request_parameters['program_id'] = $program_id->__toString();
        }


        $response = $request->send($request_parameters);
        $data = $response->get_data();
        return $data;
    }

    /*
        Pass bulk members from itfe to ahq and check validation in ahq itself
    */
    public function addItfeLearner(
        VO\StringVO $memberData =null
    ){
        $request = new Request(
                new GuzzleClient,
                $this->credentials,
                VO\HTTP\Url::fromNative($this->base_url . '/itfe/add/bulk/learner'),
                new VO\HTTP\Method('POST')
            );
        $request_parameters = array();

        if(isset($memberData)) {
            $request_parameters['memberData'] = $memberData->__toString();
        }


        $response = $request->send($request_parameters);
        $data = $response->get_data();
        return $data;
    }

    /*
        Enroll itfe learners to associated program
    */
    public function enrollItfeLearner(
        VO\Integer $member_id =null,
        VO\Integer $occupation_id =null,
        VO\Integer $organisation_id =null
    ){
        $request = new Request(
                new GuzzleClient,
                $this->credentials,
                VO\HTTP\Url::fromNative($this->base_url . '/itfe/learner/enroll'),
                new VO\HTTP\Method('POST')
            );
        $request_parameters = array();

        if(isset($member_id)) {
            $request_parameters['member_id'] = $member_id->__toInteger();
        }

        if(isset($occupation_id)) {
            $request_parameters['occupation_id'] = $occupation_id->__toInteger();
        }

        if(isset($organisation_id)) {
            $request_parameters['organisation_id'] = $organisation_id->__toInteger();
        }

        if($this->app_url){
            $request_parameters['app_url'] = $this->app_url;
        }

        $response = $request->send($request_parameters);
        $data = $response->get_data();
        return $data;
    }

    /*
        Get enrolments completed in ahq
    */
    public function jrEnrolmentUpdate(
        VO\StringVO $itfe_employer_ids =null,
        VO\StringVO $summative_asessment_ids =null,
        VO\StringVO $days =null
    ){
        $request = new Request(
                new GuzzleClient,
                $this->credentials,
                VO\HTTP\Url::fromNative($this->base_url . '/itfe/get/completed/enrolments'),
                new VO\HTTP\Method('POST')
            );
        $request_parameters = array();

        if(isset($itfe_employer_ids)) {
            $request_parameters['itfe_employer_ids'] = $itfe_employer_ids->__toString();
        }

        if(isset($summative_asessment_ids)) {
            $request_parameters['summative_asessment_ids'] = $summative_asessment_ids->__toString();
        }

        if(isset($days)) {
            $request_parameters['days'] = $days->__toString();
        }


        $response = $request->send($request_parameters);
        $data = $response->get_data();
        return $data;
    }
}
