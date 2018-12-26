<?php

namespace AcademyHQ\API\Repository\OSA;

use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\HTTP\Request\Request as Request;
use AcademyHQ\API\Repository\BaseRepository;
use AcademyHQ\API\ValueObjects as VO;
use Guzzle\Http\Client as GuzzleClient;

class ClassroomRepository extends BaseRepository{

	
	public function __construct(Credentials $credentials)
	{
		parent::__construct();
		$this->credentials 	= $credentials;
		$this->base_url 	.= '/classroom';
	}

	
	/**
	* @return response
	*/
	
	public function public_book(
	
		VO\Integer $course_id 				= null,
		VO\Integer $no_seats 				= null,
		VO\StringVO $event_dates 			= null,
		VO\Integer $payment_status 			= null,
		VO\StringVO $booking_description 	= null,
		VO\StringVO $payment_information 	= null,
		VO\StringVO $attendees 				= null
	)
	{

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/book/public'),
			new VO\HTTP\Method('POST')
		);


		$request_parameters = array();

		if(!is_null($course_id)){
			$request_parameters['course_id'] = $course_id->__toInteger();
		}

		if(!is_null($no_seats)){
			$request_parameters['no_seats'] = $no_seats->__toInteger();
		}

		if(!is_null($event_dates)){
			$request_parameters['event_dates'] = $event_dates->__toString();
		}

		if(!is_null($payment_status)){
			$request_parameters['payment_status'] = $payment_status->__toInteger();
		}

		if(!is_null($booking_description)){
			$request_parameters['booking_description'] = $booking_description->__toString();
		}

		if(!is_null($payment_information)){
			$request_parameters['payment_information'] = $payment_information->__toString();
		}

		if(!is_null($attendees)){
			$request_parameters['attendees'] = $attendees->__toString();
		}

		$response = $request->send($request_parameters);
		
		return $response->get_data();
		
	}

	/**
	* @return response
	*/
	
	public function private_book(
	
		VO\Integer $course_id 				= null,
		VO\Integer $no_seats 				= null,
		VO\StringVO $event_dates 			= null,
		VO\Integer $payment_status 			= null,
		VO\StringVO $booking_description 	= null,
		VO\StringVO $payment_information 	= null,
		VO\StringVO $client_name 			= null,
		VO\StringVO $admin_first_name 		= null,
		VO\StringVO $admin_last_name 		= null,
		VO\StringVO $admin_email 			= null,
		VO\StringVO $attendees 				= null
	)
	{

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/book/private'),
			new VO\HTTP\Method('POST')
		);


		$request_parameters = array();

		if(!is_null($course_id)){
			$request_parameters['course_id'] = $course_id->__toInteger();
		}

		if(!is_null($no_seats)){
			$request_parameters['no_seats'] = $no_seats->__toInteger();
		}

		if(!is_null($event_dates)){
			$request_parameters['event_dates'] = $event_dates->__toString();
		}

		if(!is_null($payment_status)){
			$request_parameters['payment_status'] = $payment_status->__toInteger();
		}

		if(!is_null($booking_description)){
			$request_parameters['booking_description'] = $booking_description->__toString();
		}

		if(!is_null($payment_information)){
			$request_parameters['payment_information'] = $payment_information->__toString();
		}

		if(!is_null($client_name)){
			$request_parameters['client_name'] = $client_name->__toString();
		}

		if(!is_null($admin_first_name)){
			$request_parameters['admin_first_name'] = $admin_first_name->__toString();
		}

		if(!is_null($admin_last_name)){
			$request_parameters['admin_last_name'] = $admin_last_name->__toString();
		}

		if(!is_null($admin_email)){
			$request_parameters['admin_email'] = $admin_email->__toString();
		}

		$response = $request->send($request_parameters);
		
		return $response->get_data();
		
	}

}