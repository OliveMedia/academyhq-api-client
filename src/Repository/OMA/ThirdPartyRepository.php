<?php

namespace AcademyHQ\API\Repository\OMA;

use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\ValueObjects as VO;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Repository\BaseRepository;
use AcademyHQ\API\HTTP\Request\Request as Request;

class ThirdPartyRepository extends BaseRepository
{
    public function __construct(Credentials $credentials)
    {
        parent::__construct();
        $this->credentials = $credentials;
        $this->base_url .= '/third-party';
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
            'current_page' => $current_page->__toInteger(),
            'per_page' => $per_page->__toInteger(),
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

    /*
    Parameters :
        @current_page : num | null
        @per_page : num | null
        @direction : asc | desc | null
        @sort_by : name | created_at | null
        @search : employer's name | null
        @status : active | inactive | null
        @is_published : 1 | 0 | null
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
            'current_page' => $current_page->__toInteger(),
            'per_page' => $per_page->__toInteger(),
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


    /*
    Parameters :
        @current_page : num | null
        @per_page : num | null
        @direction : asc | desc | null
        @sort_by : name | created_at | null
        @search : student's name | null
        @status : active | inactive | null
        @program : program id | null
        @employer : employer id | null
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
            'current_page' => $current_page->__toInteger(),
            'per_page' => $per_page->__toInteger(),
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


    /*
    Parameters :
        @status : active | inactive | null
        @program : program id | null
        @employer : employer id | null
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

        $request_parameters = array(
        );

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

    /*
    Parameters :
        @current_page : num | null
        @per_page : num | null
        @direction : asc | desc | null
        @sort_by : name | created_at | null
        @search : employer's name | null
        @member : member_id
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
            'current_page' => $current_page->__toInteger(),
            'per_page' => $per_page->__toInteger(),
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

    /*
    Parameters :
        @username : username | email
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


    /*
        Parameters :
        @employer_id : employer_id
        @program_id : program_id
        @is_existing_member : is_existing_member
        @member_id : member_id
        @first_name : first_name
        @last_name : last_name
        @email_address : email_address
        @profile_picture : profile_picture
        @mobile_number : mobile_number
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
        VO\StringVO $mobile_number=null
    ) {


        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url . '/create/apprentice'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'employer_id' => $employer_id->__toInteger(),
            'program_id' => $program_id->__toInteger(),
            'is_existing_member' => $is_existing_member->__toInteger()
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

        if($mobile_number) {
            $request_parameters['mobile_number'] = $mobile_number->__toString();
        }

        $response = $request->send($request_parameters);

        $data = $response->get_data();

        return $data;
    }
}
