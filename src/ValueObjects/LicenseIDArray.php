<?php

namespace AcademyHQ\API\ValueObjects;

class LicenseIDArray {

	private $license_ids;

	public static function fromNative()
    {
        $args = func_get_args();

        $license_ids = array();

        foreach($args[0] as $arg) {
        	$licesne_id  = new LicenseID($arg);
        	$license_ids[] = $licesne_id;
        }

        return new self($license_ids);
    }

    public function __construct(array $license_ids)
    {
        $this->license_ids  = $license_ids;
    }

    public function get_licenses() {
    	return $this->license_ids;
    }

    public function __toArray() {

    	$data = array();
    	foreach($this->license_ids as $license_id) {
    		$data[] = $license_id->__toString();
    	}

    	return $data;
    }
}