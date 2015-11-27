<?php

namespace AcademyHQ\API\ValueObjects;

use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class ID
{
	protected $value;

	public function __construct($value)
	{
		if($value == null || $value == '')
		{
			throw new InvalidValueObjectsArgumentException($value, 'ID');
		}
		$this->value = $value;
	}

	public function toNative()
    {
        return $this->value;
    }

    public function __toString()
    {
        return \strval($this->toNative());
    }
}