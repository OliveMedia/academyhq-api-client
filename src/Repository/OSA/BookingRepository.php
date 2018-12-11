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
		$this->credentials = $credentials;
		$this->base_url = 'http://api.academyhq.localhost/api/v2/classroom-course';
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
		VO\StringVO $admin_email =null
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
			'course_name' => ($course_name !==null ? $course_name->__toString():null),
			'no_seats' => ($no_seats !==null ? $no_seats->__toInteger():null),
			'event_id' => ($event_id !==null ? $event_id->__toInteger():null),
			'user_type_id' => ($user_type_id !==null ? $user_type_id->__toInteger():null),
			'company_name' => ($company_name !==null ? $company_name->__toString():null),
			'company_contact' => ($company_contact !==null ? $company_contact->__toString():null),
			'bdm' => ($bdm !==null ? $bdm->__toString():null),
			'mh_required' => ($mh_required !==null ? $mh_required->__toString():null),
			'pay_comment' => ($pay_comment !==null ? $pay_comment->__toString():null),
			'transaction_id' => ($transaction_id !==null ? $transaction_id->__toString():null),
			'event_dates' => ($event_dates !==null ? $event_dates->__toString():null),
			'payment_status' => ($payment_status !==null ? $payment_status->__toInteger():null),
			'client_name' =>  ($client_name !==null ? $client_name->__toString():null),
			'type' => ($type !==null ? $type->__toString():null),
			'booking_description' => ($client_name !==null ? $client_name->__toString():null),
			'payment_information' => ($payment_information !==null ? $payment_information->__toString():null),
			'admin_name' => ($admin_name !==null ? $admin_name->__toString():null),
			'admin_email' => ($admin_email !==null ? $admin_email->__toString():null)
			
		);
		$response = $request->send($request_parameters);

		return $response->get_data();
		
	}

}