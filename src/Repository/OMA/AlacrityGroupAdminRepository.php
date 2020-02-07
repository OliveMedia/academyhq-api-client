<?php

namespace AcademyHQ\API\Repository\OMA;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use App\AHQService\ApprenticeshipService;
use App\Helpers\Log;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;

/**
 * Class AlacrityGroupAdminRepository
 *
 * @package AcademyHQ\API\Repository\OMA
 */
class AlacrityGroupAdminRepository extends BaseRepository
{

	/**
	 * AlacrityGroupAdminRepository constructor.
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
	 * List Employer
	 * @param VO\Token         $token
	 * @param VO\StringVO|null $search
	 * @param VO\Integer       $current_page
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function ListConsultiva(
		VO\Token $token,
		VO\StringVO $search = null,
		VO\Integer $current_page
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/list/consultiva'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'search'        => $search ? $search->__toString() : '',
			'current_page'  => $current_page->__toInteger()
		);
		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	/**
	 * List Occupation
	 * @param VO\Token               $token
	 * @param VO\Integer             $current_page
	 * @param VO\StringVO|null       $search
	 * @param VO\Integer|null        $is_published
	 * @param VO\OrganisationID|null $organisation_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function listOccupation(
		VO\Token $token,
		VO\Integer $current_page,
		VO\StringVO $search = null,
		VO\Integer $is_published = null,
		VO\OrganisationID $organisation_id = null
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/list/occupation'),
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

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	/**
	 * List License
	 * @param VO\Token         $token
	 * @param VO\StringVO|null $search
	 * @param VO\Integer       $current_page
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function listLicence(
		VO\Token $token,
		VO\StringVO $search = null,
		VO\Integer $current_page
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/list/license'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array(
			'search'        => $search ? $search->__toString() : '',
			'current_page'  => $current_page->__toInteger(),
		);

		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * List Audit Form
	 * @param VO\Token         $token
	 * @param VO\StringVO|null $search
	 * @param VO\Integer       $current_page
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function listAudit(
		VO\Token $token,
		VO\StringVO $search = null,
		VO\Integer $current_page
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/list/audit_form'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array(
			'search'        => $search ? $search->__toString() : '',
			'current_page'  => $current_page->__toInteger(),
		);
		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * Create Employer
	 * @param VO\Token          $token
	 * @param VO\Email          $email
	 * @param VO\StringVO       $employer_name
	 * @param VO\Name           $name
	 * @param VO\TaxNumber|null $tax_number
	 * @param VO\StringVO|null  $image_url
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function createEmployer(
		VO\Token $token,
		VO\Email $email,
		VO\StringVO $employer_name,
		VO\Name $name,
		VO\TaxNumber $tax_number=null,
		VO\StringVO $image_url = null
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/create/consultiva'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'email'         => $email->__toString(),
			'employer_name' => $employer_name->__toString(),
			'first_name'    => $name->get_first_name()->__toString(),
			'last_name'     => $name->get_last_name()->__toString(),
		);

		if(!is_null($tax_number)) {
			$request_parameters['tax_number'] = $tax_number->__toString();
		}
		if(!is_null($image_url)) {
			$request_parameters['image_url'] = $image_url->__toString(); 
		}
		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * Create Apprenticeship
	 * @param VO\Token             $token
	 * @param VO\OrganisationID    $employer_id
	 * @param VO\OccupationIDArray $occupations_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function createApprenticeship(
		VO\Token $token,
		VO\OrganisationID $employer_id,
		VO\OccupationIDArray $occupations_id
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/create/apprenticeship'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'employer_id'       => $employer_id->__toString(),
			'occupations_id'    => $occupations_id->__toArray()
		);
		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();

		return $data;
	}

	/**
	 * Create Occupation
	 * @param VO\Token         $token
	 * @param VO\StringVO      $name
	 * @param VO\StringVO|null $description
	 * @param VO\StringVO|null $logo
	 * @param VO\Integer|null  $occupation_id
	 * @param VO\Integer|null  $has_weeks
	 * @param VO\Integer|null  $weeks
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function createOccupation(
		VO\Token $token,
		VO\StringVO $name,
		VO\StringVO $description = null,
		VO\StringVO $logo = null,
		VO\Integer $occupation_id = null,
		VO\Integer $has_weeks = null,
		VO\Integer $weeks = null
	) {
		$request =new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/create/occupation'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array(
			'name' => $name->__toString(),
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
		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * Create Program
	 * @param VO\Token         $token
	 * @param VO\StringVO      $name
	 * @param VO\StringVO|null $description
	 * @param VO\StringVO|null $should_start_by
	 * @param VO\StringVO|null $should_end_by
	 * @param VO\Integer|null  $off_the_job_training
	 * @param VO\Integer|null  $required_hours
	 * @param VO\Integer|null  $program_id
	 * @param VO\StringVO|null $behavior
	 * @param VO\StringVO|null $endpoint
	 * @param VO\StringVO|null $final_review
	 * @param VO\StringVO|null $gateway
	 * @param VO\Integer|null  $duration
	 * @param VO\Integer|null  $holidays
	 * @param VO\StringVO|null $journal
	 * @param VO\StringVO|null $skill
	 * @param VO\StringVO|null $knowledge
	 * @param VO\StringVO|null $score
	 * @param VO\StringVO|null $video
	 * @param VO\StringVO|null $week
	 * @param VO\StringVO|null $day
	 * @param VO\StringVO|null $pdp
	 * @param VO\StringVO|null $documentation
	 * @param VO\StringVO|null $gap_template
	 * @param VO\StringVO|null $program_image
	 * @param VO\StringVO|null $is_communication_forum
	 * @param VO\StringVO|null $phase_title
	 * @param VO\Integer|null  $on_the_job_training
	 * @param VO\Integer|null  $on_the_job_training_required_hours
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function createProgram(
		VO\Token $token,
		VO\StringVO $name,
		VO\StringVO $description = null,
		VO\StringVO $should_start_by = null,
		VO\StringVO $should_end_by = null,
		VO\Integer $off_the_job_training = null,
		VO\Integer $required_hours = null,
		VO\Integer $program_id = null,
		VO\StringVO $behavior=null,
		VO\StringVO $endpoint=null,
		VO\StringVO $final_review=null,
		VO\StringVO $gateway=null,
        VO\Integer $duration=null,
        VO\Integer $holidays=null,
        VO\StringVO $journal=null,
        VO\StringVO $skill=null,
        VO\StringVO $knowledge=null,
		VO\StringVO $score=null,
		VO\StringVO $video=null,
		VO\StringVO $week=null,
		VO\StringVO $day=null,
		VO\StringVO $pdp=null,
		VO\StringVO $documentation=null,
		VO\StringVO $gap_template=null,
		VO\StringVO $program_image=null,
		VO\StringVO $is_communication_forum=null,
		VO\StringVO $phase_title=null,
		VO\Integer $on_the_job_training = null,
		VO\Integer $on_the_job_training_required_hours = null
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/create/program'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array(
			'name' => $name->__toString()
		);

		if(!is_null($description)){
			$request_parameters['description'] = $description->__toString();
		}

		if(!is_null($should_start_by)){
			$request_parameters['should_start_by'] = $should_start_by->__toString();
		}

		if(!is_null($should_end_by)){
			$request_parameters['should_end_by'] = $should_end_by->__toString();
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
		if(!is_null($on_the_job_training)){
			$request_parameters['on_the_job_training'] = $on_the_job_training->__toInteger();
		}

		if(!is_null($on_the_job_training_required_hours)){
			$request_parameters['on_the_job_training_required_hours'] = $on_the_job_training_required_hours->__toInteger();
		}
		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * Create Program Course
	 * @param VO\Token         $token
	 * @param VO\Integer       $program_id
	 * @param VO\CourseIDArray $courses_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function createProgramCourse(
		VO\Token $token,
		VO\Integer $program_id,
		VO\CourseIDArray $courses_id

	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/create/program/course'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'program_id'    => $program_id->__toInteger(),
			'courses_id'    => $courses_id->__toArray(),
		);

		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * Create Program Audit Form
	 * @param VO\Token        $token
	 * @param VO\Integer      $program_id
	 * @param VO\IntegerArray $audit_forms_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function createProgramAudit(
		VO\Token $token,
		VO\Integer $program_id,
		VO\IntegerArray $audit_forms_id
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/create/program/audit'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'program_id'        => $program_id->__toInteger(),
			'audit_forms_id'    => $audit_forms_id->__toArray(),
		);
		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * Create Occupation Program
	 * @param VO\Token   $token
	 * @param VO\Integer $occupation_id
	 * @param VO\Integer $program_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function createOccupationProgram(
		VO\Token $token,
		VO\Integer $occupation_id,
		VO\Integer $program_id

	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/create/occupation/program'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array(
			'occupation_id' => $occupation_id->__toInteger(),
			'program_id'    => $program_id->__toInteger(),
		);
		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * Create Program Unit
	 * @param VO\Token         $token
	 * @param VO\StringVo      $name
	 * @param VO\StringVo|null $header
	 * @param VO\StringVo|null $description
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
		VO\Token $token,
		VO\StringVo $name,
		VO\StringVo $header = null,
		VO\StringVo $description = null,
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
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/create/program/unit'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
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

		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * Create Program Welcome Resource
	 * @param VO\Token         $token
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
		VO\Token $token,
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
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/create/program/welcome_resource'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
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
		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * Publish Program
	 * @param VO\Token   $token
	 * @param VO\Integer $occupation_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function publish_occupation(
		VO\Token $token,
		VO\Integer $occupation_id
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/publish/occupation'),
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

	/**
	 * Delete Occupation
	 * @param VO\Token   $token
	 * @param VO\Integer $occupation_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function delete_occupation(
		VO\Token $token,
		VO\Integer $occupation_id
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/delete/occupation'),
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
	 * Delete Program
	 * @param VO\Token   $token
	 * @param VO\Integer $program_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function delete_program(
		VO\Token $token,
		VO\Integer $program_id
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/delete/program'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array(
			'program_id' => $program_id->__toInteger(),
		);
		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * Get Active Program Status for Admin Visualisation
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
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/list/occupation_viz'),
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
	 * Get Active Learner Status for Admin Visualisation
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
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/list/students_viz'),
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
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/list/students_program_progress_viz'),
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
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/list/students_weekly_login_viz'),
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
	 * @param VO\Integer|null   $employer
	 * @param VO\Integer|null   $program
	 * @param VO\Integer|null   $phase
	 * @param VO\StringVO|null  $phase_status
	 * @param VO\StringVO|null  $search
	 * @param VO\Integer   $current_page
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function getLearnerProgrammeProgressDetailsForVisualisation(
		VO\Token $token,
		VO\OrganisationID $organisation_id,
		VO\Integer $employer = null,
		VO\Integer $program = null,
		VO\Integer $phase = null,
		VO\StringVO $phase_status = null,
		VO\StringVO $search = null,
		VO\Integer $per_page = null,
		VO\Integer $current_page
	){
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/list/students_programme_progress_details_viz'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array();
		$request_parameters['organisation_id'] = $organisation_id->__toString();
		if (!is_null($employer)) {
			$request_parameters['employer'] = $employer->__toInteger();
		}
		if (!is_null($program)) {
			$request_parameters['program'] = $program->__toInteger();
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
		$request_parameters['current_page'] = $current_page->__toInteger();
		$response = $request->send($request_parameters, $header_parameters);
		$data     = $response->get_data();
		return $data;
	}

	/**
	 * Get Learner Login Details for Visualisation
	 * @param VO\Token          $token
	 * @param VO\OrganisationID $organisation_id
	 * @param VO\Integer|null   $employer
	 * @param VO\Integer|null   $assessor
	 * @param VO\Integer|null   $verifier
	 * @param VO\StringVO|null  $from_date
	 * @param VO\StringVO|null  $to_date
	 * @param VO\StringVO|null  $search
	 * @param VO\Integer        $current_page
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function getLearnerLoginDetailsForVisualisation(
		VO\Token $token,
		VO\OrganisationID $organisation_id,
		VO\Integer $employer = null,
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
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/list/students_login_details_viz'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array();
		$request_parameters['organisation_id'] = $organisation_id->__toString();
		if (!is_null($employer)) {
			$request_parameters['employer'] = $employer->__toInteger();
		}
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
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/list/students_login_logs_viz'),
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
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/list/occupation_progress_viz'),
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
	 * Create On The Job Phase
	 * @param VO\Token          $token
	 * @param VO\Integer        $program_id
	 * @param VO\StringVO       $on_the_job_id
	 * @param VO\Integer|null   $member_apprenticeship_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function createOnTheJobPhase(
		VO\Token $token,
		VO\Integer $program_id,
		VO\StringVO $on_the_job_id,
		VO\Integer $member_apprenticeship_id = null
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/create/program/on/the/job/training'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array(
			'program_id'        => $program_id->__toInteger(),
			'on_the_job_id'     => $on_the_job_id->__toString()
		);
		if (!is_null($member_apprenticeship_id)) {
			$request_parameters['member_apprenticeship_id'] = $member_apprenticeship_id->__toInteger();
		}
		$response = $request->send($request_parameters, $header_parameters);
		$data     = $response->get_data();
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
		VO\OrganisationID $organisation_id = null
	)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/list/occupation_ids'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array();
		if (!is_null($organisation_id)) {
			$request_parameters['organisation_id'] = $organisation_id->__toString();
		}
		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;
	}

	/**
	 * @param VO\Token          $token
	 * @param VO\OrganisationID $organisation_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function deleteEmployer(
		VO\Token $token,
		VO\OrganisationID $organisation_id
	)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/organisation/delete'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters['organisation_id'] = $organisation_id->__toString();
		$response = $request->send($request_parameters, $header_parameters);
		return $response->get_data();

	}
}
