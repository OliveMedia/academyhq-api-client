<?php

namespace AcademyHQ\API\ValueObjects;

class UsernameArray {

	private $usernames;

	public static function fromNative()
    {
        $args = func_get_args();

        $usernames = array();

        foreach($args[0] as $arg) {
        	$username  = new Username($arg);
        	$usernames[] = $username;
        }

        return new self($usernames);
    }

    public function __construct(array $usernames)
    {
        $this->usernames  = $usernames;
    }

    public function get_usernames() {
    	return $this->usernames;
    }

    public function __toArray() {

    	$data = array();
    	foreach($this->usernames as $username) {
    		$data[] = $username->__toString();
    	}

    	return $data;
    }
}