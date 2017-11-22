<?php

namespace AcademyHQ\API\Repository;

use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\WebClient\AuthRepository;
use AcademyHQ\API\Repository\WebClient\LearnerRepository;
use AcademyHQ\API\Repository\WebClient\OrganisationAdminRepository;
use AcademyHQ\API\Repository\WebClient\SuperOrganisationAdminRepository;
use AcademyHQ\API\Repository\WebClient\ETBAdminRepository;
use AcademyHQ\API\Repository\WebClient\ETBAORepository;
use AcademyHQ\API\Repository\WebClient\EmployerRepository;
use AcademyHQ\API\Repository\WebClient\AssessorRepository;
use AcademyHQ\API\Repository\WebClient\NotificationRepository;

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

	public function get_auth_repository()
	{
		return new AuthRepository($this->credentials);
	}

	public function get_assessor_repository() {

		return new AssessorRepository($this->credentials);
	}

	public function get_learner_repository() {

		return new LearnerRepository($this->credentials);
	}

	public function get_etbadmin_repository() {

		return new ETBAdminRepository($this->credentials);
	}

	public function get_etbao_repository() {

		return new ETBAORepository($this->credentials);
	}

	public function get_organisation_admin_repository() {

		return new OrganisationAdminRepository($this->credentials);
	}

	public function get_super_organisation_admin_repository() {

		return new SuperOrganisationAdminRepository($this->credentials);
	}

	public function get_employer_repository() {

		return new EmployerRepository($this->credentials);
	}

	public function get_notification_repository() {

		//return "hello";

		return new NotificationRepository($this->credentials);
	}
}