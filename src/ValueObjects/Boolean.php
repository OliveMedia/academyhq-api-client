<?php

namespace AcademyHQ\API\ValueObjects;

use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class Boolean
{
	protected $value;

	public function __construct($value)
	{
		if($value != null)
        {
            $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);

            if (false === $value) {
                throw new InvalidValueObjectsArgumentException($value, 'Boolean');
            }
        }

        $this->value = $value;
	}

	/**
     * Returns the value of the booleam
     *
     * @return boolean
     */
    public function toNative()
    {
        $value = $this->value;

        return \boolval($value);
    }

    /**
     * Returns the value of the boolean
     *
     * @return boolean
     */
    public function __toBoolean()
    {
        return $this->toNative();
    }
}