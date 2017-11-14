<?php

namespace AcademyHQ\API\ValueObjects;

class PubIDArray {

	private $pub_ids;

	public static function fromNative()
    {
        $args = func_get_args();

        $pub_ids = array();

        foreach($args[0] as $arg) {
        	$pub_id  = new PublicID($arg);
        	$pub_ids[] = $pub_id;
        }

        return new self($pub_ids);
    }

    public function __construct(array $pub_ids)
    {
        $this->pub_ids  = $pub_ids;
    }

    public function get_pub_ids() {
    	return $this->pub_ids;
    }

    public function __toArray() {

    	$data = array();
    	foreach($this->pub_ids as $pub_id) {
    		$data[] = $pub_id->__toString();
    	}

    	return $data;
    }
}