<?php

namespace AcademyHQ\API\ValueObjects;

class LastNameArray {

	private $last_names;

	public static function fromNative()
    {
        $args = func_get_args();

        $last_names = array();

        foreach($args[0] as $arg) {
        	$last_name  = new StringVO($arg);
        	$last_names[] = $last_name;
        }

        return new self($last_names);
    }

    public function __construct(array $last_names)
    {
        $this->last_names  = $last_names;
    }

    public function get_last_names() {
    	return $this->last_names;
    }

    public function __toArray() {

    	$data = array();
    	foreach($this->last_names as $last_name) {
    		$data[] = $last_name->__toString();
    	}

    	return $data;
    }
}