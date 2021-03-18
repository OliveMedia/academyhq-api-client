<?php

namespace AcademyHQ\API\Repository;

use Faker\Provider\Base;
use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\Common\Credentials;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\HTTP\Request\Request as Request;

/**
 * Class EnrolmentRepository
 *
 * @package AcademyHQ\API\Repository
 */
class EnrolmentRepository extends BaseRepository
{
	/**
	 * EnrolmentRepository constructor.
	 *
	 * @param Credentials $credentials
	 */
    public function __construct(Credentials $credentials)
    {
        parent::__construct();
        $this->credentials = $credentials;
    }

	/**
	 * @param VO\MemberID  $member_id
	 * @param VO\LicenseID $license_id
	 * @param VO\Flag|null $send_email
	 *
	 * @return mixed
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
    public function create(VO\MemberID $member_id, VO\LicenseID $license_id, VO\Flag $send_email = null)
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/enrolment/create'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'member_id' => $member_id->__toString(),
            'license_id' => $license_id->__toString()
        );

        if($send_email) {
            $request_parameters['send_email'] = $send_email->__toBool();
        }

        $response = $request->send($request_parameters);
        $data = $response->get_data();

        return $data->enrolment_id;
    }

	/**
	 * @param VO\MemberID $member_id
	 *
	 * @return mixed
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function create_for_organisation(VO\MemberID $member_id)
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/enrolment/create/organisation'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'member_id' => $member_id->__toString()
        );

        $response = $request->send($request_parameters);
        $data = $response->get_data();

        return $data->enrolment_ids;
    }

	/**
	 * @param VO\MemberID       $member_id
	 * @param VO\LicenseIDArray $license_id_array
	 * @param VO\Flag|null      $send_email
	 *
	 * @return array
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function create_enrolments(VO\MemberID $member_id, VO\LicenseIDArray $license_id_array, VO\Flag $send_email = null) {

        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/enrolment/create'),
            new VO\HTTP\Method('POST')
        );

        $license_ids = $license_id_array->__toArray();
        $enrolment_ids = array();

        foreach($license_ids as $license_id) {
            $request_parameters = array(
                'member_id' => $member_id->__toString(),
                'license_id' => $license_id
            );

            if($send_email) {
                $request_parameters['send_email'] = $send_email->__toBool();
            }

            $response = $request->send($request_parameters);
            $data = $response->get_data();

            $enrolment_ids[] = $data->enrolment_id;
        }

        return $enrolment_ids;
    }

	/**
	 * @param VO\MemberID  $member_id
	 * @param VO\CourseId  $course_id
	 * @param VO\StringVO  $file_name
	 * @param VO\Integer   $hrs
	 * @param VO\Integer   $mins
	 * @param VO\Integer   $sec
	 * @param VO\StringVO  $issued_at
	 * @param VO\StringVO  $expire_at
	 * @param VO\Flag|null $send_email
	 *
	 * @return mixed
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function create_offline_enrolment(VO\MemberID $member_id, VO\CourseId $course_id, VO\StringVO $file_name, VO\Integer $hrs, VO\Integer $mins, VO\Integer $sec, VO\StringVO $issued_at, VO\StringVO $expire_at, VO\Flag $send_email = null)
    {
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/enrolment/offline/create'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'member_id' => $member_id->__toString(),
            'course_id' => $course_id->__toString(),
            'file' => $file_name->__toString(),
            'hrs' => $hrs->__toInteger(),
            'mins' => $mins->__toInteger(),
            'sec' => $sec->__toInteger(),
            'expire_at' => $expire_at->__toString(),
            'issued_at' => $issued_at->__toString()
        );

        if($send_email) {
            $request_parameters['send_email'] = $send_email->__toBool();
        }

        $response = $request->send($request_parameters);
        $data = $response->get_data();

        return $data->enrolment_id;
    }


	/**
	 * @param VO\MemberID $member_id
	 *
	 * @return mixed
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
    public function get_all_for_member(VO\MemberID $member_id)
    {
        $member_id = $member_id->__toString();
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/member_enrolments/'.$member_id.'/get'),
            new VO\HTTP\Method('GET')
        );

        $response = $request->send();
        $data = $response->get_data();

        return $data->enrolments;
    }


	/**
	 * @param VO\EnrolmentID $enrolment_id
	 *
	 * @return mixed
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
    public function get(VO\EnrolmentID $enrolment_id)
    {
        $enrolment_id = $enrolment_id->__toString();
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/enrolment/'.$enrolment_id.'/get'),
            new VO\HTTP\Method('GET')
        );

        $response = $request->send();
        $data = $response->get_data();

        return $data->enrolment;
    }


	/**
	 * @param VO\EnrolmentID $enrolment_id
	 *
	 * @return mixed
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
    public function delete(VO\EnrolmentID $enrolment_id)
    {
        $enrolment_id = $enrolment_id->__toString();
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/enrolment/'.$enrolment_id.'/delete'),
            new VO\HTTP\Method('DELETE')
        );

        $response = $request->send();
        $data = $response->get_data();

        return $data->message;
    }


	/**
	 * @param VO\EnrolmentID $enrolment_id
	 * @param VO\HTTP\Url    $callback_url
	 *
	 * @return mixed
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
    public function get_launch_url(VO\EnrolmentID $enrolment_id, VO\HTTP\Url $callback_url)
    {
        $enrolment_id = $enrolment_id->__toString();
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/enrolment/'.$enrolment_id.'/launch/url'),
            new VO\HTTP\Method('GET')
        );

        $callback_url = $callback_url->__toString();

        $response = $request->send(array('callback_url' => $callback_url));;
        $data = $response->get_data();

        return $data->launch_url;
    }

	/**
	 * @param VO\EnrolmentID $enrolment_id
	 *
	 * @return mixed
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
    public function sync_result(VO\EnrolmentID $enrolment_id)
    {
        $enrolment_id = $enrolment_id->__toString();
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/enrolment/'.$enrolment_id.'/callback'),
            new VO\HTTP\Method('GET')
        );

        $response = $request->send();
        $data = $response->get_data();

        return $data->enrolment;
    }


	/**
	 * Sync Result from OMA Enrollment
	 * @param VO\EnrolmentID     $enrolment_id
	 * @param VO\MemberProgramID $member_program_id
	 *
	 * @return mixed
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
    public function sync_oma_enrollment_result(
	    VO\EnrolmentID $enrolment_id,
		VO\MemberProgramID $member_program_id
	)
    {
        $enrolment_id = $enrolment_id->__toString();
        $member_program_id = $member_program_id->__toString();
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/oma/student/enrolment/'.$enrolment_id.'/' . $member_program_id . '/sync_result'),
            new VO\HTTP\Method('GET')
        );

        $response = $request->send();
        $data = $response->get_data();

        return $data->enrolment;
    }

	/**
	 * @param VO\MemberCertificateID $member_certificate_id
	 *
	 * @return mixed
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
    public function get_certificate(VO\MemberCertificateID $member_certificate_id) {

        $member_certificate_id = $member_certificate_id->__toString();
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/certificate/'.$member_certificate_id.'/get'),
            new VO\HTTP\Method('GET')
        );

        $response = $request->send();
        $data = $response->get_data();

        return $data->certificate;
    }

	/**
	 * @param VO\MemberCertificateID $member_certificate_id
	 *
	 * @return mixed
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
    public function get_certificate_url(VO\MemberCertificateID $member_certificate_id) {

        $member_certificate_id = $member_certificate_id->__toString();
        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/certificate/'.$member_certificate_id.'/download'),
            new VO\HTTP\Method('GET')
        );

        $response = $request->send();
        $data = $response->get_data();

        return $data->certificate_url;
    }

	/**
	 * @param VO\MemberID            $member_id
	 * @param VO\LicenseIDArray|null $license_id_array
	 * @param VO\CourseIDArray|null  $course_id_array
	 *
	 * @return array
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
    public function create_bulK_enrolments(VO\MemberID $member_id, VO\LicenseIDArray $license_id_array = null, VO\CourseIDArray $course_id_array = null) {

        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url.'/bulk/enrolment/create'),
            new VO\HTTP\Method('POST')
        );

        $enrolment_ids = array();

        $license_ids = $license_id_array->__toArray();

        $course_ids = $course_id_array->__toArray();

        if(isset($license_ids)) {

            foreach ($license_ids as $license_id) {

                $request_parameters = array(
                    'member_id' => $member_id->__toString(),
                    'licenses_ids' => $license_ids
                );

                $response = $request->send($request_parameters);

                $data = $response->get_data();

                $enrolment_ids[] = $data->enrolment_ids;
            }
        }

        if(isset($course_ids)) {

            foreach ($course_ids as $course_id) {

                $request_parameters = array(
                    'member_id' => $member_id->__toString(),
                    'courses_ids' => $course_ids
                );

                $response = $request->send($request_parameters);

                $data = $response->get_data();

                $enrolment_ids[] = $data->enrolment_ids;
            }
        }

        return $enrolment_ids;
    }
}