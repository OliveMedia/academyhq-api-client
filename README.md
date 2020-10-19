# **academyhq-api-client**
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

### 11> Package Enrollments 
<pre>
	/*@return array of success message */
	$success_message = $enrolment_repository->create_package_enrolment(
		new \AcademyHQ\API\ValueObjects\MemberID('member_id'),
		new \AcademyHQ\API\ValueObjects\ID('package_id')
		new \AcademyHQ\API\ValueObjects\Integer('license_deduct')
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
	$login = $license_repository->login(
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

### 4> Login From Email only
<pre>
 	/*@returns token after sucessfull login which is valid for next two hours of genertation time*/
	$login = $auth_repository->login_from_email_only(
		new \AcademyHQ\API\ValueObjects\Email('email'),
		new \AcademyHQ\API\ValueObjects\Token('redisUserToken'))),
		new \AcademyHQ\API\ValueObjects\StringVO('callback')))
	);
</pre>

### 5> Get Direct Login Url
<pre>
 	/*@returns direct login url*/
	$login_url = $auth_repository->get_login_url_to_ahq(
		new \AcademyHQ\API\ValueObjects\Email('email'),
		new \AcademyHQ\API\ValueObjects\Token('redisUserToken'))),
		new \AcademyHQ\API\ValueObjects\MemberID('member_id'))),
		new \AcademyHQ\API\ValueObjects\Token('ahq_token'))),
		new \AcademyHQ\API\ValueObjects\StringVO('callback')))
	);
</pre>

### 6> Login From Member_id only
<pre>
 	/*@returns token after sucessfull login which is valid for next two hours of genertation time*/
	$login = $auth_repository->login_from_member_id_only(
		new \AcademyHQ\API\ValueObjects\MemberID('member_id'),
		new \AcademyHQ\API\ValueObjects\Token('redisUserToken'))),
		new \AcademyHQ\API\ValueObjects\StringVO('callback')))
	);
</pre>

### 7> Login From Email For RMS
<pre>
 	/*@returns token after sucessfull login which is valid for next two hours of genertation time*/
	$login = $auth_repository->login_from_email_rms(
		new \AcademyHQ\API\ValueObjects\Email('email_address'),
		new \AcademyHQ\API\ValueObjects\Password('password')))
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

### 7> Complete Registration Fro Apprenticeship
<pre>
 	/*@returns member_details of updated candidate/
	$registration = $employer_repository->registration_completion_for_candidate(
		new \AcademyHQ\API\ValueObjects\MemberID('your_member_id'),
		\AcademyHQ\API\ValueObjects\Name::fromNative("First Name", "Last Name"),
		new \AcademyHQ\API\ValueObjects\Password('your_password'),
		new \AcademyHQ\API\ValueObjects\Password("your_password_confirmation")
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

### 5> Get ETB Authorizing Officer
<pre>
	*@return etb_authorizing_officer_details std object */
  	$etb_authorizing_officer_details = $super_organisation_admin_repository->get_etb_authorizing_officer(new \AcademyHQ\API\ValueObjects\Token('your token'), new \AcademyHQ\API\ValueObjects\EtbID('your_etb_id'));
</pre>

### 6> Get Candidates
<pre>
	*@return member_details std object */
  	$member_details = $super_organisation_admin_repository->get_etb_authorizing_officer(
  		new \AcademyHQ\API\ValueObjects\Token('your token'), 
  		new \AcademyHQ\API\ValueObjects\Integer('is_declined'),
  		new \AcademyHQ\API\ValueObjects\Integer('is_approved_by_etb_ao'),
  		new \AcademyHQ\API\ValueObjects\Integer('is_approved_by_solas_admin'),
  		new \AcademyHQ\API\ValueObjects\ID('ato_id'),
  		new \AcademyHQ\API\ValueObjects\StringVO('order_by_field'),
  		new \AcademyHQ\API\ValueObjects\StringVO('order_by_direction')
  	);
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
  	/* notification std object will contain id, created_at, updated_at, member_id, sender_id, notification_message, server_response, sent_at, next_send_at, is_set, is_opened, opened_at of notification*/
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

### 6> Notifications Create With Sender
<pre>
	/*@returns sucess message*/
	$notfication = $notification_repository->create_notification(
		new \AcademyHQ\API\ValueObjects\Token("token"),
		\AcademyHQ\API\ValueObjects\MemberIDArray::fromNative(array('member_id_1', 'member_id_2')),
		new \AcademyHQ\API\ValueObjects\StringVO("your_notification_message"),
		\AcademyHQ\API\ValueObjects\NotificationTypeArray::fromNative(array('type_1', 'type_2')),new \AcademyHQ\API\ValueObjects\MemberID('your_sender_id'),		
		\AcademyHQ\API\ValueObjects\AttachmentIDArray::fromNative(array('attachment_id_1', 'attachment_id_2'))
	);
</pre>

### 7> Update Notification
<pre>
	/*@returns sucess message*/
	$notfication = $notification_repository->update_notification(
		new \AcademyHQ\API\ValueObjects\Token("token"),
		new \AcademyHQ\API\ValueObjects\Integer("your_notification_id"),
		new \AcademyHQ\API\ValueObjects\Integer("unseen")
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

### 3> Fetch All Member Journey
<pre>
	/*@return member_journey std object */
  	$member_journey = $member_program_repository->member_journey_list(new \AcademyHQ\API\ValueObjects\Token('your token'), new \AcademyHQ\API\ValueObjects\MemberID('your_member_id'), new \AcademyHQ\API\ValueObjects\OccupationID('your_occupation_id'));
</pre>

### 4> Fetch Phase Details
<pre>
	/*@return phase_details std object */
  	$phase_details = $member_program_repository->phase_details(new \AcademyHQ\API\ValueObjects\Token('your token'), new \AcademyHQ\API\ValueObjects\MemberID('your_member_id'), new \AcademyHQ\API\ValueObjects\ID('your_member_program_id'));
</pre>

### 5> Create Program Evidence
<pre>
	/*@returns program_evidence of created program_evidence/
	$program_evidence = $member_program_repository->create_program_evidence(
		new \AcademyHQ\API\ValueObjects\Token("token"),
		new \AcademyHQ\API\ValueObjects\ProgramID('your_program_id'),
		new \AcademyHQ\API\ValueObjects\MemberID('your_member_id'),
		new \AcademyHQ\API\ValueObjects\OccupationID("your_occupation_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_program_unit_id"),
		new \AcademyHQ\API\ValueObjects\Address("address"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_latitude"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_longitude"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_evidence_image")
	);
</pre>

### 6> Fetch Program Evidence
<pre>
	/*@return program_evidence_details std object */
  	$program_evidence_details = $member_program_repository->program_evidence(new \AcademyHQ\API\ValueObjects\Token('your token'), new \AcademyHQ\API\ValueObjects\ID('your_program_evidence_id'));
</pre>

### 7> Fetch Member Journey
<pre>
	/*@return member_journey_details std object */
  	$member_journey_details = $member_program_repository->fetch_member_journey(new \AcademyHQ\API\ValueObjects\Token('your token'), new \AcademyHQ\API\ValueObjects\MemberID('your_member_id'));
</pre>


### 8> Put Member Phase Code
<pre>
	/*@return member_details std object od updated member */
  	$member_details = $member_program_repository->update_member_phase_code(
  		new \AcademyHQ\API\ValueObjects\Token('your token'), 
  		new \AcademyHQ\API\ValueObjects\Integer('your_member_id'),
  		new \AcademyHQ\API\ValueObjects\StringVO('your_member_phase_code'),
  		new \AcademyHQ\API\ValueObjects\Integer('your_apprenticeship_id')
  	);
</pre>


## Using Organisation Admin Repository

### 1> Organisation Edit
<pre>
	/*@returns organisation_details of editied sub organisation*/
	$organisation = $organisation_admin_repository->edit_organisation(
		new \AcademyHQ\API\ValueObjects\Token("token"),
		new \AcademyHQ\API\ValueObjects\Integer('your_organisation_id'),
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
		new \AcademyHQ\API\ValueObjects\StringVO("your_date_of_commence"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_organisation_logo")
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
		new \AcademyHQ\API\ValueObjects\Integer("your_apprenticeship_id"),
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
		new \AcademyHQ\API\ValueObjects\StringVO("your_signature_data_image"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_image")
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
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
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
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\Integer("your_employer_id"),
		new \AcademyHQ\API\ValueObjects\Integer("current_page"),
		new \AcademyHQ\API\ValueObjects\Integer("your_occupation_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_industry_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_sector_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_main_activity_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_number_of_qualified_person_in_occupation"),
		new \AcademyHQ\API\ValueObjects\Integer("your_contact_person_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_verifier_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_mentor_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_is_submitted"),
		new \AcademyHQ\API\ValueObjects\Integer("your_is_approved"),
		new \AcademyHQ\API\ValueObjects\Integer("your_is_declined"),
		new \AcademyHQ\API\ValueObjects\Integer("your_is_site_visited"),
		new \AcademyHQ\API\ValueObjects\Integer("is_appealed_to_solas_admin"),
		new \AcademyHQ\API\ValueObjects\Integer("is_approved_by_solas_admin"),
		new \AcademyHQ\API\ValueObjects\Integer("is_rejected_by_solas_admin"),
		new \AcademyHQ\API\ValueObjects\Integer("your_is_confirmed_as_occupation"),
		new \AcademyHQ\API\ValueObjects\StringVo("your_order_by_field"),
		new \AcademyHQ\API\ValueObjects\Integer("your_order_by_direction"),
	);
</pre>

### 9> Get Nearest ETB
<pre>
	/*@return nearest_etb std object*/
	$nearest_etb = $organisation_admin_repository->get_nearest_etb(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_latitude"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_longitude")
	);
</pre>

### 10> Get ETB Admins
<pre>
	/*@return etb_admins std object*/
	$etb_admins = $organisation_admin_repository->get_etb_admins(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\EtbID("your_etb_id")
	);
</pre>

### 11> Get ETB Authorizing Officers
<pre>
	/*@return etb_authorizing_officers std object*/
	$etb_authorizing_officers = $organisation_admin_repository->get_etb_authorizing_officer(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\EtbID("your_etb_id")
	);
</pre>

### 12> Apprenticeship Details
<pre>
	/*@return etb_authorizing_officers std object*/
	$apprenticeship_details = $organisation_admin_repository->apprenticeship_details(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\Integer("your_apprenticeship_id")
	);
</pre>

### 13> Get All Occupations
<pre>
	/*@return occuppations std object*/
	$occuppations = $organisation_admin_repository->list_occupations(
		new \AcademyHQ\API\ValueObjects\Token("your_token")
	);
</pre>

### 14> Occupation Details
<pre>
	/*@return occupation_details std object*/
	$occupation_details = $organisation_admin_repository->occupation_details(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\Integer("your_occupation_id")
	);
</pre>

### 15> Get All Industries
<pre>
	/*@return industry std object*/
	$industry = $organisation_admin_repository->list_industries(
		new \AcademyHQ\API\ValueObjects\Token("your_token")
	);
</pre>

### 16> Industry Details
<pre>
	/*@return industry_details std object*/
	$industry_details = $organisation_admin_repository->industry_details(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\Integer("your_industry_id")
	);
</pre>

### 17> Get All Sectors
<pre>
	/*@return sectors std object*/
	$sectors = $organisation_admin_repository->list_sectors(
		new \AcademyHQ\API\ValueObjects\Token("your_token")
	);
</pre>

### 18> Sector Details
<pre>
	/*@return sector_details std object*/
	$sector_details = $organisation_admin_repository->sector_details(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\Integer("your_sector_id")
	);
</pre>

### 19> Get All Main Activities
<pre>
	/*@return main_activities std object*/
	$main_activities = $organisation_admin_repository->list_main_activities(
		new \AcademyHQ\API\ValueObjects\Token("your_token")
	);
</pre>

### 20> Main Activity Details
<pre>
	/*@return main_activity_details std object*/
	$main_activity_details = $organisation_admin_repository->main_activity_details(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\Integer("your_main_activity_id")
	);
</pre>

### 21> Create Apprenticeship
<pre>
	/*@return apprenticeship_details of created apprenticeship*/
	$apprenticeship_details = $organisation_admin_repository->create_apprenticeship(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\Integer("your_employer_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_occupation_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_sector_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_main_activity_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_industry_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_number_of_qualified_person_in_occupation"),
		new \AcademyHQ\API\ValueObjects\Integer("your_expected_number_of_apprentices_within_12_months"),
		new \AcademyHQ\API\ValueObjects\Integer("your_contact_person_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_verifier_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_mentor_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_is_submitted")
	);
</pre>

### 22> Edit Apprenticeship
<pre>
	/*@return apprenticeship_details of updated apprenticeship*/
	$apprenticeship_details = $organisation_admin_repository->edit_apprenticeship(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\ApprenticeshipID("your_apprenticeship_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_occupation_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_sector_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_main_activity_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_industry_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_number_of_qualified_person_in_occupation"),
		new \AcademyHQ\API\ValueObjects\Integer("your_expected_number_of_apprentices_within_12_months"),
		new \AcademyHQ\API\ValueObjects\Integer("your_contact_person"_id),
		new \AcademyHQ\API\ValueObjects\Integer("your_verifier_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_mentor_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_is_submitted"),
		new \AcademyHQ\API\ValueObjects\Integer("your_is_approved"),
		new \AcademyHQ\API\ValueObjects\Integer("your_is_declined"),
		new \AcademyHQ\API\ValueObjects\Integer("your_is_site_visited"),
		new \AcademyHQ\API\ValueObjects\Integer("your_is_confirmed_as_occupation"),
		new \AcademyHQ\API\ValueObjects\Integer("your_is_appealed_to_solas_admin"),
		new \AcademyHQ\API\ValueObjects\Integer("your_is_approved_by_solas_admin"),
		new \AcademyHQ\API\ValueObjects\Integer("your_is_rejected_by_solas_admin"),
		new \AcademyHQ\API\ValueObjects\Integer("your_is_site_visit_booked")
	);
</pre>

### 23> Get Member IDs
<pre>
	/*@return member_ids std object*/
	$member_ids = $organisation_admin_repository->get_member_ids(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\OrganisationID("your_organisation_id")
	);
</pre>

### 24> Edit Candatidate
<pre>
	/*@returns member_details of updated candidate*/
	$member_base = $organisation_admin_repository->edit_candidate(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\Integer("your_organisation_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_apprenticeship_id"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_pub_id"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_date_of_birth"),
		\AcademyHQ\API\ValueObjects\Name::fromNative("first_name", "last_name"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_gender"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_country_code"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_mobile_number"),
		new \AcademyHQ\API\ValueObjects\Email("your_email"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_city"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_state"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_country"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_postal_code"),
		new \AcademyHQ\API\ValueObjects\Integer("your_disability"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_disability_text"),
		new \AcademyHQ\API\ValueObjects\Integer("your_advice"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_advice_text"),
		new \AcademyHQ\API\ValueObjects\Integer("your_eye_test_document_id"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_eye_test_data_image"),
		new \AcademyHQ\API\ValueObjects\Integer("your_mimimum_educational_document_id"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_minimum_educational_data_image"),
		new \AcademyHQ\API\ValueObjects\Integer("your_signature_id"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_signature_data_image"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_image")
	);
</pre>

### 26> Get Candidates
<pre>
	/*@returns member_details std object*/
	$member_base = $organisation_admin_repository->get_candidates(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\Integer("employer_id"),
		new \AcademyHQ\API\ValueObjects\Integer("is_declined"),
		new \AcademyHQ\API\ValueObjects\Integer("is_approved_by_etb_ao"),
		new \AcademyHQ\API\ValueObjects\Integer("is_approved_by_solas_admin"),
		new \AcademyHQ\API\ValueObjects\Integer("ato_id"),
		new \AcademyHQ\API\ValueObjects\StringVO("order_by_field"),
		new \AcademyHQ\API\ValueObjects\StringVO("order_by_direction")
	);
</pre>

### 27> Get Site Visit
<pre>
	/*@return site_visits std object*/
	$site_visits = $organisation_admin_repository->get_site_visits(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\OrganisationID("your_organisation_id")
	);
</pre>

### 28> Get Apprenticeship Checklist
<pre>
	/*@return apprenticeship_checklist std object*/
	$apprenticeship_checklist = $organisation_admin_repository->apprenticeship_checklist(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\ID("your_aprrenticeship_id")
	);
</pre>

### 29> Send Email To Set Password
<pre>
	/*@returns member_details std object*/
	$email = $organisation_admin_repository->send_email_to_set_password(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\Integer("your_member_id")
	);
</pre>

### 30> Get Assessors Or Verifiers
<pre>
	/*@return assessors_or_verifiers std object*/
	$assessors_or_verifiers = $organisation_admin_repository->get_assessor_or_verifier(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\OrganisationID("your_organisation_id")
	);
</pre>

### 31> Update Member
<pre>
	/*@return member_detaisl std object of updated memeber*/
	$member_detaisl = $organisation_admin_repository->update_member(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\ID("member_id"),
		new \AcademyHQ\API\ValueObjects\Integer("is_mentor"),
		new \AcademyHQ\API\ValueObjects\Integer("is_verifier"),
		new \AcademyHQ\API\ValueObjects\Integer("is_contact_person"),
		new \AcademyHQ\API\ValueObjects\StringVO("mobile_number"),
		new \AcademyHQ\API\ValueObjects\StringVO("country_code")
	);
</pre>

### 32> Get Apprenticeship Documents
<pre>
	/*@return apprenticeship_documents std object of updated memeber*/
	$apprenticeship_documents = $organisation_admin_repository->apprenticeship_documents(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\Integer("apprenticeship_id")
	);
</pre>

### 33> Get Apprentice Documents
<pre>
	/*@return apprentice_documents std object of updated memeber*/
	$apprentice_documents = $organisation_admin_repository->apprentice_documents(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\Integer("apprentice_id")
	);
</pre>

### 34> Get All Occupations, Industries, Sectors And Main Activities
<pre>
	/*@return data std object*/
	$data = $organisation_admin_repository->list_occupations_main_activities_industries_sectors(
		new \AcademyHQ\API\ValueObjects\Token("your_token")
	);
</pre>

## Using Learner Repository

### 1> Fetch All Membr Documents
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
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
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
		new \AcademyHQ\API\ValueObjects\StringVO("your_postal_code"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_image")
	);
</pre>

### 5> View Profile
<pre>
	/*@return member_profile_details std object */
  	/* member_profile_details std object will contain id, pub_id, first_name, last_name, email, mobile_number, date_of_birth, gender, address of member_profile_details*/
  	$member_profile_details = $learner_repository->get_profile(new \AcademyHQ\API\ValueObjects\Token('your token'));
</pre>

### 6> Fetch Member Document Details
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

### 9> Download Certificate
<pre>
	/*@return certifiacte_url std object */
  	/* document_details std object of documents_details*/
  	$certifiacte_url = $learner_repository->download_certificate(new \AcademyHQ\API\ValueObjects\Token('your token'), new \AcademyHQ\API\ValueObjects\MemberCertificateID('your_member_certificate_id'));
</pre>

### 10> Enrolment Launch URL
<pre>
	/*@return enrolment std object */
  	$enrolment = $learner_repository->enrolment_launch_url(new \AcademyHQ\API\ValueObjects\Token('your token'), new \AcademyHQ\API\ValueObjects\EnrolmentID('your_enrolment_id'));
</pre>

### 10> Enrolment Callback
<pre>
	/*@return enrolment std object */
  	$enrolment = $learner_repository->enrolment_callback(new \AcademyHQ\API\ValueObjects\Token('your token'), new \AcademyHQ\API\ValueObjects\EnrolmentID('your_enrolment_id'));
</pre>

### 11> Get Member
<pre>
	/*@return member_details std object */
  	$member_details = $learner_repository->get_member(new \AcademyHQ\API\ValueObjects\Token('your token'), new \AcademyHQ\API\ValueObjects\MemberID('your_member_id'));
</pre>

### 12> Get Learner Document
<pre>
	/*@return document_details std object */
  	$document_details = $learner_repository->learner_document(
  		new \AcademyHQ\API\ValueObjects\Token('your token'), 
  		new \AcademyHQ\API\ValueObjects\ID('your_member_id'),
  		new \AcademyHQ\API\ValueObjects\StringVO('your_document_name')
  	);
</pre>

## Using ETBAO Repository

### 1> Create Site Visit
<pre>
	/*@return site_visit std object */
  	$site_visit = $etbao_repository->create_site_visit(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\Integer("your_employer_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_apprenticeship_id"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_booked_at")
	);
</pre>

### 2> Edit Site Visit
<pre>
	/*@return site_visit of updated site_visit std object */
  	$site_visit = $etbao_repository->edit_site_visit(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\Integer("your_site_visit_id"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_booked_at"),
		new \AcademyHQ\API\ValueObjects\Integer("your_is_visited"),
		new \AcademyHQ\API\ValueObjects\StringVO("your_site_visited_at")
	);
</pre>

### 3> Create Apprenticeship Checklist
<pre>
	/*@return apprentice_checklist std object */
  	$apprentice_checklist = $etbao_repository->create_apprenticeship_checklist(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\StringVO("json_of_checklist_questions"),
		new \AcademyHQ\API\ValueObjects\Integer("your_apprenticeship_id")
	);
</pre>

### 4> Get Apprenticeship Checklist
<pre>
	/*@return apprenticeship_checklist std object*/
	$apprenticeship_checklist = $etbao_repository->apprenticeship_checklist(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\ID("your_aprrenticeship_id")
	);
</pre>

### 4> Get My ETB
<pre>
	*@return my_etb std object */
  	$my_etb = $etbao_repository->get_my_etb(new \AcademyHQ\API\ValueObjects\Token('your token'));
</pre>

### 5> Fetch All Apprenticeships
<pre>
	*@return apprenticeships std object */
  	$apprenticeships = $etbao_repository->fetch_all_apprenticeships(
  	new \AcademyHQ\API\ValueObjects\Token('your token'),
  	new \AcademyHQ\API\ValueObjects\Integer("employer_id"),
  	new \AcademyHQ\API\ValueObjects\Integer("has_passed"),
  	new \AcademyHQ\API\ValueObjects\Integer("is_booked"),
  	new \AcademyHQ\API\ValueObjects\StringVO("query"),
  	new \AcademyHQ\API\ValueObjects\Integer("set_per_page"),
  	new \AcademyHQ\API\ValueObjects\Integer("page"),
  	new \AcademyHQ\API\ValueObjects\StringVO("order_by_field"),
  	new \AcademyHQ\API\ValueObjects\StringVO("order_by_direction")
  	);
</pre>

### 6> Get Candidates
<pre>
	/*@returns member_details std object*/
	$member_details = $etbao_repository->get_candidates(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\Integer("employer_id"),
		new \AcademyHQ\API\ValueObjects\Integer("is_declined"),
		new \AcademyHQ\API\ValueObjects\Integer("is_approved_by_etb_ao"),
		new \AcademyHQ\API\ValueObjects\Integer("is_approved_by_solas_admin"),
		new \AcademyHQ\API\ValueObjects\StringVO("order_by_field"),
		new \AcademyHQ\API\ValueObjects\StringVO("order_by_direction")
	);
</pre>

### 7> Create Apprenticeship Document
<pre>
	/*@returns apprenticeship_document std object*/
	$apprenticeship_document = $etbao_repository->create_apprenticeship_document(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\ID("apprenticeship_id"),
		new \AcademyHQ\API\ValueObjects\Integer("is_declined"),
		new \AcademyHQ\API\ValueObjects\Integer("is_approved"),
		new \AcademyHQ\API\ValueObjects\Integer("is_approved_by_solas_admin"),
		new \AcademyHQ\API\ValueObjects\Integer("is_rejected_by_solas_admin"),
		new \AcademyHQ\API\ValueObjects\StringVO("type"),
		new \AcademyHQ\API\ValueObjects\StringVO("document"),
		new \AcademyHQ\API\ValueObjects\StringVO("extension")
	);
</pre>

### 8> Create Apprentice Document
<pre>
	/*@returns apprentice_document std object*/
	$apprenticeship_document = $etbao_repository->create_apprentice_document(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\Integer("member_id"),
		new \AcademyHQ\API\ValueObjects\Integer("apprenticeship_id"),
		new \AcademyHQ\API\ValueObjects\Integer("is_declined"),
		new \AcademyHQ\API\ValueObjects\Integer("is_approved_by_etb_ao"),
		new \AcademyHQ\API\ValueObjects\Integer("is_approved_by_solas_admin"),
		new \AcademyHQ\API\ValueObjects\StringVO("type"),
		new \AcademyHQ\API\ValueObjects\StringVO("document"),
		new \AcademyHQ\API\ValueObjects\StringVO("extension")
	);
</pre>

## Using ETB Admin Repository

### 1> Assign AO To Apprenticeship Application
<pre>
	/*@return updated apprenticeship_details std object */
  	$apprenticeship = $etbadmin_repository->assign_ao_to_apprenticeship_application(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\ApprenticeshipID("your_apprenticeship_id"),
		new \AcademyHQ\API\ValueObjects\Integer("your_employer_id")
	);
</pre>

### 2> Get My ETB Authorising Officer
<pre>
	*@return etb_authorizing_officer_details std object */
  	$etb_authorizing_officer_details = $etbadmin_repository->get_etb_admins(new \AcademyHQ\API\ValueObjects\Token('your token'));
</pre>

### 3> Get My ETB
<pre>
	*@return my_etb std object */
  	$my_etb = $etbadmin_repository->get_my_etb(new \AcademyHQ\API\ValueObjects\Token('your token'));
</pre>

### 4> Fetch All Apprenticeships
<pre>
	*@return apprenticeships std object */
  	$apprenticeships = $etbadmin_repository->fetch_all_apprenticeships(
  	new \AcademyHQ\API\ValueObjects\Token('your token'),
  	new \AcademyHQ\API\ValueObjects\Integer("employer_id"),
  	new \AcademyHQ\API\ValueObjects\Integer("is_new_apprenticeships_application"),
  	new \AcademyHQ\API\ValueObjects\Integer("is_site_visit_approved"),
  	new \AcademyHQ\API\ValueObjects\Integer("is_site_visit_rejected"),
  	new \AcademyHQ\API\ValueObjects\Integer("is_site_visit_booked"),
  	new \AcademyHQ\API\ValueObjects\Integer("current_page"),
  	new \AcademyHQ\API\ValueObjects\Integer("set_per_page"),
  	new \AcademyHQ\API\ValueObjects\StringVO("order_by_field"),
  	new \AcademyHQ\API\ValueObjects\StringVO("order_by_direction")
  	);
</pre>

## Using Assessor Repository

### 1> Edit Program Evidence
<pre>
	/*@return updated program_evidence std object */
  	$program_evidence = $assessor_repository->edit_program_evidence(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\Integer("your_program_evidence_id"),
		new \AcademyHQ\API\ValueObjects\Integer("is_approved_by_assessor"),
		new \AcademyHQ\API\ValueObjects\Integer("is_rejected_by_assessor")
	);
</pre>

### 2> Edit Member Program
<pre>
	/*@return updated member_program std object */
  	$member_program = $assessor_repository->edit_member_program(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\Integer("your_member_program_id"),
		new \AcademyHQ\API\ValueObjects\Integer("is_completed")
	);
</pre>

### 3> Get Member Audits
<pre>
	/*@return member_audit_forms std object */
  	$member_audit_forms = $assessor_repository->member_audits(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\ID("your_member_program_id")
	);
</pre>

### 4> Get Member Audit Form Launch Url
<pre>
	/*@return launch_url std object */
  	$launch_url = $assessor_repository->member_audit_launch(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\ID("your_member_audit_form_id")
	);
</pre>

### 4> Get Member Audit Form View
<pre>
	/*@return member_audit_from std object */
  	$member_audit_from = $assessor_repository->member_audit_view(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\ID("your_member_audit_form_id")
	);
</pre>

### 5> Edit Member Audit Form
<pre>
	/*@return updated member_audit_from std object */
  	$member_audit_from = $assessor_repository->edit_member_audit(
		new \AcademyHQ\API\ValueObjects\Token("your_token"),
		new \AcademyHQ\API\ValueObjects\Integer("your_member_audit_form_id"),
		new \AcademyHQ\API\ValueObjects\Integer("is_assessed"),
		new \AcademyHQ\API\ValueObjects\Integer("is_verified"),
		new \AcademyHQ\API\ValueObjects\Integer("is_approved")
	);
</pre>

## Using GDPR Repository

### 1> Sub Organisation Create Inherit Domain
<pre>
 	/*@returns organisation_details of created sub organisation*/
	$sub_organisation = $GDPR_repository->sub_org_create_inherit_domain(
		new \AcademyHQ\API\ValueObjects\StringVO("Test Organisation")
	);
</pre>

### 2> Sub Organisation Admin Create
<pre>
 	/*@returns member_details of created sub organisation admin*/
	$sub_organisation_admin = $GDPR_repository->create_sub_org_admin(
		new \AcademyHQ\API\ValueObjects\OrganisationID('sub_organisation_id'),
		\AcademyHQ\API\ValueObjects\Name::fromNative("First Name", "Last Name"),
		new \AcademyHQ\API\ValueObjects\Email('your_email')
	);
</pre>

### 3> Create License
<pre>
 	/*@returns license_details of created license*/
	$license_details = $GDPR_repository->create_license(
		new \AcademyHQ\API\ValueObjects\OrganisationID('sub_organisation_id'),
		new \AcademyHQ\API\ValueObjects\CourseID("course_id"),
		new \AcademyHQ\API\ValueObjects\MemberID('admin_id'),
		new \AcademyHQ\API\ValueObjects\Integer('quantity_of_license'),
		new \AcademyHQ\API\ValueObjects\StringVO('price_of_license'),
		new \AcademyHQ\API\ValueObjects\StringVO('currency'),
		new \AcademyHQ\API\ValueObjects\StringVO('vat_rate'),
		new \AcademyHQ\API\ValueObjects\StringVO('vat_number')
	);
</pre>

### 4> Create Member
<pre>
	/*@return member details of created member*/
	$member_details = $GDPR_repository->create_enrolment(
		new \AcademyHQ\API\ValueObjects\OrganisationID('organisation_id'),
		new \AcademyHQ\API\ValueObjects\Name::fromNative("First Name", "Last Name"), 
		new \AcademyHQ\API\ValueObjects\Email('email')
	);
</pre>

### 5> Create Enrolment
<pre>
	/*@return enrolment details of created enrolment*/
	$enrolment_details = $GDPR_repository->create_enrolment(
		new \AcademyHQ\API\ValueObjects\MemberID('member_id'),
		new \AcademyHQ\API\ValueObjects\CourseID('course_id') 
	);
</pre>

### 6> Check License
<pre>
	/*@return true or false accroding to availability of license*/
	$is_available = $GDPR_repository->check_license(
		new \AcademyHQ\API\ValueObjects\LicenseID('license_id') 
	);
</pre>

### 7> Rollback
<pre>
	/*@return success message*/
	$rollback_message = $GDPR_repository->rollback(
		new \AcademyHQ\API\ValueObjects\MemberID('member_id'),
		new \AcademyHQ\API\ValueObjects\OrganisationID('organisation_id') 
	);
</pre>

### 8> VAt Validate
<pre>
	/*@return true or false according to vat validation*/
	$validation = $GDPR_repository->vat_validation(
		new \AcademyHQ\API\ValueObjects\StringVO('country_code'),
		new \AcademyHQ\API\ValueObjects\StringVO('vat_number'),
		new \AcademyHQ\API\ValueObjects\StringVO('organisation_name')
	);
</pre>

### 9> Partner Organisation Create With APIS
<pre>
 	/*@returns organisation_details of created sub organisation*/
	$sub_organisation = $GDPR_repository->create_partner_with_apis(
		new \AcademyHQ\API\ValueObjects\StringVO("Test Organisation"),
		new \AcademyHQ\API\ValueObjects\StringVO("Sub Domain") <!-- nullable -->
	);
</pre>

### 10> Create License New
<pre>
 	/*@returns license_details of created license*/
	$license_details = $GDPR_repository->create_license_new(
		new \AcademyHQ\API\ValueObjects\OrganisationID('sub_organisation_id'),
		new \AcademyHQ\API\ValueObjects\CourseID("course_id"),
		new \AcademyHQ\API\ValueObjects\MemberID('admin_id'),
		new \AcademyHQ\API\ValueObjects\Integer('quantity_of_license'),
		new \AcademyHQ\API\ValueObjects\StringVO('price_of_license'),
		new \AcademyHQ\API\ValueObjects\StringVO('currency'),
		new \AcademyHQ\API\ValueObjects\StringVO('vat_rate'),
		new \AcademyHQ\API\ValueObjects\StringVO('vat_number'),
		new \AcademyHQ\API\ValueObjects\StringVO('sub_domain'),
		new \AcademyHQ\API\ValueObjects\StringVO('member_details')
	);
</pre>

### 11> Create License For Individual Along With Enrolment
<pre>
 	/*@returns license_details of created license*/
	$license_details = $GDPR_repository->create_license_for_individual(
		new \AcademyHQ\API\ValueObjects\OrganisationID('organisation_id'),
		new \AcademyHQ\API\ValueObjects\CourseID("course_id"),
		new \AcademyHQ\API\ValueObjects\MemberID('admin_id'),
		new \AcademyHQ\API\ValueObjects\Integer('quantity_of_license'),
		new \AcademyHQ\API\ValueObjects\StringVO('price_of_license'),
		new \AcademyHQ\API\ValueObjects\StringVO('currency'),
		new \AcademyHQ\API\ValueObjects\StringVO('vat_rate'),
		new \AcademyHQ\API\ValueObjects\StringVO('vat_number')
	);
</pre>

### 12> Create Organisation Package
<pre>
 	/*@returns organisation_package of created license*/
	$organisation_package = $GDPR_repository->create_organisation_package(
		new \AcademyHQ\API\ValueObjects\OrganisationID('sub_organisation_id'),
		new \AcademyHQ\API\ValueObjects\ID("package_id"),
		new \AcademyHQ\API\ValueObjects\MemberID('admin_id'),
		new \AcademyHQ\API\ValueObjects\StringVO('price'),
		new \AcademyHQ\API\ValueObjects\Integer('quantity_of_license'),
		new \AcademyHQ\API\ValueObjects\StringVO('currency'),
		new \AcademyHQ\API\ValueObjects\StringVO('vat_rate'),
		new \AcademyHQ\API\ValueObjects\StringVO('vat_number'),
		new \AcademyHQ\API\ValueObjects\StringVO('member_details')
	);
</pre>


## Using Crms Repository

### 1> Create Organisation(Client) To Academyhq
<pre>
	/*@return created client_details std object */
  	$client_details = $crms_repository->create_client(
		new \AcademyHQ\API\ValueObjects\StringVO("Organisation name"),
		new \AcademyHQ\API\ValueObjects\StringVO("domain name")
	);
</pre>

### 2> Fetch All Public Courses
<pre>
	/*@return all public courses details std object */
  	$course_details = $crms_repository->get_courses(
		new \AcademyHQ\API\ValueObjects\StringVO("search parameter"),
		new \AcademyHQ\API\ValueObjects\Integer("page_number")
	);
</pre>

### 3> Create Course
<pre>
	/*@return created standard course details std object */
  	$client_details = $crms_repository->create_course(
		new \AcademyHQ\API\ValueObjects\StringVO("course name"),
		new \AcademyHQ\API\ValueObjects\StringVO("course description"),
		new \AcademyHQ\API\ValueObjects\StringVO("image_url")
	);
</pre>

### 4> Find License
<pre>
	/*@return return license_details std object */
  	$license_details = $crms_repository->find_license(
		new \AcademyHQ\API\ValueObjects\OrganisationID("organisation_id"),
		new \AcademyHQ\API\ValueObjects\CourseID("course_id")
	);
</pre>

### 5> Find Organisation Package
<pre>
	/*@return return org_package_details std object */
  	$org_package_details = $crms_repository->find_org_package(
		new \AcademyHQ\API\ValueObjects\OrganisationID("organisation_id"),
		new \AcademyHQ\API\ValueObjects\ID("package_id")
	);
</pre>


### 6> Fetch All Organisations with api if exists
<pre>
	/*@return all organisation details std object */
  	$organisation_details = $crms_repository->get_organisations(
		new \AcademyHQ\API\ValueObjects\StringVO("search parameter"),
		new \AcademyHQ\API\ValueObjects\Integer("page_number"))
	);
</pre>

### 7> Fetch All Course packages
<pre>
	/*@return all Course packages details std object */
  	$package_details = $crms_repository->get_packages();

</pre>

### 8> Create Organisation Admin
<pre>
	/*@return all members details std object */
  	$member_details = $crms_repository->create_org_admin(
			new VO\OrganisationID("organisation_id"),
			VO\Name::fromNative("First Name", "Last name"),
			new VO\Email ("email")
	);
</pre>

### 9> Fetch All Courses
<pre>
	/*@return all standard courses std object*/
	$course_details = $crms_repository->get_all_courses(
			new VO\Integer('current_page'),
			new VO\Integer('per_page')
	);
</pre>

### 10> Fetch Organisation App Credentials
<pre>
	/*@return all standard courses std object*/
	$course_details = $crms_repository->fetch_organisation_api(
			new VO\OrganisationID('organisation_id')
	);
</pre>

### 11> RollBack created organisation and admin.
<pre>
	/*@return all standard courses std object*/
	$rollback = $crms_repository->rollback(
						new VO\MemberID ($member_id),
						new VO\OrganisationID ($organisation_id)
				);
</pre>

### 12> Update Organisation Subscription
<pre>
	/*@return Update Organisation Subscription*/
	$update_organisation_subscription = $crms_repository->update_organisation_subscription(
						VO\OrganisationID $organisation_id,
						VO\ID $subscription_id = null,
						VO\CourseIDArray $subscription_courses,
						VO\CourseIDArray $subscription_bundles,
						VO\Integer $max_enrolments,
						VO\Integer $max_licenses,
						VO\Integer $max_members
				);
</pre>

### 13> Delete Organisation Subscription
<pre>
	/*@ Delete Organisation Subscription*/
	 $crms_repository->delete_organisation_subscription(
						VO\OrganisationID $organisation_id,
						VO\ID $subscription_id = null,
						VO\CourseIDArray $subscription_courses,
						VO\CourseIDArray $subscription_bundles,
						VO\Integer $max_enrolments,
						VO\Integer $max_licenses,
						VO\Integer $max_members
				);
</pre>

### 14> Transger member to Academy
<pre>
	/*@return member id std object */
  	$member_id = $crms_repository->transfer_member(
			new VO\OrganisationID("organisation_id"),
			VO\Name::fromNative("First Name", "Last name"),
			new VO\Email ("email"),
			new VO\Integer('is_admin')
	);
</pre>

### 15> Create Member Enrolment to Course
<pre>
	/*@return response with status and message std object */
  	$response = $crms_repository->member_enrolment_to_course(
			VO\CourseID('course_id'),
			VO\MemberID('member_id')
	);
</pre>

### 16> Create Member Enrolment to Package
<pre>
	/*@return response with status and message std object */
  	$response = $crms_repository->member_enrolment_to_course(
			VO\ID('package_id'),
			VO\MemberID('member_id')
	);
</pre>

### 17> Get Id of Members 
<pre>
	/*@returns members_id */
	$members_id = $member_api_repository->get_all_members_id(VO\OrganisationID $organisation_id);
</pre>

### 18> Create Member And Auto Enroll
<pre>
	/*@return return status and message*/
	$response = $crms_repository->create_member_and_enroll(
		new \AcademyHQ\API\ValueObjects\Token("token"),
		new \AcademyHQ\API\ValueObjects\OrganisationID("organisation_id"),
		\AcademyHQ\API\ValueObjects\Name::fromNative("First Name", "Last Name"),
		new \AcademyHQ\API\ValueObjects\Email("email"),
		new \AcademyHQ\API\ValueObjects\Integer("is_admin"),
		new \AcademyHQ\API\ValueObjects\String("admin_token")
	);
</pre>

### 19> Get Organisation Details
<pre>
	/*@return return organisation details*/
	$organisation_details = $crms_repository->get_organisation_details(
		new \AcademyHQ\API\ValueObjects\OrganisationID("organisation_id")
	);
</pre>

### 20> Create ThirdParty Member
<pre>
	/*@return return member details*/
	$member_details = $crms_repository->third_party_member_create(
		new VO\OrganisationID('organisation_id'),
		VO\Name::fromNative('first_name','last_name'),
		new VO\Email('email'),
		new VO\Username('username'),
		new VO\Integer('is_admin'),
		new VO\PublicID('pub_id'),
		new VO\Password('password'),
		new VO\Integer('mobile_number'),
		new VO\StringVO('street'),
		new VO\StringVO('city'),
		new VO\StringVO('state'),
		new VO\StringVO('country'),
		new VO\StringVO('postal_code')
	);
</pre>

### 21> Edit ThirdParty Member
<pre>
	/*@return return member details*/
	$member_details = $crms_repository->third_party_member_edit(
		new VO\OrganisationID('organisation_id'),
		new VO\PublicID('pub_id'),
		VO\Name::fromNative('first_name','last_name'),
		new VO\Email('email'),
		new VO\Username('username'),
		new VO\Integer('is_admin'),
		new VO\Password('password'),
		new VO\Integer('mobile_number'),
		new VO\Integer('is_deleted'),
		new VO\StringVO('street'),
		new VO\StringVO('city'),
		new VO\StringVO('state'),
		new VO\StringVO('country'),
		new VO\StringVO('postal_code')
	);
</pre>

### 22> fetch ThirdParty Member
<pre>
	/*@return return member details*/
	$member_details = $crms_repository->third_party_member_fetch(
		new VO\OrganisationID('organisation_id'),
		new VO\PublicID('pub_id')
	);
</pre>

### 23> fetch courses details
<pre>
	/*@return return courses details*/
	$courses_details = $crms_repository->classroom_courses_details(
		\AcademyHQ\API\ValueObjects\CourseIDArray::fromNative(array())
	);
</pre>

### 24> create client and client admin
<pre>
	/*@return return organisation and member details*/
	$response = $crms_repository->create_organisation_and_admin(
		new \AcademyHQ\API\ValueObjects\StringVO('organisation_name'),
		new \AcademyHQ\API\ValueObjects\StringVO('domain'),
		new \AcademyHQ\API\ValueObjects\Email('email'),
		\AcademyHQ\API\ValueObjects\Name::fromNative("first_name", "last_name"),
		new \AcademyHQ\API\ValueObjects\StringVO('contact_number'),
		new \AcademyHQ\API\ValueObjects\StringVO('billing_address'),
		new \AcademyHQ\API\ValueObjects\StringVO('tax_code'),
		new \AcademyHQ\API\ValueObjects\StringVO('company_website'),
		new \AcademyHQ\API\ValueObjects\StringVO('branding_logo_url'),
		new \AcademyHQ\API\ValueObjects\StringVO('background_url'),
		new \AcademyHQ\API\ValueObjects\StringVO('organisation_id')
	);
</pre>

### 25> create Bulk Licenses for Organisation
<pre>
	/*@return created licenses ids*/
	$licenses_ids = $crms_repository->create_bulk_licenses(
		new \AcademyHQ\API\ValueObjects\OrganisationVO('organisation_id'),
		\AcademyHQ\API\ValueObjects\CourseIDArray::fromNative(array()),
		new \AcademyHQ\API\ValueObjects\Integer('no_of_licenses')
	);
</pre>

### 26> Register member
<pre>
	/*@return details of registered member */
	$licenses_ids = $crms_repository->register_member(
		new \AcademyHQ\API\ValueObjects\MemberID('member_id'),
		new \AcademyHQ\API\ValueObjects\Password('password'),
		new \AcademyHQ\API\ValueObjects\Username('username')
	);
</pre>

### 27> fetch courses details
<pre>
	/*@return return courses details*/
	$classroom_courses = $crms_repository->classroom_course_typeahead(
		new \AcademyHQ\API\ValueObjects\StringVO('search_term')
	);
</pre>

### 28> Notify classroom admin
<pre>
	/*@return success message */
	$response = $crms_repository->notify_classroom_admin(
		new \AcademyHQ\API\ValueObjects\OrganisationID('organisation'),
		new \AcademyHQ\API\ValueObjects\MemberID('admin_id'),
		new \AcademyHQ\API\ValueObjects\StringVO('json_data_with_classrooms_ids_and_seats')
	);
</pre>

### 29> check email exist
<pre>
	/*@return std object */
  	$member_details = $crms_repository->check_email_exist(
			new VO\Email ("email")
	);
</pre>

### 30> check subdomain exist
<pre>
	/*@return std object */
  	$member_details = $crms_repository->check_sub_domain_exist(
			new VO\StringVO ("sub_domain")
	);
</pre>

### 31> Member RegisterOrCreate
<pre>
	/*@return success message with member_id*/
	$response = $crms_repository->member_register_or_create(
		new \AcademyHQ\API\ValueObjects\Email('email'),
		new \AcademyHQ\API\ValueObjects\OrganisationID('organisation'),
		\AcademyHQ\API\ValueObjects\Name::fromNative("first_name", "last_name"),
		new \AcademyHQ\API\ValueObjects\Integer('is_admin'),
		new \AcademyHQ\API\ValueObjects\Password('password')
	);
</pre>

### 32> Member Password change
<pre>
	/*@return success message with member_id*/
	$response = $crms_repository->ahq_update_password(
		new \AcademyHQ\API\ValueObjects\MemberID('member_id'),
		new \AcademyHQ\API\ValueObjects\Password('password')
	);
</pre>

### 32> Update member details in AHQ
<pre>
	/*@return success message with member_id*/
	$response = $crms_repository->ahq_update_member_details(
		new \AcademyHQ\API\ValueObjects\MemberID('member_id'),
		new \AcademyHQ\API\ValueObjects\StringVO('first_name'),
		new \AcademyHQ\API\ValueObjects\StringVO('last_name'),
		new \AcademyHQ\API\ValueObjects\StringVO('profile_imagge_url'),
	);
</pre>

### 33> Update organisation branding details
<pre>
	/*@return success message with member_id*/
	$response = $crms_repository->ahq_update_branding_details(
		new VO\OrganisationID($request->ahq_id),
        new VO\StringVO($request->branding_logo_url),
        new VO\StringVO($request->background_url),
        new VO\StringVO($request->branding_hex)
	);
</pre>

## Using Course Api Repository

### 1> Fetch All Organisation Licenses
<pre>
	/*@return all licenses with course details std object */
  	$license_details = $course_api_repository->get_licenses(
		new \AcademyHQ\API\ValueObjects\StringVO("search parameter"),
		new \AcademyHQ\API\ValueObjects\Integer("page_number")
	);
</pre>

### 2> Fetch All Organisation Profiles
<pre>
	/*@return all profiles with course details std object */
  	$profile_details = $course_api_repository->fetch_all_profiles();
</pre>

### 3> Fetch All Modules
<pre>
	/*@return all profiles with course details std object */
  	$modules = $course_api_repository->fetch_all_modules(
  		new \AcademyHQ\API\ValueObjects\StringVO("search parameter"),
		new \AcademyHQ\API\ValueObjects\Integer("page_number")
  	);
</pre>

### 4> Get License's Enrolled member
<pre>
	/*@return all enrolments with member details std object */
  	$member_details = $course_api_repository->get_license_enrolled_members(
  		new \AcademyHQ\API\ValueObjects\CourseID("course_id"),
  		new \AcademyHQ\API\ValueObjects\LicenseID("license_id"),
  		new \AcademyHQ\API\ValueObjects\StringVO("search parameter"),  		
		new \AcademyHQ\API\ValueObjects\Integer("page_number")
  	);
</pre>

### 5> Add Quantity of License
<pre>
 	/*@returns license_details of added license*/
	$license_details = $course_api_repository->add_license(
		new \AcademyHQ\API\ValueObjects\LicenseID('license_id'),
		new \AcademyHQ\API\ValueObjects\CourseID('course_id'),
		new \AcademyHQ\API\ValueObjects\Integer('quantity_of_license'),
		new \AcademyHQ\API\ValueObjects\StringVO('price_of_license'),
		new \AcademyHQ\API\ValueObjects\StringVO('currency'),
		new \AcademyHQ\API\ValueObjects\StringVO('full_name'),
		new \AcademyHQ\API\ValueObjects\StringVO('vat_rate'),
		new \AcademyHQ\API\ValueObjects\StringVO('vat_number'),
		new \AcademyHQ\API\ValueObjects\Email('email')
	);
</pre>

### 6> Get License
<pre>
	/*@returns license_details of if license avaiable null if not*/
	$license_details = $course_api_repository->license_get(
		new \AcademyHQ\API\ValueObjects\CourseID('course_id')
	);
</pre>

### 7> Get Organisation Packages
<pre>
	/*@returns package_details of all organisation packages */
	$package_details = $course_api_repository->get_organisation_packages()
	);
</pre>

### 8> Get Organisation Packages details 
<pre>
	/*@returns package_details along with member enrolled and courses on package */
	$package_details = $course_api_repository->get_package_details(
	new \AcademyHQ\API\ValueObjects\ID('package_id'))
	);
</pre>

### 9> Get Package Member details 
<pre>
	/*@returns enrolled_member_details of enrolled on package */
	$enrolled_member_details = $course_api_repository->package_member_details(
	new \AcademyHQ\API\ValueObjects\ID('package_id'),
	new \AcademyHQ\API\ValueObjects\Integer('current_page'),
	new \AcademyHQ\API\ValueObjects\StringVO('search'))
	);
</pre>

### 10> Get Package and OranisationPackage if exists from Licenses 
<pre>
	/*@returns package_id organisation_package id if exists */
	$response = $course_api_repository->package_get_from_licenses();
</pre>

### 11> create Package and OranisationPackage from Licenses 
<pre>
	/*@returns package_details and organisation_package id */
	$response = $course_api_repository->package_get_from_licenses(
		new \AcademyHQ\API\ValueObjects\StringVO("name"),
		new \AcademyHQ\API\ValueObjects\StringVO("description"),
		new \AcademyHQ\API\ValueObjects\StringVO("image"),
		new \AcademyHQ\API\ValueObjects\StringVO("certificate_logo_url")
	);
</pre>

### 12> Get Sub-Organisation Packages
<pre>
	/*@returns package_details of all organisation packages of sub organisation*/
	$package_details = $course_api_repository->get_organisation_packages(
		new \AcademyHQ\API\ValueObjects\OrganisationID("sub_organisation_id")
	);
</pre>

### 13> Get Sub-Organisation Packages
<pre>
	/*@returns true for licenses exist for all courses and false for licesnse not exists for all*/
	$package_details = $course_api_repository->licenses_check(
		\AcademyHQ\API\ValueObjects\CourseIDArray::fromNative(array('course_id1','course_id2'))
	);
</pre>

## Using Member Api Repository

### 1> Fetch All Organisation Licenses
<pre>
	/*@return all members details std object */
  	$member_details = $course_api_repository->get_members(
		new \AcademyHQ\API\ValueObjects\StringVO("search parameter"),
		new \AcademyHQ\API\ValueObjects\Integer("page_number")
	);
</pre>

### 2> Check Member Enrollment for Course
<pre>
	/*@return true or false for enrollment exist or not */
  	$enrolment_exist = $course_api_repository->check_course_enrollment(
		new \AcademyHQ\API\ValueObjects\MemberID("member_id"),
		new \AcademyHQ\API\ValueObjects\CourseID("course_id")
	);
</pre>

### 3> Check Member Enrollments for Package
<pre>
	/*@return true or false for member enrolled in package or not */
  	$enrolment_exist = $course_api_repository->check_course_enrollment(
		new \AcademyHQ\API\ValueObjects\MemberID("member_id"),
		new \AcademyHQ\API\ValueObjects\ID("package_id")
	);
</pre>

### 4> Create Member Enrollments for Course
<pre>
	/*@return true or false for member enrolled in package or not */
  	$enrolment_exist = $course_api_repository->create_enrolment(
		new \AcademyHQ\API\ValueObjects\MemberID("member_id"),
		new \AcademyHQ\API\ValueObjects\ID("course_id")
	);
</pre>

### 5> Create Member 
<pre>
	/*@returns member_details of created member*/
	$member = $member_api_repository->create_member(
		\AcademyHQ\API\ValueObjects\Name::fromNative("first_name", "last_name"),
		new \AcademyHQ\API\ValueObjects\Username("username"),
		new \AcademyHQ\API\ValueObjects\Password("password"),
		new \AcademyHQ\API\ValueObjects\Password("password_confirm"),
		new \AcademyHQ\API\ValueObjects\PublicID("your_pub_id")
	);
</pre>

### 6> Get Member 
<pre>
	/*@returns member_details */
	$member_details = $member_api_repository->get_member(
		new \AcademyHQ\API\ValueObjects\MemberID("member_id")
	);
</pre>

### 7> Get Profile Members 
<pre>
	/*@returns member_details */
	$member_details = $member_api_repository->fetch_profile_members(
		new \AcademyHQ\API\ValueObjects\ID("profile_id"),
		new \AcademyHQ\API\ValueObjects\Integer("current_page"),
		new \AcademyHQ\API\ValueObjects\StringVO("search")
	);
</pre>

### 8> Check Member Exist 
<pre>
	/*@returns member_details if exist*/
	$member_details = $member_api_repository->check_member_exist(
		new \AcademyHQ\API\ValueObjects\Email("example@example.com"),
		new \AcademyHQ\API\ValueObjects\OrganisationID("organisation_id")
	);
</pre>

### 9> Create Bulk Enrolment 
<pre>
	/*@returns success response*/
	$response = $member_api_repository->create_bulk_enrolments(
		new \AcademyHQ\API\ValueObjects\MemberID("member_id"),
		new \AcademyHQ\API\ValueObjects\OrganisationID("organisation_id")
		\AcademyHQ\API\ValueObjects\CourseIDArray::fromNative(array('course_id_1', 'course_id_2')),
		new \AcademyHq\API\ValueObjects\Flag("deduct_license");
	);
</pre>


## Using Organisation Api Repository

### 1> Delete Partner
<pre>
	/*@return status success with success message */
  	$response = $organisation_api_repository->delete_partner(
		new \AcademyHQ\API\ValueObjects\OrganisationID("organisation_id")
	);
</pre>

### 2> Create Organisation Package
<pre>
	/*@return status success with organisation_package details */
  	$response = $organisation_api_repository->create_org_package(
		new \AcademyHQ\API\ValueObjects\OrganisationID("organisation_id"),
		new \AcademyHQ\API\ValueObjects\ID("package_id"),
		new \AcademyHQ\API\ValueObjects\Integer("number_of_package")
	);
</pre>

## Using Learner Api Repository

### 1> get all Enrolments of Learner
<pre>
	/*@return all Enrolments of learner */
  	$enrolments = $learner_api_repository->get_all_enrollments(
		new \AcademyHQ\API\ValueObjects\Token("token")
	);
</pre>

### 2> get enrollment detail of Learner
<pre>
	/*@return all learner get_enrollment_detail */
  	$enrollmentDetail = $learner_api_repository->get_enrollment_detail(
		new \AcademyHQ\API\ValueObjects\Integer("enrollmentId"),
		new \AcademyHQ\API\ValueObjects\Token("token")
	);
</pre>

### 3> get all bundles of Learner
<pre>
	/*@return all learner get_all_bundles */
  	$bundles = $learner_api_repository->get_all_enrollments(
		new \AcademyHQ\API\ValueObjects\Token("token")
	);
</pre>

### 4> get all certificates of Learner
<pre>
	/*@return all learner get_all_certificates */
  	$$certificates = $learner_api_repository->get_all_certificates(
		new \AcademyHQ\API\ValueObjects\Token("token")
	);
</pre>

### 5> get certificate detail of Learner
<pre>
	/*@return all learner get_certificate_detail */
  	$certificateDetail = $learner_api_repository->get_certificate_detail(
		new \AcademyHQ\API\ValueObjects\Integer("certificateId"),
		new \AcademyHQ\API\ValueObjects\Token("token")
	);
</pre>

### 6> get all videos of Learner
<pre>
	/*@return all learner get_all_videos */
  	$videos = $learner_api_repository->get_all_videos(
		new \AcademyHQ\API\ValueObjects\Token("token")
	);
</pre>

### 7> get video detail of Learner
<pre>
	/*@return all learner get_certificate_detail */
  	$videoDetail = $learner_api_repository->get_video_detail(
		new \AcademyHQ\API\ValueObjects\Integer("videoId"),
		new \AcademyHQ\API\ValueObjects\Token("token")
	);
</pre>

### 8> get enrollment launch url detail of Learner
<pre>
	/*@return all learner get_enrollment_launch_url_detail */
  	$enrollmentDetail = $learner_api_repository->get_enrollment_launch_url_detail(
		new \AcademyHQ\API\ValueObjects\Integer("enrollmentId"),
		new \AcademyHQ\API\ValueObjects\Token("token")
	);
</pre>

### 9> get enrollment launch callback detail of Learner
<pre>
	/*@return all learner enrollment_callback */
  	$enrollmentDetail = $learner_api_repository->enrollment_callback(
		new \AcademyHQ\API\ValueObjects\Integer("enrollmentId"),
		new \AcademyHQ\API\ValueObjects\Token("token")
	);
</pre>

