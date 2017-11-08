<?php

namespace AcademyHQ\API\ValueObjects;

class Password extends StringVO {

	public function __toEncodedString() {

		return base64_encode($this->toNative());
	}
}