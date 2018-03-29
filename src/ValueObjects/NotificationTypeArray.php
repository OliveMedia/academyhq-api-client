<?php

namespace AcademyHQ\API\ValueObjects;

class NotificationTypeArray {

	private $notification_types;

	public static function fromNative()
    {
        $args = func_get_args();

        $notification_types = array();

        foreach($args[0] as $arg) {
        	$notification_type  = new StringVO($arg);
        	$notification_types[] = $notification_type;
        }

        return new self($notification_types);
    }

    public function __construct(array $notification_types)
    {
        $this->notification_types  = $notification_types;
    }

    public function get_licenses() {
    	return $this->notification_types;
    }

    public function __toArray() {

    	$data = array();
    	foreach($this->notification_types as $notification_type) {
    		$data[] = $notification_type->__toString();
    	}

    	return $data;
    }
}