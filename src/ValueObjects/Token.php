<?php

namespace AcademyHQ\API\ValueObjects;

class Token extends StringVO {

	public function __toEncodedString() {

		return base64_encode($this->toNative());
	}
}