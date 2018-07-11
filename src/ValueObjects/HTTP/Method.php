<?php

namespace AcademyHQ\API\ValueObjects\HTTP;

use AcademyHQ\API\ValueObjects\StringVO;
use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;
use AcademyHQ\API\ValueObjects\Exception\MethodNotAllowedException;

class Method extends StringVO
{
	private $allowed_methods = array('POST', 'PUT', 'GET', 'DELETE');

	public function __construct($value) 
	{
		if(!in_array(strtoupper($value), $this->allowed_methods)) 
		{
			throw new MethodNotAllowedException($value, $this->allowed_methods);
		}

		parent::__construct($value);
	}
}