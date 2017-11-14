<?php

namespace AcademyHQ\API\ValueObjects;

class EmailArray {

	private $emails;

	public static function fromNative()
    {
        $args = func_get_args();

        $emails = array();

        foreach($args[0] as $arg) {
        	$email  = new Email($arg);
        	$emails[] = $email;
        }

        return new self($emails);
    }

    public function __construct(array $emails)
    {
        $this->emails  = $emails;
    }

    public function get_emails() {
    	return $this->emails;
    }

    public function __toArray() {

    	$data = array();
    	foreach($this->emails as $email) {
    		$data[] = $email->__toString();
    	}

    	return $data;
    }
}