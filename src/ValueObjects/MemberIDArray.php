<?php

namespace AcademyHQ\API\ValueObjects;

class MemberIDArray {

	private $member_ids;

	public static function fromNative()
    {
        $args = func_get_args();

        $member_ids = array();

        foreach($args[0] as $arg) {
        	$member_id  = new MemberID($arg);
        	$member_ids[] = $member_id;
        }

        return new self($member_ids);
    }

    public function __construct(array $member_ids)
    {
        $this->member_ids  = $member_ids;
    }

    public function get_licenses() {
    	return $this->member_ids;
    }

    public function __toArray() {

    	$data = array();
    	foreach($this->member_ids as $member_id) {
    		$data[] = $member_id->__toString();
    	}

    	return $data;
    }
}