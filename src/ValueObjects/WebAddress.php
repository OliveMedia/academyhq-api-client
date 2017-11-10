<?php

namespace AcademyHQ\API\ValueObjects;

use AcademyHQ\API\ValueObjects\StringVO;
use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class WebAddress extends StringVO
{
    /**
     * Returns an WebAddress object given a PHP native string as parameter.
     *
     * @param string $value
     */
    public function __construct($value)
    {
        $filteredValue = filter_var($value, FILTER_VALIDATE_URL);

        if ($filteredValue === false) {
            throw new InvalidValueObjectsArgumentException($value, 'WebAddress');
        }

        $this->value = $filteredValue;
    }
}
