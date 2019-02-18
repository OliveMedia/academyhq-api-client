<?php

namespace AcademyHQ\API\ValueObjects;

class User
{

    private $user;
    public function __construct(object $user)
    {
        $this->user = $user;
    }

    public function __toObject()
    {

        $user             = new self($this->user);
        $user->first_name = $this->user->first_name;
        $user->last_name  = $this->user->last_name;
        $user->email      = $this->user->email;
        return $user;
    }
}
