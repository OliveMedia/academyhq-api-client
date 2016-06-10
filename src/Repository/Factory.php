<?php

namespace AcademyHQ\API\Repository;

use AcademyHQ\API\Common\Credentials;

class Factory
{

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function get_member_repository()
	{
		return new MemberRepository($this->credentials);
	}

	public function get_enrolment_repository()
	{
		return new EnrolmentRepository($this->credentials);
	}

	public function get_license_repository()
	{
		return new LicenseRepository($this->credentials);
	}

	public function get_course_repository()
	{
		return new CourseRepository($this->credentials);
	}

	public function get_purchase_repository()
	{
		return new PurchaseRepository($this->credentials);
	}
}