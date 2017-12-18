<?php

namespace AcademyHQ\API\HTTP\Request;

use AcademyHQ\API\HTTP\Request\Exception\RequestException;

class Request implements iRequest
{

 	public function __construct(
 		\Guzzle\Http\Client $client,
 		\AcademyHQ\API\Common\Credentials $credentials,
 		\AcademyHQ\API\ValueObjects\Http\Url $url,
 		\AcademyHQ\API\ValueObjects\Http\Method $method
 	)
 	{

 		$this->credentials = $credentials;
 		$this->url = $url->__toString();
 		$this->method = $method->__toString();
 		$this->client = $client;
 	}

    public function send(array $query_parameters = null, array $header_parameters = null) {

        $request_method = strtolower($this->method);

        switch ($request_method) {
            case 'post':
                $response = $this->send_post_request($query_parameters, $header_parameters);
                break;
            case 'put':
                $response = $this->send_put_request($query_parameters, $header_parameters);
                break;
            case 'get':
                $response = $this->send_get_request($query_parameters, $header_parameters);
                break;
            case 'delete':
                $response = $this->send_delete_request($query_parameters, $header_parameters);
                break;
            default:
                die("Http method ".$request_method." not allowed"); 
                break;
        }

        return $response;
    }

 	public function send_get_request(array $query_parameters = null, array $header_parameters = null) 
 	{
 		try {

            $query = array();

            if($query_parameters) {
                foreach ($query_parameters as $key => $value) {
                    $query[$key] = $value;
                }
            }

            $query['app_id'] = $this->credentials->get_app_id();

            $query['app_signature'] = $this->generate_app_signature($this->url, $this->credentials->get_secret_key(), $query);

            $headers = array(
                'Accept' => 'application/json'
            );

            if($header_parameters) {
                foreach($header_parameters as $key => $value) {
                    $headers[$key] = $value;
                }
            }

            $request_url = $this->url. '/?' . http_build_query($query, '', '&');

            $request = $this->client->get($request_url, $headers);

            $response = $request->send();

        	return new \AcademyHQ\API\HTTP\Response\Response($response);
        	
        } catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {

            return $e->getMessage();
        } catch (RequestException $e) {

            return $e->getMessage();
        }
 	}

    public function send_post_request(array $query_parameters = null, array $header_parameters = null) {

        try {

            $multipart = array();

            foreach ($query_parameters as $key => $value) {

                if($key != 'file'){
                    $multipart[$key] = $value;
                }
            }

            $multipart['app_id'] = $this->credentials->get_app_id();

            $multipart['app_signature'] = $this->generate_app_signature($this->url, $this->credentials->get_secret_key(), $multipart);

            $headers = array(
                'Accept' => 'application/json',
                'Origin' => (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]"
            );

            if($header_parameters) {
                foreach($header_parameters as $key => $value) {
                    $headers[$key] = $value;
                }
            }

            $request = $this->client->post($this->url, $headers, $multipart);

            if(array_key_exists('file', $query_parameters)){
                $request->addPostFile('file',$query_parameters['file']);
            }

            $response = $request->send();

            return new \AcademyHQ\API\HTTP\Response\Response($response);
            
        } catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {

            return $e->getMessage();
        } catch (RequestException $e) {

            return $e->getMessage();
        }
    }

    public function send_put_request(array $query_parameters = null, array $header_parameters = null) {
        
        try {

            $multipart = array();

            foreach ($query_parameters as $key => $value) {

                $multipart[$key] = $value;
            }

            $multipart['app_id'] = $this->credentials->get_app_id();

            $multipart['app_signature'] = $this->generate_app_signature($this->url, $this->credentials->get_secret_key(), $multipart);

            $headers = array(
                'Accept' => 'application/json'
            );

            if($header_parameters) {
                foreach($header_parameters as $key => $value) {
                    $headers[$key] = $value;
                }
            }

            $request = $this->client->put($this->url, $headers, $multipart);

            $response = $request->send();

            return new \AcademyHQ\API\HTTP\Response\Response($response);
            
        } catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {

            return $e->getMessage();
        } catch (RequestException $e) {

            return $e->getMessage();
        }
    }

    public function send_delete_request(array $query_parameters = null, array $header_parameters = null) {
        
        try {

            $query = array();

            if($query_parameters) {
                foreach ($query_parameters as $key => $value) {
                    $query[$key] = $value;
                }
            }

            $query['app_id'] = $this->credentials->get_app_id();

            $query['app_signature'] = $this->generate_app_signature($this->url, $this->credentials->get_secret_key(), $query);

            $headers = array(
                'Accept' => 'application/json'
            );

            if($header_parameters) {
                foreach($header_parameters as $key => $value) {
                    $headers[$key] = $value;
                }
            }

            $request = $this->client->delete($this->url, $headers, $query);

            $response = $request->send();

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