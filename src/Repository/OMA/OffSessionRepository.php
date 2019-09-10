<?php

namespace AcademyHQ\API\Repository\OMA;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\BaseRepository;

/**
 * Class OffSessionRepository
 *
 * @package AcademyHQ\API\Repository\OMA
 */
class OffSessionRepository extends BaseRepository
{

	/**
	 * OffSessionRepository constructor.
	 *
	 * @param Credentials $credentials
	 */
	public function __construct(Credentials $credentials)
	{
		parent::__construct();
		$this->credentials = $credentials;
		$this->base_url .= '/oma';
	}

	/**
	 * Get Program Details
	 * @param VO\Token   $token
	 * @param VO\Integer $occupation_id
	 *
	 * @return \AcademyHQ\API\HTTP\Response\json
	 * @throws VO\Exception\MethodNotAllowedException
	 * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
	 */
	public function get_occupation_details(
		VO\Integer $occupation_id
	) {
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/out_session/occupation/details'),
			new VO\HTTP\Method('POST')
		);
		$request_parameters = array(
			'occupation_id' => $occupation_id->__toInteger(),
		);
		$response = $request->send($request_parameters, null);
		$data = $response->get_data();
		return $data;
	}

}
