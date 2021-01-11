<?php

namespace AcademyHQ\API\Common;

use AcademyHQ\API\ValueObjects\AppID;
use AcademyHQ\API\ValueObjects\SecretKey;

class Credentials
{

	private $app_id;
	private $secret_key;
	private $lang;
	private $client_lang;

	public function __construct(
		AppID $app_id,
		SecretKey $secret_key,
		$lang = 'en',
		$client_lang = 'en'
	)
	{
		$this->app_id = $app_id->__toString();
		$this->secret_key = $secret_key->__toString();
		$this->lang = $lang;
		$this->client_lang = $client_lang;
	}

	public function get_app_id()
	{
		return $this->app_id;
	}

	public function get_secret_key()
	{
		return $this->secret_key;
	}

	public function get_lang()
	{
		return $this->lang;
	}

	public function get_client_lang()
	{
		return $this->client_lang;
	}
}