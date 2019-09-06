<?php

namespace AcademyHQ\API\Repository\Adecco;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\Common\Credentials;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Repository\BaseRepository;
use AcademyHQ\API\HTTP\Request\Request as Request;

class AdeccoAdminApiRepository extends BaseRepository {

	public function __construct(Credentials $credentials)
	{
		parent::__construct();
		$this->credentials = $credentials; 
	}


	public function register_admin_member_with_email(
		VO\Token $token,
        VO\Name $name,
        VO\Email $email,
        VO\StringVo $userType
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/onscensus/create/admin'),
			new VO\HTTP\Method('POST')
        );
        $userType = $userType->__toString();

        $header_parameters = array('Authorization' => $token->__toEncodedString());

		$request_parameters = array(
            'first_name'    => $name->get_first_name()->__toString(),
            'last_name'     => $name->get_last_name()->__toString(),
            'email'         => $email->__toEncodedString(),
            $userType       => 1
        );

        $response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}
	

	public function fetch_user(
		VO\Token $token,
        VO\StringVo $search = null,
        VO\Integer $fetchAll = null,
        VO\Integer $currentPage = null,
        VO\Integer $perPage = null
	) {


		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/onscensus/organisation/members/get'),
			new VO\HTTP\Method('POST')
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());

		
		$request_parameters = array();


        if($search->__toString() != null) {
			$request_parameters['search'] = $search->__toString();
        }

        if($fetchAll->__toInteger() != null) {
		   $request_parameters['fetch_all'] = $fetchAll->__toInteger();
        }

        if($currentPage->__toInteger() != null) {
		    $request_parameters['current_page'] = $currentPage->__toInteger();

        }

        if($perPage->__toInteger() != null) {
		    $request_parameters['per_page'] = $perPage->__toInteger();

        }

        $response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;

	}

	public function searchOrganisationPackage(
		VO\Token $token,
        VO\StringVo $search = null,
        VO\Integer $page = null
	) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/onscensus/package/get/search'),
			new VO\HTTP\Method('GET')
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());
		
		$request_parameters = array();

		$request_parameters['packageName'] = $search->__toString();

		$request_parameters['page'] = $page->__toInteger();

        $response = $request->send($request_parameters, $header_parameters);
		$data = $response->get_data();

		return $data;

	}


   
}