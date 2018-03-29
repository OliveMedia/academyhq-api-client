<?php

namespace AcademyHQ\API\HTTP\Response;

use Guzzle\Http\Message\Response as GuzzleResponse;

interface iResponse
{

 	public function __construct(GuzzleResponse $response);

 	public function get_response();

 	public function get_data();
}