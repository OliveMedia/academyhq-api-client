<?php

namespace AcademyHQ\API\ValueObjects\Exception;

class InvalidValueObjectsArgumentException extends \Exception 
{
	public function __construct($value, $allowed_type) {

		$this->value = $value;
		$this->allowed_type = $allowed_type;

		$this->message = 'Argument ' .$this->value. ' is invalid. Allowed type for argument is ' .$this->allowed_type;
	}
}