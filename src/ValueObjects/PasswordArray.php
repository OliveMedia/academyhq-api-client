<?php

namespace AcademyHQ\API\ValueObjects;

class PasswordArray {

	private $passwords;

	public static function fromNative()
    {
        $args = func_get_args();

        $passwords = array();

        foreach($args[0] as $arg) {
        	$password  = new Password($arg);
        	$passwords[] = $password;
        }

        return new self($passwords);
    }

    public function __construct(array $passwords)
    {
        $this->passwords  = $passwords;
    }

    public function get_passwords() {
    	return $this->passwords;
    }

    public function __toArray() {

    	$data = array();
    	foreach($this->passwords as $password) {
    		$data[] = $password->__toString();
    	}

    	return $data;
    }
}