<?php

namespace AcademyHQ\API\Repository\OMA;

use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\ValueObjects as VO;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Repository\BaseRepository;
use AcademyHQ\API\HTTP\Request\Request as Request;

/**
 * Class ThirdPartyRepository
 *
 * @package AcademyHQ\API\Repository\OMA
 */
class ThirdPartyRepository extends BaseRepository
{
	/**
	 * ThirdPartyRepository constructor.
	 *
	 * @param Credentials $credentials
	 */
	public function __construct(Credentials $credentials)
    {
        parent::__construct();
        $this->credentials = $credentials;
        $this->base_url .= '/third-party';
    }

	/**
	 * @param VO\Integer       $current_page
	 * @param VO\Integer       $per_page
	 * @param VO\StringVO|null $direction
	 * @param VO\StringVO|null $sort_by
	 * @param VO\StringVO|null $search
	 * @param VO\StringVO|null $status
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function listEmployers(
        VO\Integer $current_page,
        VO\Integer $per_page,
        VO\StringVO $direction = null,
        VO\StringVO $sort_by = null,
        VO\StringVO $search = null,
        VO\StringVO $status = null
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url . '/list/employers'),
            new VO\HTTP\Method('POST')
        );
        $request_parameters = array(
            'current_page'  => $current_page->__toInteger(),
            'per_page'      => $per_page->__toInteger(),
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

        if ($status) {
            $request_parameters['status'] = $status->__toString();
        }

        $response = $request->send($request_parameters);

        $data = $response->get_data();

        return $data;
    }

	/**
	 * @param VO\Integer       $current_page
	 * @param VO\Integer       $per_page
	 * @param VO\StringVO|null $direction
	 * @param VO\StringVO|null $sort_by
	 * @param VO\StringVO|null $search
	 * @param VO\StringVO|null $status
	 * @param VO\StringVO|null $start_date
	 * @param VO\StringVO|null $end_date
	 * @param VO\StringVO|null $is_published
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function listPrograms(
        VO\Integer $current_page,
        VO\Integer $per_page,
        VO\StringVO $direction = null,
        VO\StringVO $sort_by = null,
        VO\StringVO $search = null,
        VO\StringVO $status = null,
        VO\StringVO $start_date = null,
        VO\StringVO $end_date = null,
        VO\StringVO $is_published = null
    ) {

        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url . '/list/programs'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'current_page'  => $current_page->__toInteger(),
            'per_page'      => $per_page->__toInteger(),
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

        if ($status) {
            $request_parameters['status'] = $status->__toString();
        }

        if ($start_date) {
            $request_parameters['start_date'] = $start_date->__toString();
        }

        if ($end_date) {
            $request_parameters['end_date'] = $end_date->__toString();
        }

        if (!is_null($is_published)) {
            $request_parameters['is_published'] = $is_published->__toString();
        }

        $response = $request->send($request_parameters);

        $data = $response->get_data();

        return $data;
    }

	/**
	 * @param VO\Integer       $current_page
	 * @param VO\Integer       $per_page
	 * @param VO\StringVO|null $direction
	 * @param VO\StringVO|null $sort_by
	 * @param VO\StringVO|null $search
	 * @param VO\StringVO|null $status
	 * @param VO\StringVO|null $program
	 * @param VO\StringVO|null $employer
	 * @param VO\StringVO|null $start_date
	 * @param VO\StringVO|null $end_date
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function listApprentices(
        VO\Integer $current_page,
        VO\Integer $per_page,
        VO\StringVO $direction = null,
        VO\StringVO $sort_by = null,
        VO\StringVO $search = null,
        VO\StringVO $status = null,
        VO\StringVO $program = null,
        VO\StringVO $employer = null,
        VO\StringVO $start_date = null,
        VO\StringVO $end_date = null
    ) {

        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url . '/list/apprentices'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'current_page'  => $current_page->__toInteger(),
            'per_page'      => $per_page->__toInteger(),
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

        if ($status) {
            $request_parameters['status'] = $status->__toString();
        }

        if ($program) {
            $request_parameters['program'] = $program->__toString();
        }

        if ($employer) {
            $request_parameters['employer'] = $employer->__toString();
        }

        if ($start_date) {
            $request_parameters['start_date'] = $start_date->__toString();
        }

        if ($end_date) {
            $request_parameters['end_date'] = $end_date->__toString();
        }

        $response = $request->send($request_parameters);

        $data = $response->get_data();

        return $data;
    }

	/**
	 * @param VO\StringVO|null $published
	 * @param VO\StringVO|null $status
	 * @param VO\StringVO|null $program
	 * @param VO\StringVO|null $employer
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function counter(
        VO\StringVO $published = null,
        VO\StringVO $status = null,
        VO\StringVO $program = null,
        VO\StringVO $employer = null
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url . '/counter'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array();

        if ($published) {
            $request_parameters['published'] = $published->__toString();
        }

        if ($status) {
            $request_parameters['status'] = $status->__toString();
        }

        if ($program) {
            $request_parameters['program'] = $program->__toString();
        }

        if ($employer) {
            $request_parameters['employer'] = $employer->__toString();
        }

        $response = $request->send($request_parameters);

        $data = $response->get_data();

        return $data;
    }

	/**
	 * @param VO\Integer       $current_page
	 * @param VO\Integer       $per_page
	 * @param VO\StringVO|null $direction
	 * @param VO\StringVO|null $sort_by
	 * @param VO\StringVO|null $search
	 * @param VO\StringVO|null $member
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function listApprenticePrograms(
        VO\Integer $current_page,
        VO\Integer $per_page,
        VO\StringVO $direction = null,
        VO\StringVO $sort_by = null,
        VO\StringVO $search = null,
        VO\StringVO $member = null
    ) {

        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url . '/list/apprentice/programs'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'current_page'  => $current_page->__toInteger(),
            'per_page'      => $per_page->__toInteger(),
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

        if ($member) {
            $request_parameters['member'] = $member->__toString();
        }

        $response = $request->send($request_parameters);

        $data = $response->get_data();

        return $data;
    }

	/**
	 * @param VO\StringVO $username
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function listApprenticeOrganisations(
        VO\StringVO $username
    ) {

        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url . '/list/apprentice/organisations'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'username' => $username->__toString()
        );

        $response = $request->send($request_parameters);

        $data = $response->get_data();

        return $data;
    }

	/**
	 * @param VO\Integer       $employer_id
	 * @param VO\Integer       $program_id
	 * @param VO\Integer|null  $is_existing_member
	 * @param VO\Integer|null  $member_id
	 * @param VO\StringVO|null $first_name
	 * @param VO\StringVO|null $last_name
	 * @param VO\StringVO|null $email_address
	 * @param VO\StringVO|null $profile_picture
	 * @param VO\StringVO|null $country_code
	 * @param VO\StringVO|null $mobile_number
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function createApprentice(
        VO\Integer $employer_id,
        VO\Integer $program_id,
        VO\Integer $is_existing_member=null,
        VO\Integer $member_id=null,
        VO\StringVO $first_name=null,
        VO\StringVO $last_name=null,
        VO\StringVO $email_address=null,
        VO\StringVO $profile_picture=null,
        VO\StringVO $country_code=null,
        VO\StringVO $mobile_number=null
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url . '/create/apprentice'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'employer_id'           => $employer_id->__toInteger(),
            'program_id'            => $program_id->__toInteger(),
            'is_existing_member'    => $is_existing_member->__toInteger()
        );

        if($member_id) {
            $request_parameters['member_id'] = $member_id->__toInteger();
        }

        if($first_name) {
            $request_parameters['first_name'] = $first_name->__toString();
        }

        if($last_name) {
            $request_parameters['last_name'] = $last_name->__toString();
        }

        if($email_address) {
            $request_parameters['email_address'] = $email_address->__toString();
        }

        if($profile_picture) {
            $request_parameters['profile_picture'] = $profile_picture->__toString();
        }

        if($country_code) {
            $request_parameters['country_code'] = $country_code->__toString();
        }

        if($mobile_number) {
            $request_parameters['mobile_number'] = $mobile_number->__toString();
        }

        $response = $request->send($request_parameters);

        $data = $response->get_data();

        return $data;
    }

	/**
	 * @param VO\OrganisationID $organisation_id
	 * @param VO\Integer        $current_page
	 * @param VO\Integer        $per_page
	 * @param VO\StringVO|null  $direction
	 * @param VO\StringVO|null  $sort_by
	 * @param VO\StringVO|null  $search
	 * @param VO\StringVO|null  $revenue_model
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function listResellingPrograms(
		VO\OrganisationID $organisation_id,
	    VO\Integer $current_page,
	    VO\Integer $per_page,
	    VO\StringVO $direction = null,
	    VO\StringVO $sort_by = null,
	    VO\StringVO $search = null,
	    VO\StringVO $revenue_model = null
    ) {
	    $request = new Request(
		    new GuzzleClient,
		    $this->credentials,
		    VO\HTTP\Url::fromNative($this->base_url . '/list/reselling/programs'),
		    new VO\HTTP\Method('POST')
	    );

	    $request_parameters = array(
	    	'organisation_id'   => $organisation_id->__toString(),
		    'current_page'      => $current_page->__toInteger(),
		    'per_page'          => $per_page->__toInteger(),
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

		if ($revenue_model) {
			$request_parameters['revenue_model'] = $revenue_model->__toString();
		}

	    $response = $request->send($request_parameters);

	    $data = $response->get_data();

	    return $data;

    }

    /**
     * @param VO\Integer       $current_page
     * @param VO\Integer       $per_page
     * @param VO\StringVO|null $direction
     * @param VO\StringVO|null $sort_by
     * @param VO\StringVO|null $search
     * @param VO\Integer|null $is_active
     * @param VO\Integer|null $is_deleted
     * @param VO\StringVO|null $created_from
     * @param VO\StringVO|null $created_to
     * @param VO\Integer|null $organisation_id
     * @param VO\StringVO|null $last_login_at
     *
     * @return \AcademyHQ\API\HTTP\Response\json
     * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
     */
    public function listStudents(
        VO\Integer $current_page,
        VO\Integer $per_page,
        VO\StringVO $direction = null,
        VO\StringVO $sort_by = null,
        VO\StringVO $search = null,
        VO\StringVO $is_active = null,
        VO\StringVO $is_deleted = null,
        VO\StringVO $created_from = null,
        VO\StringVO $created_to = null,
        VO\Integer $organisation_id = null,
        VO\StringVO $last_login_at = null
    ) {

        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url . '/list/students'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'current_page'  => $current_page->__toInteger(),
            'per_page'      => $per_page->__toInteger(),
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

        if ($is_active) {
            $request_parameters['is_active'] = $is_active->__toString();
        }

        if ($is_deleted) {
            $request_parameters['is_deleted'] = $is_deleted->__toString();
        }

        if ($organisation_id) {
            $request_parameters['organisation_id'] = $organisation_id->__toInteger();
        }

        if ($created_from) {
            $request_parameters['created_from'] = $created_from->__toString();
        }

        if ($created_to) {
            $request_parameters['created_to'] = $created_to->__toString();
        }

        if ($last_login_at) {
            $request_parameters['last_login_at'] = $last_login_at->__toString();
        }

        $response = $request->send($request_parameters);
        $data = $response->get_data();

        return $data;
    }
}
