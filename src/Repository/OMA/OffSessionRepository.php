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
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function checkIfEmailExistsInAHQ(
		VO\Email $email
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
		$response = $request->send($request_parameters);
		$data = $response->get_data();
		return $data;

	}

	/**
	 * Create Member Apprenticeships
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
	 * @param VO\Integer|null     $weekly_learning_hours
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function create_student_from_member(
		VO\ApprenticeshipID $apprenticeship_id,
		VO\OrganisationID $organisation_id,
		VO\MemberID $member_id,
		VO\StringVO $gender,
		VO\StringVO $country_code,
		VO\StringVO $mobile_number,
		VO\StringVO $nationality,
		VO\Integer $disability,
		VO\MemberID $assessor_id = null,
		VO\MemberID $verifier_id = null,
		VO\StringVO $street = null,
		VO\StringVO $city = null,
		VO\StringVO $state = null,
		VO\StringVO $country = null,
		VO\StringVO $postal_code = null,
		VO\StringVO $image = null,
		VO\StringVO $employment = null,
		VO\StringVO $further_notes = null,
		VO\StringVO $disability_text = null,
		VO\Integer $weekly_learning_hours=null
	) {
		$request =new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/out_session/create/member/apprenticeship'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'apprenticeship_id' => $apprenticeship_id->__toString(),
			'organisation_id'   => $organisation_id->__toString(),
			'member_id'         => $member_id->__toString(),
			'nationality'       => $nationality-> __toString(),
			'disability'        => $disability->__toInteger()
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

		$response = $request->send($request_parameters, null);

		$data = $response->get_data();

		return $data;
	}
}
