<?php

namespace AcademyHQ\API\ValueObjects;

use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class StringVO
{
    protected $value;

    /**
     * Returns a String object given a PHP native string as parameter.
     *
     * @param string $value
     */
    public function __construct($value)
    {
        if (false === \is_string($value)) {
            throw new InvalidValueObjectsArgumentException($value, 'String');
        }

        $this->value = $value;
    }

    /**
     * Returns the value of the string
     *
     * @return string
     */
    public function toNative()
    {
        return $this->value;
    }

     public function isEmpty()
    {
        return \strlen($this->toNative()) == 0;
    }

    /**
     * Returns the string value itself
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toNative();
    }

    public function __toEncodedString() {

        return base64_encode($this->toNative());
    }
}
