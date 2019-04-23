<?php
/**
 * Created by PhpStorm.
 * User: basu
 * Date: 3/14/19
 * Time: 3:11 PM
 */

namespace AcademyHQ\API\Repository\Adecco;

use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Repository\BaseRepository;

class AdeccoOrganisationApiRepository extends BaseRepository
{

    public function __construct(Credentials $credentials)
    {
        parent::__construct();
        $this->credentials = $credentials;

    }

    public function getOrganizationTeams(
            VO\Token  $token
        )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/onscensus/get/organization/teams'),
            new VO\HTTP\Method('GET')
        );

        $headerParameters = array('Authorization' => $token->__toEncodedString());

        $response = $request->send(array(), $headerParameters);

        $data = $response->get_data();

        return $data;
    }


}
