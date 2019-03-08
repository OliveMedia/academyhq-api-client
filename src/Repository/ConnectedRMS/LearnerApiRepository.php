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
        VO\Token $token,
        VO\Integer $current_page
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

        $request_parameters = array(
            'current_page' => $current_page->__toInteger()
        );

        $response = $request->send($request_parameters, $headerParams);

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

    public function get_enrollment_launch_url_detail(
        Vo\Integer $enrollmentId,
        VO\Token $token,
        VO\StringVO $callbackUrl
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->get_url().'/learner/get/enrollment/' . $enrollmentId->__toInteger() . '/launch/url'),
            new VO\HTTP\Method('GET')
        );

        $headerParams = array(
            'Authorization' => $token->__toEncodedString()
        );
        $request_parameters = array(
            'callback_url' => $callbackUrl->__toString()
        );

        $response = $request->send($request_parameters, $headerParams);
        $data = $response->get_data();

        return $data;
    }

    public function enrollment_callback(
        Vo\Integer $enrollmentId,
        VO\Token $token
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->get_url().'/learner/get/enrollment/' . $enrollmentId->__toInteger() . '/callback'),
            new VO\HTTP\Method('GET')
        );

        $headerParams = array(
            'Authorization' => $token->__toEncodedString()
        );
        $request_parameters = array(
        );

        $response = $request->send($request_parameters, $headerParams);
        $data = $response->get_data();

        return $data;
    }

    public function get_all_bundles(
        VO\Token $token,
        VO\Integer $current_page
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

        $request_parameters = array(
            'current_page' => $current_page->__toInteger()
        );

        $response = $request->send($request_parameters, $headerParams);

        $data = $response->get_data();

        return $data;
    }

    public function get_bundle_detail(
        Vo\Integer $bundleId,
        VO\Token $token
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->get_url().'/learner/get/bundle/' . $bundleId->__toInteger()),
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
        VO\Token $token,
        VO\Integer $current_page
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

        $request_parameters = array(
            'current_page' => $current_page->__toInteger()
        );

        $response = $request->send($request_parameters, $headerParams);

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

    public function get_all_videos(
        VO\Token $token,
        VO\Integer $current_page
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->get_url().'/learner/get/videos'),
            new VO\HTTP\Method('GET')
        );

        $headerParams = array(
            'Authorization' => $token->__toEncodedString()
        );

        $request_parameters = array(
            'current_page' => $current_page->__toInteger()
        );

        $response = $request->send($request_parameters, $headerParams);

        $data = $response->get_data();

        return $data;
    }

    public function get_video_detail(
        Vo\Integer $videoId,
        VO\Token $token
    )
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->get_url().'/learner/get/video/' . $videoId->__toInteger()),
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
