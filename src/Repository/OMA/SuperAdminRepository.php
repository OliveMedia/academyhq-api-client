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
}
