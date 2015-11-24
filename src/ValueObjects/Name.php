<?php

namespace AcademyHQ\API\ValueObjects;

use AcademyHQ\API\ValueObjects\String;

class Name
{
    
    private $first_name;

    private $last_name;

    public static function fromNative()
    {
        $args = func_get_args();

        $firstName  = new String($args[0]);
        $lastName   = new String($args[1]);

        return new self($firstName, $lastName);
    }

    /**
     * Returns a Name object
     *
     * @param String $first_name
     * @param String $middle_name
     * @param String $last_name
     */
    public function __construct(String $first_name, String $last_name)
    {
        $this->first_name  = $first_name;
        $this->last_name   = $last_name;
    }

    /**
     * Returns the first name
     *
     * @return String
     */
    public function get_first_name()
    {
        return $this->first_name;
    }

    /**
     * Returns the last name
     *
     * @return String
     */
    public function get_last_name()
    {
        return $this->last_name;
    }

    /**
     * Returns the full name
     *
     * @return string
     */
    public function get_full_name()
    {
        $full_name = $this->first_name .
            ($this->last_name->isEmpty() ? '' : ' ' . $this->last_name);

        return $full_name;
    }

    /**
     * Returns the full name
     *
     * @return string
     */
    public function __toString()
    {
        return $this->get_full_name();
    }
}
