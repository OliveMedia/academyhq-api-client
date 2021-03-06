<?php

namespace AcademyHQ\API\Repository\OMA;

use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\HTTP\Request\Request as Request;
use AcademyHQ\API\Repository\BaseRepository;
use AcademyHQ\API\ValueObjects as VO;
use Guzzle\Http\Client as GuzzleClient;

class SuperAdminRepository extends BaseRepository
{
    public function __construct(Credentials $credentials)
    {
        parent::__construct();
        $this->credentials = $credentials;
        // $this->base_url .= '/crms';
    }

    public function get_organisations(
        VO\Integer $current_page,
        VO\StringVO $search = null
    ) {

        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url . '/crms/organisations/get'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'current_page' => $current_page->__toInteger(),
        );

        if ($search) {
            $request_parameters['search'] = $search->__toString();
        }

        $response = $request->send($request_parameters);

        $data = $response->get_data();

        return $data;
    }

    
    /**
    * Create New Client
    **/

    public function createOrganisationWithAdmin(
        VO\StringVO $name,
        VO\StringVO $email,
        VO\StringVO $mobile_number,
        VO\StringVO $profile_picture,
        VO\StringVO $company_name,
        VO\StringVO $branding_logo_url,
        VO\StringVO $background_url,
        VO\StringVO $branding_hex,
        VO\StringVO $domain
        ){
            $request = new Request(
                new GuzzleClient,
                $this->credentials,
                VO\HTTP\Url::fromNative($this->base_url . '/oma/create-apprenticeship-client'),
                new VO\HTTP\Method('POST')
            );

            if(!is_null($name)){
                $request_parameters['name'] = $name->__toString();
            }
            if(!is_null($email)){
                $request_parameters['email'] = $email->__toString();
            }
            if(!is_null($mobile_number)){
                $request_parameters['mobile_number'] = $mobile_number->__toString();
            }
            if(!is_null($profile_picture)){
                $request_parameters['profile_picture'] = $profile_picture->__toString();
            }
            if(!is_null($company_name)){
                $request_parameters['company_name'] = $company_name->__toString();
            }
            if(!is_null($branding_logo_url)){
                $request_parameters['branding_logo_url'] = $branding_logo_url->__toString();
            }
            if(!is_null($background_url)){
                $request_parameters['background_url'] = $background_url->__toString();
            }
            if(!is_null($branding_hex)){
                $request_parameters['branding_hex'] = $branding_hex->__toString();
            }
            if(!is_null($domain)){
                $request_parameters['domain'] = $domain->__toString();
            }

            $response = $request->send($request_parameters);
            $data = $response->get_data();
            return $data;
    }

    /**
    * Create New Client with completely registered admin
    **/

    public function createThirdPartyClient(
        VO\StringVO $name,
        VO\StringVO $email,
        VO\StringVO $password,
        VO\StringVO $mobile_number,
        VO\StringVO $profile_picture,
        VO\StringVO $company_name,
        VO\StringVO $branding_logo_url,
        VO\StringVO $background_url,
        VO\StringVO $branding_hex,
        VO\StringVO $domain
        ){
            $request = new Request(
                new GuzzleClient,
                $this->credentials,
                VO\HTTP\Url::fromNative($this->base_url . '/oma/create-third-party-client'),
                new VO\HTTP\Method('POST')
            );

            if(!is_null($name)){
                $request_parameters['name'] = $name->__toString();
            }
            if(!is_null($email)){
                $request_parameters['email'] = $email->__toString();
            }
            if(!is_null($password)){
                $request_parameters['password'] = $password->__toString();
            }
            if(!is_null($mobile_number)){
                $request_parameters['mobile_number'] = $mobile_number->__toString();
            }
            if(!is_null($profile_picture)){
                $request_parameters['profile_picture'] = $profile_picture->__toString();
            }
            if(!is_null($company_name)){
                $request_parameters['company_name'] = $company_name->__toString();
            }
            if(!is_null($branding_logo_url)){
                $request_parameters['branding_logo_url'] = $branding_logo_url->__toString();
            }
            if(!is_null($background_url)){
                $request_parameters['background_url'] = $background_url->__toString();
            }
            if(!is_null($branding_hex)){
                $request_parameters['branding_hex'] = $branding_hex->__toString();
            }
            if(!is_null($domain)){
                $request_parameters['domain'] = $domain->__toString();
            }

            $response = $request->send($request_parameters);
            $data = $response->get_data();
            return $data;
    }

	/**
	 * @param VO\StringVO      $name
	 * @param VO\StringVO      $email
	 * @param VO\StringVO      $password
	 * @param VO\StringVO      $mobile_number
	 * @param VO\StringVO      $profile_picture
	 * @param VO\StringVO|null $icon
	 * @param VO\StringVO      $company_name
	 * @param VO\StringVO      $branding_logo_url
	 * @param VO\StringVO      $background_url
	 * @param VO\StringVO      $branding_hex
	 * @param VO\StringVO      $domain
	 * @param VO\StringVO      $plan
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
    public function createThirdPartyClientWithPlan(
        VO\StringVO $name,
        VO\StringVO $email,
        VO\StringVO $password,
        VO\StringVO $mobile_number,
        VO\StringVO $profile_picture,
        VO\StringVO $icon=null,
        VO\StringVO $company_name,
        VO\StringVO $branding_logo_url,
        VO\StringVO $background_url,
        VO\StringVO $branding_hex,
        VO\StringVO $domain,
        VO\StringVO $plan
        ){
            $request = new Request(
                new GuzzleClient,
                $this->credentials,
                VO\HTTP\Url::fromNative($this->base_url . '/oma/create-third-party-client-with-plan'),
                new VO\HTTP\Method('POST')
            );

            if(!is_null($name)){
                $request_parameters['name'] = $name->__toString();
            }
            if(!is_null($email)){
                $request_parameters['email'] = $email->__toString();
            }
            if(!is_null($password)){
                $request_parameters['password'] = $password->__toString();
            }
            if(!is_null($mobile_number)){
                $request_parameters['mobile_number'] = $mobile_number->__toString();
            }
            if(!is_null($profile_picture)){
                $request_parameters['profile_picture'] = $profile_picture->__toString();
            }
            if(!is_null($icon)){
                $request_parameters['icon'] = $icon->__toString();
            }
            if(!is_null($company_name)){
                $request_parameters['company_name'] = $company_name->__toString();
            }
            if(!is_null($branding_logo_url)){
                $request_parameters['branding_logo_url'] = $branding_logo_url->__toString();
            }
            if(!is_null($background_url)){
                $request_parameters['background_url'] = $background_url->__toString();
            }
            if(!is_null($branding_hex)){
                $request_parameters['branding_hex'] = $branding_hex->__toString();
            }
            if(!is_null($domain)){
                $request_parameters['domain'] = $domain->__toString();
            }
              if(!is_null($plan)){
                $request_parameters['plan'] = $plan->__toString();
            }

            $response = $request->send($request_parameters);
            $data = $response->get_data();
            return $data;
    }
    /**
     *  plan  Change
     * @param VO\Token $token
     * @param VO\String $plan
     * @return \AcademyHQ\API\HTTP\Response\json
     * @throws VO\Exception\MethodNotAllowedException
     * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
     */
    public function checkDomainExist(
        VO\StringVO $domain
    ) {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/oma/organisation/check/domain'),
            new VO\HTTP\Method('POST')
        );

       
        $request_parameters = array(
            'domain' => $domain->__toString()
        );

        $response = $request->send($request_parameters);
        $data = $response->get_data();

        return $data;
    }
   /* Get list of all Organization/s across which the Learner is registered in */
    public function list_organisation_based_on_domain(
        VO\Integer $current_page,
        VO\StringVO $search = null,
        VO\StringVO $domain,
        VO\StringVO $email,
        VO\Integer $per_page = null
    ) {
       
         $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/oma/list/organisation'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'current_page'  => $current_page->__toInteger(),
            'search'        => $search ? $search->__toString() : '',
            'domain' => $domain->__toString(),
            'email' => $email->__toString()

        );
        
        if(!is_null($per_page)){
            $request_parameters['per_page'] = $per_page->__toInteger();
        }
        $response = $request->send($request_parameters);

        $data = $response->get_data();

        return $data;
    }
/*
    * Get list of all Apprenticeship Client across which the Learner is registered in
    */
    public function list_organisation_based_on_email(
        VO\Integer $current_page,
        VO\StringVO $search = null,
        VO\StringVO $email,
        VO\Integer $per_page = null
    ) {
       
         $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/oma/list/mainorganisation'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'current_page'  => $current_page->__toInteger(),
            'search'        => $search ? $search->__toString() : '',
            'email' => $email->__toString()

        );
        
        if(!is_null($per_page)){
            $request_parameters['per_page'] = $per_page->__toInteger();
        }
        $response = $request->send($request_parameters);

        $data = $response->get_data();

        return $data;
    }

}
