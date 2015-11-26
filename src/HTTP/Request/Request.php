<?php

namespace AcademyHQ\API\HTTP\Request;

use AcademyHQ\API\HTTP\Request\Exception\RequestException;

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

            $query_parameters['app_id'] = $this->credentials->get_app_id();
            $query = $this->request->getQuery();
            foreach ($query_parameters as $key => $value) {
                $query[$key] = $value;
            }

            $query['app_signature'] = $this->generate_app_signature($this->url, $this->credentials->get_secret_key(), $query_parameters);

        	$this->request->setHeader('Accept', 'application/json');
        	$response = $this->client->send($this->request);

        	return new \AcademyHQ\API\HTTP\Response\Response($response);
        	
        } catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {

            return $e->getMessage();
        } catch (RequestException $e) {

            return $e->getMessage();
        }
 	}

    private function generate_app_signature($url, $secret_key, $params)
    {
        $path = \parse_url($url, PHP_URL_PATH);

        ksort($params);
        $query_string = $path . '/?' . http_build_query($params, '', '&');

        return hash_hmac("sha256", $query_string, $secret_key); 
    }
 }