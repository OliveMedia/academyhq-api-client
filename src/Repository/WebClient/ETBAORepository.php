<?php

namespace AcademyHQ\API\Repository\WebClient;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class ETBAORepository {

	private $base_url = 'https://api.academyhq.com/api/v2/web/client';	

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function create_site_visit(
		VO\Token $token,
		VO\Integer $employer_id,
		VO\ApprenticeshipID $apprenticeship_id,
		VO\StringVO $booked_at
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/etb/authorising_officer/create/site_visit'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'employer_id' => $employer_id->__toInteger(),
			'apprenticeship_id' => $apprenticeship_id->__toString(),
			'booked_at' => $booked_at->__toString()
		);

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function edit_site_visit(
		VO\Token $token,
		VO\Integer $site_visit_id,
		VO\StringVO $booked_at,
		VO\Integer $is_visited,
		VO\StringVO $site_visited_at
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/etb/authorising_officer/edit/site_visit'),
			new VO\HTTP\Method('PUT')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'site_visit_id' => $site_visit_id->__toInteger(),
			'booked_at' => $booked_at->__toString(),
			'is_visited' => $is_visited->__toInteger(),
			'site_visited_at' => $site_visited_at->__toString()
		);

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function site_visit(
		VO\Token $token,
		VO\Integer $apprenticeship_id,
		VO\StringVO $site_visited_at
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/etb/authorising_officer/site/visit'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'apprenticeship_id' => $apprenticeship_id->__toInteger(),
			'site_visited_at' => $site_visited_at->__toString()
		);

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function create_apprenticeship_checklist(
		VO\Token $token,
		VO\StringVO $checklist_questions,
		VO\Integer $apprenticeship_id
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/etb/authorising_officer/create/apprenticeship/checklist'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'checklist_questions' => $checklist_questions->__toString(),
			'apprenticeship_id' => $apprenticeship_id->__toInteger()
		);

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function apprenticeship_checklist(vo\Token $token, VO\ID $apprenticeship_id)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/organisation/admin/get/apprenticeship/'.$apprenticeship_id.'/checklist'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function get_my_etb(VO\Token $token){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url."/etb/authorising_officer/get/details"),
            new VO\HTTP\Method('GET')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $response = $request->send(null, $header_parameters);
        $data = $response->get_data();

        return $data;
    }

    public function fetch_all_apprenticeships(
        VO\Token $token,
        VO\Integer $employer_id = null,
        VO\Integer $has_passed = null,
        VO\Integer $has_failed = null,
        VO\Integer $is_booked = null,
        VO\Integer $is_not_booked = null,
        VO\StringVO $query = null,
        VO\Integer $set_per_page = null,
        VO\Integer $page = null,
        VO\StringVO $order_by_field = null,
        VO\StringVO $order_by_direction = null
    ){

        $request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/etb/authorising_officer/fetch/apprenticeships'),
			new VO\HTTP\Method('POST')
		);

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array();

        if (!is_null($employer_id))
            $request_parameters['employer_id'] = $employer_id->__toInteger();

        if (!is_null($has_passed))
            $request_parameters['has_passed'] = $has_passed->__toInteger();

        if (!is_null($is_booked))
            $request_parameters['is_booked']  = $is_booked->__toInteger();

        if (!is_null($is_not_booked))
            $request_parameters['is_not_booked']  = $is_not_booked->__toInteger();

        if (!is_null($has_failed))
            $request_parameters['has_failed']  = $has_failed->__toInteger();

        if (!is_null($query))
            $request_parameters['query'] = $query->__toString();

        if (!is_null($set_per_page))
            $request_parameters['set_per_page'] = $set_per_page->__toInteger();

        if(!is_null($page))
            $request_parameters['page'] = $page->__toInteger();

        if (!is_null($order_by_field))
            $request_parameters['order_by_field'] = $order_by_field->__toString();

        if (!is_null($order_by_direction))
            $request_parameters['order_by_direction']  = $order_by_direction->__toString();

        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;

    }

    public function get_candidates(
		VO\Token $token,
		VO\Integer $employer_id = null,
		VO\Integer $is_declined = null,
		VO\Integer $is_approved_by_etb_ao = null,
		VO\Integer $is_approved_by_solas_admin = null,
		VO\StringVO $order_by_field = null,
		VO\StringVO $order_by_direction = null
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/etb/authorising_officer/get/candidates'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters  = array();

		if($employer_id) {
			$request_parameters['employer_id'] = $employer_id->__toInteger();
		}

		if(!is_null($is_declined)) {
			$request_parameters['is_declined'] = $is_declined->__toInteger();
		}

		if(!is_null($is_approved_by_etb_ao)) {
			$request_parameters['is_approved_by_etb_ao'] = $is_approved_by_etb_ao->__toInteger();
		}

		if(!is_null($is_approved_by_solas_admin)) {
			$request_parameters['is_approved_by_solas_admin'] = $is_approved_by_solas_admin->__toInteger();
		}

		if($order_by_field) {
			$request_parameters['order_by_field'] = $order_by_field->__toString();
		}

		if($order_by_direction) {
			$request_parameters['order_by_direction'] = $order_by_direction->__toString();
		}

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function create_apprenticeship_document(
		VO\Token $token,
		VO\Integer $apprenticeship_id,
		VO\Integer $is_declined = null,
		VO\Integer $is_approved = null,
		VO\Integer $is_approved_by_solas_admin = null,
		VO\Integer $is_rejected_by_solas_admin = null,
		VO\StringVO $document = null,
		VO\StringVO $type = null,
		VO\StringVO $extension = null

	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/etb/authorising_officer/create/apprenticeship/document'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'apprenticeship_id' => $apprenticeship_id->__toInteger()
		);

		if($is_declined) {
			$request_parameters['is_declined'] = $is_declined->__toInteger();
		}

		if($is_approved) {
			$request_parameters['is_approved'] = $is_approved->__toInteger();
		}

		if($is_approved_by_solas_admin) {
			$request_parameters['is_approved_by_solas_admin'] = $is_approved_by_solas_admin->__toInteger();
		}

		if($is_rejected_by_solas_admin) {
			$request_parameters['is_rejected_by_solas_admin'] = $is_rejected_by_solas_admin->__toInteger();
		}

		if($document) {
			$request_parameters['document'] = $document->__toString();
		}

		if($type) {
			$request_parameters['type'] = $type->__toString();
		}

		if($extension) {
			$request_parameters['extension'] = $extension->__toString();
		}

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function create_apprentice_document(
		VO\Token $token,
		VO\ID $member_id,
		VO\ID $apprenticeship_id,
		VO\Integer $is_declined = null,
		VO\Integer $is_approved_by_etb_ao = null,
		VO\Integer $is_approved_by_solas_admin = null,
		VO\StringVO $document = null,
		VO\StringVO $type = null,
		VO\StringVO $extension = null

	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/etb/authorising_officer/create/apprentice/document'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'member_id' => $member_id->__toInteger(),
			'apprenticeship_id' => $apprenticeship_id->__toInteger()
		);

		if($is_declined) {
			$request_parameters['is_declined'] = $is_declined->__toInteger();
		}

		if($is_approved_by_etb_ao) {
			$request_parameters['is_approved_by_etb_ao'] = $is_approved_by_etb_ao->__toInteger();
		}

		if($is_approved_by_solas_admin) {
			$request_parameters['is_approved_by_solas_admin'] = $is_approved_by_solas_admin->__toInteger();
		}

		if($document) {
			$request_parameters['document'] = $document->__toString();
		}

		if($type) {
			$request_parameters['type'] = $type->__toString();
		}

		if($extension) {
			$request_parameters['extension'] = $extension->__toString();
		}

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}
}
