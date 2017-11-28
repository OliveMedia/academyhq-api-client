<?php

namespace AcademyHQ\API\Repository\WebClient;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class NotificationRepository {
	
	private $base_url = 'https://api.academyhq.com/api/v2/web/client';

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function member_web_notifications(VO\Token $token, VO\MemberID $member_id) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/notification/member/'.$member_id.'/web_notifications'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send($header_parameters);

		$data = $response->get_data();

		return $data->notifications;
	}

	public function sender_web_notifications(VO\Token $token, VO\MemberID $sender_id) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/notification/sender/'.$sender_id.'/web_notifications'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send($header_parameters);

		$data = $response->get_data();

		return $data->notifications;
	}

	public function web_notification(VO\Token $token, VO\NotificationID $snotification_id) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/notification/'.$snotification_id.'/web_notification'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send($header_parameters);

		$data = $response->get_data();

		return $data->notification;
	}

	public function member_notifications(VO\Token $token) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/notification/member/notifications'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send($header_parameters);

		$data = $response->get_data();

		return $data->notifications;
	}

	public function create_notification(
		VO\Token $token,
		VO\MemberIDArray $member_id_array,
		VO\StringVO $notification_message,
		VO\NotificationTypeArray $notification_type_array,
		VO\AttachmentIDArray $attachment_id_array = null
	)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/notification/create/notification'),
			new VO\HTTP\Method('POST')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$member_ids = $member_id_array->__toArray();

		$notification_types = $notification_type_array->__toArray();

		$attachment_ids = $attachment_id_array->__toArray();

		$request_parameters = array(
			'members' => $member_ids,
			'notification_message' => $notification_message->__toString(),
			'notification_types' => $notification_types,
			'attachments' => $attachment_ids
		);

		$response = $request->send($request_parameters, $header_parameters);

		$data = $response->get_data();

		return $data;
	}
}