<?php

namespace AcademyHQ\API\ValueObjects;

use AcademyHQ\API\ValueObjects\StringVO;
use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class Email extends StringVO
{
    /**
     * Returns an EmailAddress object given a PHP native string as parameter.
     *
     * @param string $value
     */
    public function __construct($value)
    {
        $filteredValue = filter_var($value, FILTER_VALIDATE_EMAIL);

        if ($filteredValue === false) {
            throw new InvalidValueObjectsArgumentException($value, 'EmailAddress');
        }

        $this->value = $filteredValue;
    }

    public function __toEncodedString() {

        return base64_encode($this->toNative());
    }
}
