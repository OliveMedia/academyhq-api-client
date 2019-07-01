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
use AcademyHQ\API\Repository\WebClient\MemberProgramRepository;
use AcademyHQ\API\Repository\WebClient\GDPRRepository;
use AcademyHQ\API\Repository\ConnectedRMS\CrmsRepository;
use AcademyHQ\API\Repository\ConnectedRMS\CourseApiRepository;
use AcademyHQ\API\Repository\ConnectedRMS\MemberApiRepository;
use AcademyHQ\API\Repository\OSA\ClassroomRepository;
use AcademyHQ\API\Repository\Adecco\CourseApiRepository as AdeccoCourseApiRepository;
use AcademyHQ\API\Repository\Adecco\AdeccoOrganisationApiRepository;
use AcademyHQ\API\Repository\Adecco\AdeccoAuthApiRepository;
use AcademyHQ\API\Repository\Adecco\AdeccoMemberApiRepository;
use AcademyHQ\API\Repository\Adecco\AdeccoAdminApiRepository;

// use AcademyHQ\API\Repository\OMA as OMA;

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

		return new NotificationRepository($this->credentials);
	}

	public function get_member_program_repository() {

		return new MemberProgramRepository($this->credentials);
	}

	public function get_gdpr_repository() {

		return new GDPRRepository($this->credentials);
	}

	public function get_crms_repository() {

		return new CrmsRepository($this->credentials);
	}

	public function get_course_api_repository() {

		return new CourseApiRepository($this->credentials);
	}

	public function get_member_api_repository() {

		return new MemberApiRepository($this->credentials);
	}


	//implemented only for oma repositorirs ( meaning only classes extending the Base )
	public function get_oma_repository($repo_name){
		$className = '\AcademyHQ\API\Repository\OMA\\';
		$className .= ucfirst($repo_name).'Repository';
		return new $className($this->credentials);
	}

	public function get_classroom_repository() {
		return new ClassroomRepository($this->credentials);
	}

	public function get_adecco_package_repository()
    {
        return new AdeccoCourseApiRepository($this->credentials);
	}

	public function get_adecco_organisation_repository()
    {
        return new AdeccoOrganisationApiRepository($this->credentials);
	}
	
	public function get_adeccoauthapi_repository()
	{
		return new AdeccoAuthApiRepository($this->credentials);
	}

	public function get_adecco_member_repository()
	{
		return new AdeccoMemberApiRepository($this->credentials);
	}

	public function get_adecco_admin_repository()
	{
		return new AdeccoAdminApiRepository($this->credentials);
	}
}