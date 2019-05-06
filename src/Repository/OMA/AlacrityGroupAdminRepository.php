<?php

namespace AcademyHQ\API\Repository\OMA;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;

class AlacrityGroupAdminRepository extends BaseRepository
{
	public function __construct(Credentials $credentials)
	{
		parent::__construct();
		$this->credentials = $credentials;
		$this->base_url .= '/oma';
	}

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
			'search' => $search ? $search->__toString() : '',
			'current_page' => $current_page->__toInteger()
		);
		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

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
			'search' => $search ? $search->__toString() : '',
			'current_page' => $current_page->__toInteger(),
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
			'search' => $search ? $search->__toString() : '',
			'current_page' => $current_page->__toInteger(),
		);

		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;
	}

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
			'search' => $search ? $search->__toString() : '',
			'current_page' => $current_page->__toInteger(),
		);

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function createEmployer(
		VO\Token $token,
		VO\Email $email,
		VO\StringVO $employer_name,
		VO\Name $name,
		VO\TaxNumber $tax_number,
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
			'email' => $email->__toString(),
			'employer_name' => $employer_name->__toString(),
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString(),
			'tax_number' => $tax_number->__toString()
		);

		if(!is_null($image_url)) {
			$request_parameters['image_url'] = $image_url->__toString(); 
		}

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}



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
			'employer_id' => $employer_id->__toString(),
			'occupations_id' => $occupations_id->__toArray()
		);

		$response = $request->send($request_parameters, $header_parameters);


		$data = $response->get_data();

		return $data;
	}


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
		VO\StringVO $program_image=null
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


		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;
	}

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
			'program_id' => $program_id->__toInteger(),
			'courses_id'=>$courses_id->__toArray(),

		);

		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;
	}

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
			'program_id' => $program_id->__toInteger(),
			'audit_forms_id'=>$audit_forms_id->__toArray(),
		);
		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;
	}

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
			'program_id'=>$program_id->__toInteger(),

		);
		$response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();
		return $data;
	}

	public function createProgramUnit(
		VO\Token $token,
		VO\StringVo $name,
		VO\StringVo $header=null,
		VO\StringVo $description=null,
		VO\Integer $is_evidence_required,
		VO\Integer $image,
		VO\Integer $video,
		VO\Integer $attachment,
		VO\Integer $program_id,
		VO\Integer $program_unit_id=null,
		VO\Integer $parent_unit_id=null
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/create/program/unit'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array(
			'name' => $name->__toString(),
			'is_evidence_required' => $is_evidence_required->__toInteger(),
			'image' => $image->__toInteger(),
			'video' => $video->__toInteger(),
			'attachment' => $attachment->__toInteger(),
			'program_id'=>$program_id->__toInteger(),
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

	public function createProgramWelcomeResource(
		VO\Token $token,
		VO\StringVo $name,
		VO\Integer $program_id,
		VO\StringVo $document,
		VO\StringVo $description=null,
		VO\StringVo $link,
		VO\ID $welcome_resource_id = null,
        VO\StringVo $video = null
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/alacrity/group/admin/create/program/welcome_resource'),
			new VO\HTTP\Method('POST')
		);
		$header_parameters = array('Authorization' => $token->__toEncodedString());
		$request_parameters = array(
			'name' => $name->__toString(),
			'program_id'=>$program_id->__toInteger(),
			'document' => $document->__toString(),
			'link' => $link->__toString(),
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

	/*alicrity program publish and completed url repo*/
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

			'occupation_id'=>$occupation_id->__toInteger(),
		);
		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

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

			'program_id'=>$program_id->__toInteger(),
		);
		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}
	

}
