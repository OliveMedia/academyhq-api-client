<?php

namespace AcademyHQ\API\ValueObjects\HTTP;

use Zend\Validator\Hostname;
use AcademyHQ\API\ValueObjects\String;
use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;


class Host extends String
{
    /**
     * Returns a Hostname
     *
     * @param string $value
     */
    public function __construct($value)
    {
        $validator = new Hostname(array('allow' => Hostname::ALLOW_DNS | Hostname::ALLOW_LOCAL));

        if (false === $validator->isValid($value)) {
            throw new InvalidValueObjectsArgumentException($value, 'Hostname');
        }

        parent::__construct($value);
    }
}
