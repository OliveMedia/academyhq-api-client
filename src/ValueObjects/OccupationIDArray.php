<?php

/**
 * to implements this OccupationIDArray
 * example new VO\OccupationIDArray(array(new VO\OccupationID(1), new VO\OccupationID(2)))
 */
namespace AcademyHQ\API\ValueObjects;

class OccupationIDArray
{
    private $occupation_ids;

    public static function fromNative()
    {
        $args = func_get_args();

        $occupation_ids = array();

        foreach ($args[0] as $arg) {
            $occupation_id  = new OccupationID($arg);
            $occupation_ids[] = $occupation_id;
        }

        return new self($occupation_ids);
    }

    public function __construct(array $occupation_ids)
    {
        $this->occupation_ids  = $occupation_ids;
    }

    public function get_occupations()
    {
        return $this->occupation_ids;
    }

    public function __toArray()
    {
        $data = array();
        foreach ($this->occupation_ids as $occupation_id) {
            $data[] = $occupation_id->__toString();
        }

        return $data;
    }
}
