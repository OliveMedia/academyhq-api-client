<?php

namespace AcademyHQ\API\Common;

use AcademyHQ\API\ValueObjects\AppID;
use AcademyHQ\API\ValueObjects\SecretKey;

class Credentials
{

	private $app_id;
	private $secret_key;

	public function __construct(
		AppID $app_id,
		SecretKey $secret_key
	)
	{
		$this->app_id = $app_id->__toString();
		$this->secret_key = $secret_key->__toString();
	}

	public function get_app_id()
	{
		return $this->app_id;
	}

	public function get_secret_key()
	{
		return $this->secret_key;
	}
}