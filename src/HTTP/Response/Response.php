<?php

namespace AcademyHQ\API\HTTP\Response;
use Guzzle\Http\Message\Response as GuzzleResponse;
use AcademyHQ\API\HTTP\Response\Exception\ResponseException;

class Response implements iResponse
{
	private $response;

	public function __construct(GuzzleResponse $response)
	{
		$this->response = $response;
 	}

 	public function get_response() 
 	{
 		return $this->response;
 	}

 	/**
     * get the json decoded data.
     *
     * @throws \AcademyHQ\API\HTTP\Response\Exception\ResponseException
     * @return json decoded data
     */

 	public function get_data()
 	{
 		$json_data = $this->response->getBody();

 		$data = json_decode($json_data);

 		// print_r($data);exit();

 		if($data->status == 'Fail')
 		{
 			throw new ResponseException($data->errors);
 		}

 		return $data;
 	}
}