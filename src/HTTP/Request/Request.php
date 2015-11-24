<?php

namespace AcademyHQ\API\HTTP\Request

class Request implements iRequest
{

 	public function __construct(
 		\Guzzle\Service\Client $client,
 		\AcademyHQ\API\Common\Credentials $credentials,
 		\AcademyHQ\API\ValueObjects\Http\Url $url,
 		\AcademyHQ\API\ValueObjects\Http\Method $method
 	)
 	{

 		$this->credentials = $credentials;
 		$this->url = $url->__toString();
 		$this->method = $method->__toString();
 		$this->client = $client;

 		$this->request = $this->client->createRequest($this->method, $this->url);
 	}

 	public function send(array $query_parameters = null) 
 	{
 		try {

 			if ( ! is_null($query_parameters)) {
	            $query = $this->request->getQuery();
	            foreach ($query_parameters as $key => $value) {
	                $query[$key] = $value;
	            }
        	}

        	$this->request->setHeader('Authorization', 'accessToken');
        	$this->request->setHeader('Accept', 'application/json');
        	$response = $this->client->send($this->request);

        	return new \AcademyHQ\API\HTTP\Response\Response($response);
        	
        } catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {

            throw $e;
        }
 	}
 }