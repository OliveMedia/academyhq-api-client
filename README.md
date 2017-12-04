# academyhq-api-client
Client Library that allow third party to access AcademyHQ APIs.

## Installation (Using Composer)
<pre>
 	include the following line in your composer.json file and do composer update

 	"olivemedia/academyhq-api-client": "dev-master"
</pre>

## NOTE: ALL VALUE OBJECTS ARE SHIPPED WITH THIS PACKAGE

## Getting Repository
<pre>
  	$credentials = new \AcademyHQ\API\Common\Credentials(
		new \AcademyHQ\API\ValueObjects\AppID('Your App ID'),
		new \AcademyHQ\API\ValueObjects\SecretKey('Your Secret Key')
	);

	$factory = new \AcademyHQ\API\Repository\Factory($credentials);
	
	/*@return instance of \AcademyHQ\API\Repository\MemberRepository */
	$member_repository = $factory->get_member_repository(); 
	[Instance of \AcademyHQ\API\Repository\MemberRepository is required to perform any action related to member]
	

	/*@return instance of \AcademyHQ\API\Repository\EnrolmentRepository */
	$enrolment_repository = $factory->get_enrolment_repository(); 
	[Instance of \AcademyHQ\API\Repository\EnrolmentRepository is required to perform any action related to enrolment]
	

	/*@return instance of \AcademyHQ\API\Repository\LicenseRepository */
	$license_repository = $factory->get_license_repository(); 
	[Instance of \AcademyHQ\API\Repository\LicenseRepository is required to perform any action related to license]	
	

	/*@return instance of \AcademyHQ\API\Repository\CourseRepository */
	$course_repository = $factory->get_course_repository(); 
	[Instance of \AcademyHQ\API\Repository\CourseRepository is required to perform any action related to course]

	*@return instance of \AcademyHQ\API\Repository\PurchaseRepository */
	$purchase_repository = $factory->get_purchase_repository(); 
	[Instance of \AcademyHQ\API\Repository\PurchaseRepository is required to perform any action related to purchase]	
</pre>

## Using Member Repository

### 1> Creating Member 
<pre>
 	/*@return member_id */
	$member_id = $member_repository->create(
		\AcademyHQ\API\ValueObjects\Name::fromNative("First Name", "Last Name"),
		new \AcademyHQ\API\ValueObjects\Username("User Name"),
		new \AcademyHQ\API\ValueObjects\Email("email@email.com"),
		new \AcademyHQ\API\ValueObjects\Password("password")
	);
</pre>

	Alternatively you can provide ID as an extra parameter while creating member. Example shown below:
<pre>
	/*@return member_id */
	$member_id = $member_repository->create(
		\AcademyHQ\API\ValueObjects\Name::fromNative("First Name", "Last Name"),
		new \AcademyHQ\API\ValueObjects\Username("User Name"),
		new \AcademyHQ\API\ValueObjects\Email("email@email.com"),
		new \AcademyHQ\API\ValueObjects\Password("password"),
		new \AcademyHQ\API\ValueObjects\ID('CUST-JOHN-SMITH')
	);
</pre>

### 2> Getting Member
<pre>
  	/*@return member std object */
  	/* member std object will contain id, first_name, last_name, username, email of member*/
  	$member = $member_repository->get(new \AcademyHQ\API\ValueObjects\MemberID('your member id'));
</pre>

### 3> Deleting member
<pre>
  	/*@return success message */
  	$response = $member_repository->delete(new \AcademyHQ\API\ValueObjects\MemberID('your member id'));
</pre>

### 4> Updating Member
<pre>
	/*@return success message */
	$response = $member_repository->save(
		new \AcademyHQ\API\ValueObjects\MemberID($member_id),
		\AcademyHQ\API\ValueObjects\Name::fromNative('Updated Fname', 'Updated Lname'),
		new \AcademyHQ\API\ValueObjects\Username('updated username'),
		new \AcademyHQ\API\ValueObjects\Email('updated password')
	);
</pre>

### 5> Changing Password
<pre>
	/*@return success message */
	$response = $member_repository->create_bulk_members_array(
		new \AcademyHQ\API\ValueObjects\MemberID($member_id),
		new \AcademyHQ\API\ValueObjects\Password('updated password')
	);
</pre>

### 6> Creating one or more  members from array object
<pre>
	/*@return members_ids */
	$response = $member_repository->create_bulk_members_array(
		\AcademyHQ\API\ValueObjects\FirstNameArray::fromNative(array('first_name_1', 'first_name_2')),
		\AcademyHQ\API\ValueObjects\LastNameArray::fromNative(array('last_name_1', 'last_name_2')),
		\AcademyHQ\API\ValueObjects\UsernameArray::fromNative(array('username_1', 'username_2')),
		\AcademyHQ\API\ValueObjects\EmailArray::fromNative(array('email_1', 'email_2')),
		\AcademyHQ\API\ValueObjects\PasswordArray::fromNative(array('password_1', 'password_2'))
	);
</pre>

### 7> Creating one or more members from JSON object
<pre>
	/*@return members_ids */
	$response = $member_repository->create_bulk_members_json(
		\AcademyHQ\API\ValueObjects\FirstNameArray::fromNative(array('first_name_1', 'first_name_2')),
		\AcademyHQ\API\ValueObjects\LastNameArray::fromNative(array('last_name_1', 'last_name_2')),
		\AcademyHQ\API\ValueObjects\UsernameArray::fromNative(array('username_1', 'username_2')),
		\AcademyHQ\API\ValueObjects\EmailArray::fromNative(array('email_1', 'email_2')),
		\AcademyHQ\API\ValueObjects\PasswordArray::fromNative(array('password_1', 'password_2'))
	);
</pre>

## Using Enrolment Repository

### 1> Creating Enrolment
<pre>
	/*@return enrolment_id */
	$enrolment_id = $enrolment_repository->create(
		new \AcademyHQ\API\ValueObjects\MemberID('member_id'),
		new \AcademyHQ\API\ValueObjects\LicenseID('license_id')
	);
</pre>

### 2> Creating one or more enrolments
<pre>
	/*@return array of enrolment_ids */
	$enrolment_ids = $enrolment_repository->create_enrolments(
		new \AcademyHQ\API\ValueObjects\MemberID('member_id'),
		\AcademyHQ\API\ValueObjects\LicenseIDArray::fromNative(array('license_id_1', 'license_id_2')),
		new \AcademyHQ\API\ValueObjects\SendEmail(true/false)
	);

</pre>

### 3> Creating enrolments for all available licenses in organisation
<pre>
	/*@return enrolment_ids / array of enrolment id */
	$enrolment_ids = $enrolment_repository->create_for_organisation(
		new \AcademyHQ\API\ValueObjects\MemberID('member_id')
	);
</pre>

### 4> Getting Enrolment
<pre>
	/*@return Enrolment std object that contain the status of enrolment, registration and course name*/
	$enrolment = $enrolment_repository->get(new \AcademyHQ\API\ValueObjects\EnrolmentID('enrolment_id'));
</pre>

### 5> Deleting Enrolment
<pre>
	/*@return Success message*/
	$enrolment = $enrolment_repository->delete(new \AcademyHQ\API\ValueObjects\EnrolmentID('enrolment_id'));
</pre>

### 6> Getting Launch URl 
<pre>
	/*@Start or resume the enrolment and return the launch url*/
	/*@Require Callback Url: Upon exit, the url in your application that the SCORM player will redirect to */
	/*@ See Note Below regarding callback url*/ 
	$launch_url = $enrolment_repository->get_launch_url(new \AcademyHQ\API\ValueObjects\EnrolmentID('enrolment_id'), \AcademyHQ\API\ValueObjects\HTTP\Url::fromNative('callback_url'));

	/* The launch_url can launched in new window or iframe */
	<!-- <iframe src="{{{$launch_url}}}"></iframe> -->
</pre>

### 7> Getting certificate
<pre>
	/*@ returns Certificate std object that has id, course, member, certificate, enrolment_succeeded_at and expire_at*/ 
	$certificate = $enrolment->get_certificate(new \AcademyHQ\API\ValueObjects\MemberCertificateID('member_certificate_id'));
</pre>

### 8> Getting certificate url
<pre>
	/*@ returns url of certificate*/ 
	$certificate = $enrolment->get_certificate_url(new \AcademyHQ\API\ValueObjects\MemberCertificateID('member_certificate_id'));
</pre>

### Information needed for callback url 
<pre>
	/*Below code in callback url will sync registration summary and provide you the recent enrolment status */
	/*@Return enrolment std object that contain enrolment status */
	$enrolment = $enrolment_repository->sync_result(new \AcademyHQ\API\ValueObjects\EnrolmentID('enrolment_id'));
</pre>

### 9> Creating Offline Enrolment
<pre>
	/*@return enrolment_id */
	$enrolment_id = $enrolment_repository->create_offline_enrolment(
		new \AcademyHQ\API\ValueObjects\MemberID('member_id'),
		new \AcademyHQ\API\ValueObjects\CourseID('course_id'),
		new \AcademyHQ\API\ValueObjects\StringVO('file_name'),
		new \AcademyHQ\API\ValueObjects\Integer(hrs),
		new \AcademyHQ\API\ValueObjects\Integer(min),
		new \AcademyHQ\API\ValueObjects\Integer(secs),
		new \AcademyHQ\API\ValueObjects\StringVO('issued_at'),
		new \AcademyHQ\API\ValueObjects\StringVO('expire_at'),
	);
</pre>

### 10> Creating bulk enrolments through license 
<pre>
	/*@return array of enrolment_ids */
	$enrolment_ids = $enrolment_repository->create_bulK_enrolments(
		new \AcademyHQ\API\ValueObjects\MemberID('member_id'),
		\AcademyHQ\API\ValueObjects\LicenseIDArray::fromNative(array('license_id_1', 'license_id_2')),
		\AcademyHQ\API\ValueObjects\CourseIDArray::fromNative(array())
	);

</pre>

### 11> Creating bulk enrolments through course 
<pre>
	/*@return array of enrolment_ids */
	$enrolment_ids = $enrolment_repository->create_bulK_enrolments(
		new \AcademyHQ\API\ValueObjects\MemberID('member_id'),
		\AcademyHQ\API\ValueObjects\LicenseIDArray::fromNative(array()),
		\AcademyHQ\API\ValueObjects\CourseIDArray::fromNative(array('course_id_1', 'course_id_2'))
	);

</pre>


## Using License Repository

### 1> Getting Licenses
<pre>
 	/*@returns array of License std object */
 	/* License std object contains id, created_at, updated_at, course_id, name, descripton_message, completion_message, duration, typical_time, is_active and is_deleted  */
	$licenses = $license_repository->get_all();
</pre>

### 2> Creating License
<pre>
 	/*@returns id of created license */
	$login = $auth_repository->login(
		new \AcademyHQ\API\ValueObjects\ID('organisation_id'),
		new \AcademyHQ\API\ValueObjects\CourseID('course_id')))
	);
</pre>

## Using Course Repository

### 1> Getting Courses
<pre>
 	/*@returns array of Course std object */
 	/* Course std object contains id, pub_id, name, certificate_name, module_count and image_url  */
	$courses = $course_repository->get_all();
</pre>

### 2> Getting Course
<pre>
 	/*@returns Course std object that contains id, pub_id, name, certificate_name, module_count, image_url, price and enrolment_count  */
	$course = $course_repository->get(
		new \AcademyHQ\API\ValueObjects\CourseID('course_id')
	);
</pre>

### 3> Getting Course by pub ID
<pre>
 	/*@returns Course std object that contains id, pub_id, name, certificate_name, module_count, image_url, price and enrolment_count  */
	$courses = $course_repository->get_by_pub_id(
		new \AcademyHQ\API\ValueObjects\ID('id')
	);
</pre>

## Using Purchase Repository

### 1> Getting launch url
<pre>
 	/*@returns url of AcademyHQ Purchase Portal*/
	$launch_url = $purchase_repository->get_launch_url(
		new \AcademyHQ\API\ValueObjects\LicenseID('license_id'),
		new \AcademyHQ\API\ValueObjects\MemberID('member_id')),
		new \AcademyHQ\API\ValueObjects\StringVO('callback_url')
	);
</pre>

## Using Auth Repository

### 1> Login
<pre>
 	/*@returns token after sucessfull login which is valid for next two hours of genertation time*/
	$login = $auth_repository->login(
		new \AcademyHQ\API\ValueObjects\Username('username'),
		new \AcademyHQ\API\ValueObjects\Password('password')))
	);
</pre>

### 2> Login From Email
<pre>
 	/*@returns token after sucessfull login which is valid for next two hours of genertation time*/
	$login = $auth_repository->login_from_email(
		new \AcademyHQ\API\ValueObjects\Email('email_address'),
		new \AcademyHQ\API\ValueObjects\Password('password')))
	);
</pre>

### 3> Logout
<pre>
 	/*@returns message after sucesful logout*/
	$logout = $auth_repository->logout(
		new \AcademyHQ\API\ValueObjects\Token('yoour_token'))
	);
</pre>

## Using Employer Repository

### 1> Create Sub Organisation Admin
<pre>
 	/*@returns member_details of created sub organisation admin*/
	$sub_organisation_admin = $employer_repository->create_sub_organisation_admin(
		new \AcademyHQ\API\ValueObjects\ID("sub_organisation_id")
		\AcademyHQ\API\ValueObjects\Name::fromNative("First Name", "Last Name"),
		new \AcademyHQ\API\ValueObjects\Username("User Name"),
		new \AcademyHQ\API\ValueObjects\Email("email@email.com")
	);
</pre>

### 2> Create Sub Organisation
<pre>
 	/*@returns organisation_details of created sub organisation*/
	$sub_organisation = $employer_repository->create_sub_organisation(
		new \AcademyHQ\API\ValueObjects\StringVO("Test Organisation"),
		new \AcademyHQ\API\ValueObjects\Integer(1),
		new \AcademyHQ\API\ValueObjects\WebAddress("http://example.com"),
		new \AcademyHQ\API\ValueObjects\Email("email@email.com"),
		new \AcademyHQ\API\ValueObjects\Address("address"),
		new \AcademyHQ\API\ValueObjects\FaxNumber("+123456"),
		new \AcademyHQ\API\ValueObjects\TaxNumber("your_tax_number"),
		new \AcademyHQ\API\ValueObjects\CroNumber("your_cro_number"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_latitude"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_longitude"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_trade_name"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_date_of_commence")
	);
</pre>

### 3> Create Sub Organisation Inherit Domain
<pre>
 	/*@returns organisation_details of created sub organisation*/
	$sub_organisation = $employer_repository->create_sub_organisation_inherit_domain(
		new \AcademyHQ\API\ValueObjects\PublicID('ABC123'),
		new \AcademyHQ\API\ValueObjects\Integer(1),
		new \AcademyHQ\API\ValueObjects\StringVO("Test Organisation")
	);
</pre>

### 4> Create Sub Organisation Apprenticeship
<pre>
 	/*@returns organisation_details of created sub organisation*/
	$sub_organisation = $employer_repository->create_apprenticeship_organisation(
		new \AcademyHQ\API\ValueObjects\StringVO('your_organisation_name'),
		new \AcademyHQ\API\ValueObjects\TaxNumber('your_tax_number'),
		\AcademyHQ\API\ValueObjects\Name::fromNative("First Name", "Last Name"),
		new \AcademyHQ\API\ValueObjects\Email('your_email'),
		new \AcademyHQ\API\ValueObjects\StringVO("your_trade_name"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_date_of_commence")
	);
</pre>

### 5> Complete Registration Fro Apprenticeship
<pre>
 	/*@returns member_details of updated organisation admin*/
	$registration = $employer_repository->registration_completion_for_admin(
		new \AcademyHQ\API\ValueObjects\MemberID('your_member_id'),
		\AcademyHQ\API\ValueObjects\Name::fromNative("First Name", "Last Name"),
		new \AcademyHQ\API\ValueObjects\Password('your_password'),
		new \AcademyHQ\API\ValueObjects\Password("your_password_confirmation"),
	);
</pre>

### 6> Get Base Member
<pre>
 	/*@returns base_member_details*/
	$base_member_details = $employer_repository->base_member(
		new \AcademyHQ\API\ValueObjects\MemberID('your_member_id')
	);
</pre>

## Using Super Organisation Admin Repository

### 1> Create Education Training Board
<pre>
	/*@returns etb_details of created education training board and token is generated using auth repository */
	$etb = $super_organisation_admin_repository->create_etb(
		new \AcademyHQ\API\ValueObjects\Token("token"),
		new \AcademyHQ\API\ValueObjects\Address("address"),
		new \AcademyHQ\API\ValueObjects\Latitude("12.0123"),
		new \AcademyHQ\API\ValueObjects\Longitude("18.0123"),
		new \AcademyHQ\API\ValueObjects\ID("A123"),
		new \AcademyHQ\API\ValueObjects\StringVO("ETB Name"),
		new \AcademyHQ\API\ValueObjects\StringVO("contact_person_name"),
		new \AcademyHQ\API\ValueObjects\PhoneNumber("your_phone_number")		
	);
</pre>

### 2> Create Education Training Board Admin
<pre>
	/*@returns member_details of created education training board admin*/
	$etb_admin = $super_organisation_admin_repository->create_etb_admin(
		new \AcademyHQ\API\ValueObjects\Token("token"),
		\AcademyHQ\API\ValueObjects\Name::fromNative("First Name", "Last Name"),
		new \AcademyHQ\API\ValueObjects\Username("User Name"),
		new \AcademyHQ\API\ValueObjects\Email("email@email.com")
	);
</pre>

### 3> Create Education Training Board Authorising Officer
<pre>
	/*@returns member_details of created education training board authorising officer*/
	$etb_ao = $super_organisation_admin_repository->create_etb_authorizing_officer(
		new \AcademyHQ\API\ValueObjects\Token("token"),
		\AcademyHQ\API\ValueObjects\Name::fromNative("First Name", "Last Name"),
		new \AcademyHQ\API\ValueObjects\Username("User Name"),
		new \AcademyHQ\API\ValueObjects\Email("email@email.com")
	);
</pre>

### 4> Get ETB Admins
<pre>
	*@return etb_admin_details std object */
  	$etb_admin_details = $super_organisation_admin_repository->get_etb_admins(new \AcademyHQ\API\ValueObjects\Token('your token'), new \AcademyHQ\API\ValueObjects\EtbID('your_etb_id'));
</pre>

### 5> Get ETB Authorising Officer
<pre>
	*@return etb_authorizing_officer_details std object */
  	$etb_authorizing_officer_details = $get_etb_authorizing_officer->get_etb_admins(new \AcademyHQ\API\ValueObjects\Token('your token'), new \AcademyHQ\API\ValueObjects\EtbID('your_etb_id'));
</pre>

## Using Notification Repository

### 1> Get Member Web Notifications
<pre>
	/*@return notifications std object */
  	/* notification std object will contain id, crerated_at, updated_at, member_id, sender_id, notification_message, server_response, sent_at, next_send_at, is_set, is_opened, opened_at of notification*/
  	$notification = $notification_repository->member_web_notifications(new \AcademyHQ\API\ValueObjects\Token('your token'), new \AcademyHQ\API\ValueObjects\MemberID('your member id'));
</pre>

### 2> Get Sender Web Notifications
<pre>
	/*@return notifications std object */
  	/* notification std object will contain id, crerated_at, updated_at, member_id, sender_id, notification_message, server_response, sent_at, next_send_at, is_set, is_opened, opened_at of notification*/
  	$notification = $notification_repository->sender_web_notifications(new \AcademyHQ\API\ValueObjects\Token('your token'), new \AcademyHQ\API\ValueObjects\MemberID('your sender id'));
</pre>

### 3> Get Web Notifications With Attachment(If any)
<pre>
	/*@return notifications std object */
  	/* notification std object will contain id, crerated_at, updated_at, member_id, sender_id, notification_message, server_response, sent_at, next_send_at, is_set, is_opened, opened_at, attachemnt_document_key, attachament_document_url of notification*/
  	$notification = $notification_repository->web_notification(new \AcademyHQ\API\ValueObjects\Token('your token'), new \AcademyHQ\API\ValueObjects\NotificationID('your notification id'));
</pre>

### 4> Get Logged in Member Web Notifications
<pre>
	/*@return notifications std object */
  	/* notification std object will contain id, crerated_at, updated_at, member_id, sender_id, notification_message, server_response, sent_at, next_send_at, is_set, is_opened, opened_at of notification*/
  	$notifications = $notification_repository->member_notifications(new \AcademyHQ\API\ValueObjects\Token('your token'));
</pre>

### 5> Notifications Create
<pre>
	/*@returns sucess message*/
	$notfication = $notification_repository->create_notification(
		new \AcademyHQ\API\ValueObjects\Token("token"),
		\AcademyHQ\API\ValueObjects\MemberIDArray::fromNative(array('member_id_1', 'member_id_2')),
		new \AcademyHQ\API\ValueObjects\StringVO("your_notification_message"),
		\AcademyHQ\API\ValueObjects\NotificationTypeArray::fromNative(array('type_1', 'type_2')),
		\AcademyHQ\API\ValueObjects\AttachmentIDArray::fromNative(array('attachment_id_1', 'attachment_id_2'))
	);
</pre>

## Using Member Program Repository

### 1> Fetch All Member Program
<pre>
	/*@return member_programs std object */
  	$member_program = $member_program_repository->fetch_all_member_program(new \AcademyHQ\API\ValueObjects\Token('your token'), new \AcademyHQ\API\ValueObjects\MemberID('your member id'));
</pre>

### 2> Fetch All Member Program Detail
<pre>
	/*@return member_program_detail std object */
  	$member_program_detail = $member_program_repository->member_program_detail(new \AcademyHQ\API\ValueObjects\Token('your token'), new \AcademyHQ\API\ValueObjects\MemberProgramID('your member id'));
</pre>

## Using Organisation Admin Repository

### 1> Organisation Edit
<pre>
	/*@returns organisation_details of editied sub organisation*/
	$organisation = $organisation_admin_repository->edit_organisation(
		new \AcademyHQ\API\ValueObjects\Token("token"),
		new \AcademyHQ\API\ValueObjects\Integer(1),
		new \AcademyHQ\API\ValueObjects\StringVO("Test Organisation"),
		new \AcademyHQ\API\ValueObjects\WebAddress("http://example.com"),
		new \AcademyHQ\API\ValueObjects\Email("email@email.com"),
		new \AcademyHQ\API\ValueObjects\Address("address"),
		new \AcademyHQ\API\ValueObjects\FaxNumber("+123456"),
		new \AcademyHQ\API\ValueObjects\TaxNumber("your_tax_number"),
		new \AcademyHQ\API\ValueObjects\CroNumber("your_cro_number"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_latitude"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_longitude"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_trade_name"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_date_of_commence")
	);
</pre>

### 2> Create Base Member
<pre>
	/*@returns member_details of created member*/
	$member_base = $organisation_admin_repository->create_base_member(
		new \AcademyHQ\API\ValueObjects\Token("token"),
		new \AcademyHQ\API\ValueObjects\Integer("your_organisation_id"),
		\AcademyHQ\API\ValueObjects\Name::fromNative("first_name", "last_name"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_role"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_qualification"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_occupation"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_comment"),
		new \AcademyHQ\API\ValueObjects\Email("your_email"),
		new \AcademyHQ\API\ValueObjects\PublicID("your_pub_id"),
		new \AcademyHQ\API\ValueObjects\Integer("is_member"),
		new \AcademyHQ\API\ValueObjects\Integer("is_contact_person"),
		new \AcademyHQ\API\ValueObjects\Integer("is_verifier"),
		new \AcademyHQ\API\ValueObjects\Integer("1")
	);
</pre>

### 3> Create Candidate
<pre>
	/*@returns member_details of created member*/
	$member_base = $organisation_admin_repository->create_candidate(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\Integer("your_organisation_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_coccupation_id"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_pub_id"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_date_of_birth"),
		\AcademyHQ\API\ValueObjects\Name::fromNative("first_name", "last_name"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_gender"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_country_code"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_mobile_number"),
		new \AcademyHQ\API\ValueObjects\Email("your_email"),
		new \AcademyHQ\API\ValueObjects\Integer("your_disability"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_disability_text"),
		new \AcademyHQ\API\ValueObjects\Integer("your_advice"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_advice_text"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_street"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_city"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_state"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_country"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_postal_code"),
		new \AcademyHQ\API\ValueObjects\Integer("your_eye_test_document_id"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_eye_test_data_image"),
		new \AcademyHQ\API\ValueObjects\Integer("your_mimimum_educational_document_id"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_minimum_educational_data_image"),
		new \AcademyHQ\API\ValueObjects\Integer("your_signature_id"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_signature_data_image")
	);
</pre>

### 4> Fetch All Unregistered Member
<pre>
	*@return unregistered member_details a/c to organisation  std object */
  	$un_registered_member = $organisation_admin_repository->fetch_un_registered_member(new \AcademyHQ\API\ValueObjects\Token('your token'), new \AcademyHQ\API\ValueObjects\OrganisationID('your_organisation_id'));
</pre>

### 5> Create Etb Organisation
<pre>
	/*@return etb_organisagtion details of created etb organisation*/
	$etb_organisation = $organisation_admin_repository->create_organisation_etb(
		new \AcademyHQ\API\ValueObjects\Token("your_tokn"),
		new \AcademyHQ\API\ValueObjects\Integer("your_organisation_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_etb_id")
	);
</pre>

### 6> Get Organisation Etb
<pre>
	*@return etb_organisations details of std object */
  	$etb_organisation = $organisation_admin_repository->get_organisation_etb(new \AcademyHQ\API\ValueObjects\Token('your token'), new \AcademyHQ\API\ValueObjects\OrganisationID('your_organisation_id'));
</pre>

### 7> Get Organisation
<pre>
	*@return organisations details of std object */
  	$$organisation = $organisation_admin_repository->get_organisation(new \AcademyHQ\API\ValueObjects\Token('your token'), new \AcademyHQ\API\ValueObjects\OrganisationID('your_organisation_id'));
</pre>

### 8> List Apprenticeships
<pre>
	/*@return apprenticeships_list std object*/
	$etb_organisation = $organisation_admin_repository->list_apprenticeships(
		new \AcademyHQ\API\ValueObjects\Token("your_tokn"),
		new \AcademyHQ\API\ValueObjects\Integer("current_page"),
		new \AcademyHQ\API\ValueObjects\Integer("your_occupation"),
		new \AcademyHQ\API\ValueObjects\Integer("your_industry"),
		new \AcademyHQ\API\ValueObjects\Integer("your_sector"),
		new \AcademyHQ\API\ValueObjects\Integer("your_main_activity"),
		new \AcademyHQ\API\ValueObjects\Integer("your_number_of_qualified_person_in_occupation"),
		new \AcademyHQ\API\ValueObjects\Integer("your_contact_person"),
		new \AcademyHQ\API\ValueObjects\Integer("your_verifier"),
		new \AcademyHQ\API\ValueObjects\Integer("your_mentor"),
		new \AcademyHQ\API\ValueObjects\Integer("your_is_submitted"),
		new \AcademyHQ\API\ValueObjects\Integer("your_is_approved"),
		new \AcademyHQ\API\ValueObjects\Integer("your_is_declined"),
		new \AcademyHQ\API\ValueObjects\Integer("your_is_site_visited"),
		new \AcademyHQ\API\ValueObjects\Integer("your_is_confirmed_as_occupation"),
		new \AcademyHQ\API\ValueObjects\StringVo("your_order_by_field"),
		new \AcademyHQ\API\ValueObjects\Integer("your_order_by_direction"),
	);
</pre>

## Using Learner Repository

### 1> Fetch All Documents
<pre>
	/*@return member_documents_details std object */
  	/* member_document_details std object will contain id, created_at, updated_at, is_deleted, is_active, is_expired, expires_at, document_key, document_id, document of member_documents_details*/
  	$member_document_detials = $learner_repository->member_documents(new \AcademyHQ\API\ValueObjects\Token('your token'));
</pre>

### 2> Fetch Member Enrolment Certificate
<pre>
	/*@return member_enrolment_certificate std object */
  	$member_enrolment_certificate = $learner_repository->member_enrolment_certificate(new \AcademyHQ\API\ValueObjects\Token('your token'), new \AcademyHQ\API\ValueObjects\EnrolmentID('your_enrolment_id'));
</pre>

### 3> Fetch All Certicates
<pre>
	/*@return certificates std object */
  	/* certificate std object will contain id, course, member, certificate, enrolment_succeeded_at, expire_at of certificates*/
  	$certificates = $learner_repository->certificates(new \AcademyHQ\API\ValueObjects\Token('your token'));
</pre>


### 4> Edit Profile
<pre>
	/*@return member_id of editied profile*/
	$profile = $learner_repository->profile_update(
		new \AcademyHQ\API\ValueObjects\PublicID("your_pub_id"),
		new \AcademyHQ\API\ValueObjects\PublicID("your_pub_id"),
		\AcademyHQ\API\ValueObjects\Name::fromNative("first_name", "last_name"),
		new \AcademyHQ\API\ValueObjects\Email("your_email"),
		new \AcademyHQ\API\ValueObjects\PhoneNumber("your_mobile_number"),
		new \AcademyHQ\API\ValueObjects\StringVO("yy-mm-dd"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_gender"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_country"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_state"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_city"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_street"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_postal_code")
	);
</pre>

### 5> View Profile
<pre>
	/*@return member_profile_details std object */
  	/* member_profile_details std object will contain id, pub_id, first_name, last_name, email, mobile_number, date_of_birth, gender, address of member_profile_details*/
  	$member_profile_details = $learner_repository->get_profile(new \AcademyHQ\API\ValueObjects\Token('your token'));
</pre>

### 6> Fetch All Menmber Documents
<pre>
	/*@return member_documents_details std object */
  	/* member_document_details std object of member_documents_details*/
  	$member_document_detials = $learner_repository->member_document_details(new \AcademyHQ\API\ValueObjects\Token('your token'), new \AcademyHQ\API\ValueObjects\MemberDocuementID('your_member_document_id'));
</pre>

### 7> Fetch All Documents
<pre>
	/*@return documents_details std object */
  	/* document_details std object of documents_details*/
  	$document_detials = $learner_repository->documents_list(new \AcademyHQ\API\ValueObjects\Token('your token'));
</pre>

### 8> Fetch All Required Documents
<pre>
	/*@return documents_details std object */
  	/* document_details std object of documents_details*/
  	$document_detials = $learner_repository->required_document_list(new \AcademyHQ\API\ValueObjects\Token('your token'));
</pre>
