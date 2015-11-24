<?php

namespace AcademyHQ\API\HTTP\Request

interface iRequest
{

 	public function __construct(
 		\Guzzle\Service\Client $client,
 		\AcademyHQ\API\Common\Credentials $credentials,
 		\AcademyHQ\API\ValueObjects\Http\Url $url,
 		\AcademyHQ\API\ValueObjects\Http\Method $method
 	);

 	/**
     * Sends the requests and returns a Response, or an Exception.
     *
     * @throws \Academyhq\API\HTTP\Request\Exception
     * @return \AcademyHQ\API\HTTP\Response\Response
     */

 	public function send(array $query_parameters = null);
}