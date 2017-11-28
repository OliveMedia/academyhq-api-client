<?php

namespace AcademyHQ\API\ValueObjects;

class AttachmentIDArray {

	private $attachment_ids;

	public static function fromNative()
    {
        $args = func_get_args();

        $attachment_ids = array();

        foreach($args[0] as $arg) {
        	$attachment_id  = new ID($arg);
        	$attachment_ids[] = $attachment_id;
        }

        return new self($attachment_ids);
    }

    public function __construct(array $attachment_ids)
    {
        $this->attachment_ids  = $attachment_ids;
    }

    public function get_licenses() {
    	return $this->attachment_ids;
    }

    public function __toArray() {

    	$data = array();
    	foreach($this->attachment_ids as $attachment_id) {
    		$data[] = $attachment_id->__toString();
    	}

    	return $data;
    }
}