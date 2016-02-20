<?php

namespace AcademyHQ\API\ValueObjects;

use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class Flag {

	private $flag;

	public function __construct($flag) {

		if($flag === true || $flag === 1) {
			$this->flag = 1;
		} elseif($flag === false || $flag === 0) {
			$this->flag = 0;
		} else {

			throw new InvalidValueObjectsArgumentException($flag, 'Boolean');
		}
	}

	public function __toBool() {

		if($this->flag) {

			return 1;
		} else {

			return 0;
		}
	}
}