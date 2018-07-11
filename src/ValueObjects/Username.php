<?php

namespace AcademyHQ\API\ValueObjects;

class Username extends StringVO {

	public function __toEncodedString() {

		return base64_encode($this->toNative());
	}
}