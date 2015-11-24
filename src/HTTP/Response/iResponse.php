<?php

namespace AcademyHQ\API\HTTP\Response

interface iResponse
{

 	public function __construct(
 		\Guzzle\Service\Client $client,
 	);

 	public function get(array $query_parameters = null);
}