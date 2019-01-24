<?php

namespace AcademyHQ\API\Repository\ConnectedRMS;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;

class LearnerApiRepository extends BaseRepository{

    public function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;

    }

    private function get_url(){
        return $this->base_url.'/crms';
    }

    public function get_all_enrollments(
        VO\Token $token
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->get_url().'/learner/get/enrollments'),
            new VO\HTTP\Method('GET')
        );

        $headerParams = array(
            'Authorization' => $token->__toEncodedString()
        );


        $response = $request->send(array(), $headerParams);

        $data = $response->get_data();

        return $data;
    }

    public function get_enrollment_detail(
        Vo\Integer $enrollmentId,
        VO\Token $token
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->get_url().'/learner/get/enrollment/' . $enrollmentId->__toInteger()),
            new VO\HTTP\Method('GET')
        );

        $headerParams = array(
            'Authorization' => $token->__toEncodedString()
        );

        $response = $request->send(array(), $headerParams);
        $data = $response->get_data();

        return $data;
    }

    public function get_all_bundles(
        VO\Token $token
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->get_url().'/learner/get/bundles'),
            new VO\HTTP\Method('GET')
        );

        $headerParams = array(
            'Authorization' => $token->__toEncodedString()
        );


        $response = $request->send(array(), $headerParams);

        $data = $response->get_data();

        return $data;
    }

    public function get_all_certificates(
        VO\Token $token
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->get_url().'/learner/get/certificates'),
            new VO\HTTP\Method('GET')
        );

        $headerParams = array(
            'Authorization' => $token->__toEncodedString()
        );

        $response = $request->send(array(), $headerParams);

        $data = $response->get_data();

        return $data;
    }

    public function get_certificate_detail(
        Vo\Integer $certificateId,
        VO\Token $token
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->get_url().'/learner/get/certificate/enrollment/' . $certificateId->__toInteger()),
            new VO\HTTP\Method('GET')
        );

        $headerParams = array(
            'Authorization' => $token->__toEncodedString()
        );

        $response = $request->send(array(), $headerParams);
        $data = $response->get_data();

        return $data;
    }

}
