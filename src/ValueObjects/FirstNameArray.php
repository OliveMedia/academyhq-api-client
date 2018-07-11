<?php

namespace AcademyHQ\API\ValueObjects;

class FirstNameArray {

	private $first_names;

	public static function fromNative()
    {
        $args = func_get_args();

        $first_names = array();

        foreach($args[0] as $arg) {
        	$first_name  = new StringVO($arg);
        	$first_names[] = $first_name;
        }

        return new self($first_names);
    }

    public function __construct(array $first_names)
    {
        $this->first_names  = $first_names;
    }

    public function get_first_names() {
    	return $this->first_names;
    }

    public function __toArray() {

    	$data = array();
    	foreach($this->first_names as $first_name) {
    		$data[] = $first_name->__toString();
    	}

    	return $data;
    }
}