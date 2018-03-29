<?php

namespace AcademyHQ\API\ValueObjects;

class CourseIDArray {

	private $course_ids;

	public static function fromNative()
    {
        $args = func_get_args();

        $course_ids = array();

        foreach($args[0] as $arg) {
        	$course_id  = new CourseID($arg);
        	$course_ids[] = $course_id;
        }

        return new self($course_ids);
    }

    public function __construct(array $course_ids)
    {
        $this->course_ids  = $course_ids;
    }

    public function get_courses() {
    	return $this->course_ids;
    }

    public function __toArray() {

    	$data = array();
    	foreach($this->course_ids as $course_id) {
    		$data[] = $course_id->__toString();
    	}

    	return $data;
    }
}