<?php

namespace AcademyHQ\API\ValueObjects\Exception;

class MethodNotAllowedException extends \Exception 
{
	public function __construct($value, $allowed_types) {

		$this->value = $value;
		$this->allowed_types = $allowed_types;

		$this->message = 'Method ' .$this->value. ' is invalid. Allowed types for method are ' .implode(', ', $this->allowed_types);
	}
}