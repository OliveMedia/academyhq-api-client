<?php

namespace AcademyHQ\API\Repository\OMA;

use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\HTTP\Request\Request as Request;
use AcademyHQ\API\Repository\BaseRepository;
use AcademyHQ\API\ValueObjects as VO;
use Guzzle\Http\Client as GuzzleClient;

class MyKademyRepository extends BaseRepository
{
    public function __construct(Credentials $credentials)
    {
        parent::__construct();
        $this->credentials = $credentials;
        $this->base_url .= '/oma/mykademy';
    }

    /**
    *    @name          : createMyKademyClient
    *    @param         : $name
    *    @param         : $email
    *    @param         : $password
    *    @param         : $mobile_number
    *    @param         : $profile_picture Base64 data or Valid link
    *    @param         : $company_name
    *    @param         : $branding_logo_url Base64 data or valid link
    *    @param         : $background_url Base64 data or valid link
    *    @param         : $branding_hex
    *    @param         : $domain
    *    @param         : $mykademy_member_id
    *    @param         : $mykademy_platform_id
    *    @param         : $mykademy_platform_url
    *    @param         : VO\profile_picture     $profile_picture Base64 Data or Valid Link
    *    @response     : \AcademyHQ\API\HTTP\Response\json
    *    @IPR 2021 Hiup Solutions
    **/

    public function createMyKademyClient(
        VO\StringVO $name=null,
        VO\StringVO $email=null,
        VO\StringVO $password=null,
        VO\StringVO $mobile_number=null,
        VO\StringVO $profile_picture=null,
        VO\StringVO $company_name=null,
        VO\StringVO $branding_logo_url=null,
        VO\StringVO $background_url=null,
        VO\StringVO $branding_hex=null,
        VO\StringVO $domain=null,
        VO\StringVO $mykademy_member_id=null,
        VO\StringVO $mykademy_platform_id=null,
        VO\StringVO $mykademy_platform_url=null
        ){
            $request = new Request(
                new GuzzleClient,
                $this->credentials,
                VO\HTTP\Url::fromNative($this->base_url . '/create-mykademy-client'),
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
            if(!is_null($mykademy_member_id)){
                $request_parameters['mykademy_member_id'] = $mykademy_member_id->__toString();
            }
            if(!is_null($mykademy_platform_id)){
                $request_parameters['mykademy_platform_id'] = $mykademy_platform_id->__toString();
            }
            if(!is_null($mykademy_platform_url)){
                $request_parameters['mykademy_platform_url'] = $mykademy_platform_url->__toString();
            }


            $response = $request->send($request_parameters);
            $data = $response->get_data();
            return $data;
    }

    /**
    *    @name          : createMyKademyAdmin
    *    @param         : VO\first_name $first_name
    *    @param         : VO\last_name     $last_name
    *    @param         : VO\email     $email
    *    @param         : VO\password     $password
    *    @param         : VO\mobile_number     $mobile_number
    *    @param         : VO\mykademy_member_id     $mykademy_member_id
    *    @param         : VO\profile_picture     $profile_picture Base64 Data or Valid Link
    *    @response     : \AcademyHQ\API\HTTP\Response\json
    *    @IPR 2021 Hiup Solutions
    **/
    public function createMyKademyAdmin(
        VO\StringVO $first_name=null,
        VO\StringVO $last_name=null,
        VO\StringVO $email=null,
        VO\StringVO $password=null,
        VO\StringVO $mobile_number=null,
        VO\StringVO $profile_picture=null,
        VO\StringVO $mykademy_member_id=null
        ){
            $request = new Request(
                new GuzzleClient,
                $this->credentials,
                VO\HTTP\Url::fromNative($this->base_url . '/create-mykademy-admin'),
                new VO\HTTP\Method('POST')
            );
            if(!is_null($first_name)){
                $request_parameters['first_name'] = $first_name->__toString();
            }
            if(!is_null($last_name)){
                $request_parameters['last_name'] = $last_name->__toString();
            }
            if(!is_null($email)){
                $request_parameters['email'] = $email->__toString();
            }
            if(!is_null($password)){
                $request_parameters['password'] = $password->__toString();
            }
            if(!is_null($mobile_number) && $mobile_number!=false){
                $request_parameters['mobile_number'] = $mobile_number->__toString();
            }
            if(!is_null($mykademy_member_id)){
                $request_parameters['mykademy_member_id'] = $mykademy_member_id->__toString();
            }
            if(!is_null($profile_picture)){
                $request_parameters['profile_picture'] = $profile_picture->__toString();
            }
            $response = $request->send($request_parameters);
            $data = $response->get_data();
            return $data;
    }

    /**
    *    @name          : loginViaToken
    *    @param         : VO\id $id
    *    @param         : VO\client_id     $client_id
    *    @param         : VO\organisation_id     $organisation_id
    *    @param         : VO\token     $token
    *    @param         : VO\expires_on     $expires_on
    *    @response     : \AcademyHQ\API\HTTP\Response\json
    *    @IPR 2021 Hiup Solutions
    **/

    public function loginViaToken(
        VO\Integer $id=null,
        VO\Integer $client_id=null,
        VO\Integer $organisation_id=null,
        VO\StringVO $token=null,
        VO\StringVO $expires_on=null
        ){
            $request = new Request(
                new GuzzleClient,
                $this->credentials,
                VO\HTTP\Url::fromNative($this->base_url . '/login-via-token'),
                new VO\HTTP\Method('POST')
            );
            if(!is_null($id)){
                $request_parameters['id'] = $id->__toInteger();
            }
            if(!is_null($client_id)){
                $request_parameters['client_id'] = $client_id->__toInteger();
            }
            if(!is_null($organisation_id)){
                $request_parameters['organisation_id'] = $organisation_id->__toInteger();
            }
            if(!is_null($token)){
                $request_parameters['token'] = $token->__toString();
            }
            if(!is_null($expires_on)){
                $request_parameters['expires_on'] = $expires_on->__toString();
            }
            $response = $request->send($request_parameters);
            $data = $response->get_data();
            return $data;
    }

    /**
    *    @name          : loginViaMyKademyAuthCodeAndMemberId
    *    @param         : VO\mykademy_member_id $mykademy_member_id
    *    @param         : VO\auth_code     $auth_code
    *    @response     : \AcademyHQ\API\HTTP\Response\json
    *    @IPR 2021 Hiup Solutions
    **/

    public function loginViaMyKademyAuthCodeAndMemberId(
        VO\Integer $mykademy_member_id=null,
        VO\StringVO $auth_code=null
        ){
            $request = new Request(
                new GuzzleClient,
                $this->credentials,
                VO\HTTP\Url::fromNative($this->base_url . '/login-via-mykademy-credentials'),
                new VO\HTTP\Method('POST')
            );
            if(!is_null($mykademy_member_id)){
                $request_parameters['mykademy_member_id'] = $mykademy_member_id->__toInteger();
            }
            if(!is_null($auth_code)){
                $request_parameters['auth_code'] = $auth_code->__toString();
            }
            $response = $request->send($request_parameters);
            $data = $response->get_data();
            return $data;
    }

    /**
    *    @name         : updateProfile
     * @param VO\mykademy_member_id $mykademy_member_id
     * @param VO\auth_code     $auth_code
     * @param VO\first_name    $first_name
     * @param VO\last_name     $last_name
     * @param VO\StringVO|null $gender
     * @param VO\StringVO      $country_code
     * @param VO\StringVO      $mobile_number
     * @param VO\Email         $email
     * @param VO\StringVO|null $nationality
     * @param VO\StringVO|null $street
     * @param VO\StringVO|null $city
     * @param VO\StringVO|null $state
     * @param VO\StringVO|null $country
     * @param VO\StringVO|null $postal_code
     * @param VO\StringVO|null $profile_picture
     * @param VO\StringVO|null $employment
     * @param VO\StringVO|null $further_notes
     * @param VO\StringVO|null $disability_text
     * @param VO\StringVO|null $date_of_birth
     * @param VO\Integer|null  $weekly_learning_hours
     * @param VO\StringVO|null $custom_fields_data
    *    @response     : \AcademyHQ\API\HTTP\Response\json
    *    @IPR 2021 Hiup Solutions
    **/
    public function updateProfile(
        VO\Integer $mykademy_member_id,
        VO\StringVO $auth_code,
        VO\StringVO $first_name=null,
        VO\StringVO $last_name=null,
        VO\StringVO $gender=null,
        VO\StringVO $country_code=null,
        VO\StringVO $mobile_number=null,
        VO\StringVO $email=null,
        VO\StringVO $nationality=null,
        VO\StringVO $street = null,
        VO\StringVO $city = null,
        VO\StringVO $state = null,
        VO\StringVO $country = null,
        VO\StringVO $postal_code = null,        
        VO\StringVO $profile_picture = null,
        VO\StringVO $employment = null,
        VO\StringVO $further_notes = null,
        VO\StringVO $date_of_birth = null,
        VO\Integer $weekly_learning_hours=null,
        VO\StringVO $custom_fields_data = null
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url . '/update/profile'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'mykademy_member_id'    => $mykademy_member_id->__toInteger(),
            'auth_code'  => $auth_code->__toString()
        );

        if(!is_null($first_name)){
            $request_parameters['first_name'] = $first_name->__toString();
        }

        if(!is_null($last_name)){
            $request_parameters['last_name'] = $last_name->__toString();
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

        if(!is_null($email)){
            $request_parameters['email'] = $email->__toString();
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
        if(!is_null($profile_picture)){
            $request_parameters['profile_picture'] = $profile_picture->__toString();
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

        if(!is_null($weekly_learning_hours)){
            $request_parameters['weekly_learning_hours'] = $weekly_learning_hours->__toInteger();
        }

        if(!is_null($custom_fields_data)) {
            $request_parameters['custom_fields_data'] = $custom_fields_data->__toString();
        }

        $response = $request->send($request_parameters);
        return $response->get_data();
    }

    /**
    *    @name         : updatePassword
    *    @params       : VO\mykademy_member_id $mykademy_member_id,
    *    @params       : VO\auth_code     $auth_code,
    *    @params       : VO\password    $password,
    *    @params       : VO\confirm_password     $confirm_password
    *    @response     : \AcademyHQ\API\HTTP\Response\json
    *    @IPR 2021 Hiup Solutions
    **/
    public function updatePassword(
        VO\Integer $mykademy_member_id,
        VO\StringVO $auth_code,
        VO\StringVO $password=null,
        VO\StringVO $confirm_password=null
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url . '/update/password'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'mykademy_member_id'    => $mykademy_member_id->__toInteger(),
            'auth_code'  => $auth_code->__toString()
        );

        if(!is_null($password)){
            $request_parameters['password'] = $password->__toString();
        }

        if(!is_null($confirm_password)){
            $request_parameters['confirm_password'] = $confirm_password->__toString();
        }

        $response = $request->send($request_parameters);
        return $response->get_data();
    }

    /**
    *    @name         : logout
    *    @params       : VO\mykademy_member_id $mykademy_member_id, 
    *    @params       : VO\auth_code     $auth_code
    *    @response     : \AcademyHQ\API\HTTP\Response\json
    *    @IPR 2021 Hiup Solutions
    **/
    public function logout(
        VO\Integer $mykademy_member_id,
        VO\StringVO $auth_code
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url . '/logout'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'mykademy_member_id'    => $mykademy_member_id->__toInteger(),
            'auth_code'  => $auth_code->__toString()
        );
        $response = $request->send($request_parameters);
        return $response->get_data();
    }

}
