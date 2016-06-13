<?php

namespace AcademyHQ\API\Repository;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class PurchaseRepository {

	private $base_url = 'https://api.academyhq.com/api/v2';

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function get_launch_url(VO\LicenseIDArray $license_id_array,VO\MemberID $member_id,VO\StringVO $callback_url) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/purchase/launch_url/get'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'license_ids'   => $license_id_array->__toArray(),
			'member_id'    => $member_id->__toString(),
			'callback_url' => $callback_url->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();
		
		return $data->launch_url;
	}
}