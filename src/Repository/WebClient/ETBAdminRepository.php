<?php

namespace AcademyHQ\API\Repository\WebClient;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class ETBAdminRepository {

	private $base_url = 'https://api.academyhq.com/api/v2/web/client';

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function assign_ao_to_apprenticeship_application(
		VO\Token $token,
		VO\ApprenticeshipID $apprenticeship_id,
		VO\Integer $authorising_officer_id
	){

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/etb/admin/assign/authorising_officer/to/apprenticeship/application'),
			new VO\HTTP\Method('PUT')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
			'apprenticeship_id' => $apprenticeship_id->__toString(),
			'authorising_officer_id' => $authorising_officer_id->__toInteger()
		);

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}

	public function get_my_etb(VO\Token $token){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url."/etb/admin/get/details"),
            new VO\HTTP\Method('GET')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $response = $request->send(null, $header_parameters);
        $data = $response->get_data();

        return $data;
    }

    public function fetch_all_apprenticeships(
        VO\Token $token,
        VO\Integer $is_new_apprenticeships_application = null,
        VO\Integer $is_site_visit_approved = null,
        VO\Integer $is_site_visit_rejected = null,
        VO\Integer $is_site_visit_booked = null,
        VO\Integer $current_page = null,
        VO\Integer $set_per_page = null,
        VO\StringVO $order_by_field = null,
        VO\StringVO $order_by_direction = null
    ){

        $request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/etb/admin/fetch/apprenticeships'),
			new VO\HTTP\Method('POST')
		);

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array();

        if (!is_null($is_new_apprenticeships_application))
            $request_parameters['is_new_apprenticeships_application'] = $is_new_apprenticeships_application->__toInteger();

        if (!is_null($is_site_visit_approved))
            $request_parameters['is_site_visit_approved']  = $is_site_visit_approved->__toInteger();

        if (!is_null($is_site_visit_rejected))
            $request_parameters['is_site_visit_rejected'] = $is_site_visit_rejected->__toInteger();

        if (!is_null($is_site_visit_booked))
            $request_parameters['is_site_visit_booked'] = $is_site_visit_booked->__toInteger();

        if(!is_null($current_page))
            $request_parameters['current_page'] = $current_page->__toInteger();

        if (!is_null($set_per_page))
            $request_parameters['set_per_page'] = $set_per_page->__toInteger();

        if (!is_null($order_by_field))
            $request_parameters['order_by_field'] = $order_by_field->__toString();

        if (!is_null($order_by_direction))
            $request_parameters['order_by_direction']  = $order_by_direction->__toString();

        $response = $request->send($request_parameters, $header_parameters);

        $data = $response->get_data();

        return $data;

    }

    public function get_etb_authorizing_officer(VO\Token $token){
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url."/etb/admin/fetch/ao"),
            new VO\HTTP\Method('GET')
        );
        $header_parameters = array('Authorization' => $token->__toEncodedString());
        $request_parameters = array();
        $response = $request->send($request_parameters, $header_parameters);
        $data = $response->get_data();

        return $data;
    }
}