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

class CourseApiRepository extends BaseRepository
{

    public function __construct(Credentials $credentials)
    {
        parent::__construct();
        $this->credentials = $credentials;

    }

    public function getAllBundles(
            VO\Token  $token,
            VO\Integer $currentPage
        )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/crms/learner/get/organization/bundles'),
            new VO\HTTP\Method('GET')
        );

        $headerParameters = array('Authorization' => $token->__toEncodedString());

        // $requestParameters = array(
        //     'current_page' => $currentPage->__toInteger()
        // );

//        $response = $request->send($requestParameters, $headerParameters);
        $response = $request->send(array(), $headerParameters);

        $data = $response->get_data();

        return $data;
    }

    public function getLearnerBundles(
        VO\Token  $token,
        VO\Integer $currentPage
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/crms/learner/get/bundles'),
            new VO\HTTP\Method('GET')
        );

        $headerParameters = array('Authorization' => $token->__toEncodedString());

        $requestParameters = array(
            'current_page' => $currentPage->__toInteger()
        );

        $response = $request->send($requestParameters, $headerParameters);
        $data = $response->get_data();

        return $data;
    }




}
