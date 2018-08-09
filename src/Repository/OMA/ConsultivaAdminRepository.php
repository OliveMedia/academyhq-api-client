<?php

namespace AcademyHQ\API\Repository\OMA;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;

class ConsultivaAdminRepository extends BaseRepository
{
    public function __construct(Credentials $credentials)
    {
        parent::__construct();
        $this->credentials = $credentials;
        $this->base_url .= '/oma';
    }

    public function create_student(
        VO\Token $token,
        VO\ApprenticeshipID $apprenticeship_id,
        VO\OrganisationID $organisation_id,
        VO\Name $name,
        VO\StringVO $gender,
        VO\StringVO $country_code,
        VO\Integer $mobile_number,
        VO\Email $email,
        VO\StringVO $image = null,
        VO\Integer $disability,
        VO\StringVO $disability_text = null,
        VO\StringVO $street = null,
        VO\StringVO $city,
        VO\StringVO $state,
        VO\StringVO $country,
        VO\Integer $postal_code,
        VO\StringVO $employment = null,
        VO\StringVO $further_notes = null,
        VO\StringVO $nationality,
        VO\StringVO $date_of_birth = null
    ) {
        $request =new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/consultiva/admin/create/student'),
            new VO\HTTP\Method('POST')
        );

        $header_parameters = array('Authorization' => $token->__toEncodedString());

        $request_parameters = array(
            'apprenticeship_id' => $apprenticeship_id->__toString(),
            'organisation_id' => $organisation_id->__toString(),
            'first_name' => $name->get_first_name()->__toString(),
            'last_name' => $name->get_last_name()->__toString(),
            'gender' => $gender->__toString(),
            'country_code' => $country_code->__toString(),
            'mobile_number' => $mobile_number->__toInteger(),
            'email' => $email->__toString(),
            'image' => $image ? $image->__toString() : '',
            'disability' => $disability->__toInteger(),
            'disability_text' => $disability_text ? $disability_text->__toString() : '',
            'street' => $street->__toString(),
            'city' => $city->__toString(),
            'state' => $state->__toString(),
            'country' => $country->__toString(),
            'postal_code' => $postal_code->__toInteger(),
            'employment' => $employment ? $employment->__toString() : '',
            'further_notes' => $further_notes ? $further_notes->__toString() : '',
            'nationality' => $nationality-> __toString(),
            'date_of_birth' => $date_of_birth ? $date_of_birth-> __toString() : '',
        );

        $response = $request->send($request_parameters, $header_parameters);
        $data = $response->get_data();
        return $data;
    }
}
