<?php

namespace AcademyHQ\API\Repository\OSA;

use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\HTTP\Request\Request as Request;
use AcademyHQ\API\Repository\BaseRepository;
use AcademyHQ\API\ValueObjects as VO;
use Guzzle\Http\Client as GuzzleClient;

class BookingRepository extends BaseRepository{

	
	public function __construct(Credentials $credentials)
	{
		parent::__construct();
		$this->credentials 	= $credentials;
		$this->base_url 	.= '/classroom-course';
	}

	/**
	* @return response
	*/
	
	public function book(
		VO\Integer $booking_id,
		VO\Integer $user_id,
		VO\Integer $course_id,
		VO\StringVO $course_name =null,
		VO\Integer $no_seats = null,
		VO\Integer $event_id = null,
		VO\Integer $user_type_id = null,
		VO\StringVO $company_name = null,
		VO\StringVO $company_contact = null,
		VO\StringVO $bdm = null,
		VO\StringVO $mh_required = null,
		VO\StringVO $pay_comment = null,
		VO\StringVO $transaction_id = null,
		VO\StringVO $event_dates = null,
		VO\Integer $payment_status = null,
		VO\StringVO $client_name = null,
		VO\StringVO $type = null,
		VO\StringVO $booking_description = null,
		VO\StringVO $payment_information = null,
		VO\StringVO $admin_name = null,
		VO\StringVO $admin_email =null,
		VO\StringVO $attendees =null
	)
	{

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/book'),
			new VO\HTTP\Method('POST')
		);


		$request_parameters = array(
			'booking_id' => $booking_id->__toInteger(),
			'user_id' => $user_id->__toInteger(),
			'course_id' => $course_id->__toInteger(),
			
		);

		if(!is_null($course_name)){
			$request_parameters['course_name'] = $course_name->__toString();
		}

		if(!is_null($no_seats)){
			$request_parameters['no_seats'] = $no_seats->__toInteger();
		}

		if(!is_null($event_id)){
			$request_parameters['event_id'] = $event_id->__toInteger();
		}

		if(!is_null($user_type_id)){
			$request_parameters['user_type_id'] = $user_type_id->__toInteger();
		}

		if(!is_null($company_name)){
			$request_parameters['company_name'] = $company_name->__toString();
		}

		if(!is_null($company_contact)){
			$request_parameters['company_contact'] = $company_contact->__toString();
		}

		if(!is_null($bdm)){
			$request_parameters['bdm'] = $bdm->__toString();
		}

		if(!is_null($mh_required)){
			$request_parameters['mh_required'] = $mh_required->__toString();
		}

		if(!is_null($pay_comment)){
			$request_parameters['pay_comment'] = $pay_comment->__toString();
		}

		if(!is_null($transaction_id)){
			$request_parameters['transaction_id'] = $transaction_id->__toString();
		}

		if(!is_null($event_dates)){
			$request_parameters['event_dates'] = $event_dates->__toString();
		}

		if(!is_null($payment_status)){
			$request_parameters['payment_status'] = $payment_status->__toInteger();
		}

		if(!is_null($client_name)){
			$request_parameters['client_name'] = $client_name->__toString();
		}

		if(!is_null($type)){
			$request_parameters['type'] = $type->__toString();
		}

		if(!is_null($booking_description)){
			$request_parameters['booking_description'] = $booking_description->__toString();
		}

		if(!is_null($payment_information)){
			$request_parameters['payment_information'] = $payment_information->__toString();
		}

		if(!is_null($admin_name)){
			$request_parameters['admin_name'] = $admin_name->__toString();
		}

		if(!is_null($admin_email)){
			$request_parameters['admin_email'] = $admin_email->__toString();
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