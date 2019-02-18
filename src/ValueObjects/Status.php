<?php

namespace AcademyHQ\API\ValueObjects;

class Status
{

    private $status;
    public function __construct(object $status)
    {
        $this->status = $status;
    }

    public function __toObject()
    {

        $status             = new self($this->status);
        $status->is_active  = $this->status->is_active;
        $status->is_deleted  = $this->status->is_deleted;
        return $status;
    }
}
