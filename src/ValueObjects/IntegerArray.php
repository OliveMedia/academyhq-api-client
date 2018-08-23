<?php

/**
 * to implements this CourseIDArray
 * example new VO\CourseIDArray(array(new VO\CourseID(1), new VO\CourseID(2)))
 */
namespace AcademyHQ\API\ValueObjects;

class IntegerArray
{
    private $ids;

    public static function fromNative()
    {
        $args = func_get_args();

        $ids = array();

        foreach ($args[0] as $arg) {
            $id  = new IDs($arg);
            $ids[] = $id;
        }

        return new self($ids);
    }

    public function __construct(array $ids)
    {
        $this->ids  = $ids;
    }

    public function get_ids()
    {
        return $this->ids;
    }

    public function __toArray()
    {
        $data = array();
        foreach ($this->ids as $id) {
            $data[] = $id->__toString();
        }

        return $data;
    }
}
