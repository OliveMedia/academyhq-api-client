<?php

namespace AcademyHQ\API\ValueObjects;

use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class Integer
{
	protected $value;

	public function __construct($value)
	{
		if($value != null)
        {
            $value = filter_var($value, FILTER_VALIDATE_INT);

            if (false === $value) {
                throw new InvalidValueObjectsArgumentException($value, 'Integer');
            }
        }

        $this->value = $value;
	}

	/**
     * Returns the value of the integer number
     *
     * @return int
     */
    public function toNative()
    {
        $value = $this->value;

        return \intval($value);
    }

    /**
     * Returns the value of the integer number
     *
     * @return Integer
     */
    public function __toInteger()
    {
        return $this->toNative();
    }
}