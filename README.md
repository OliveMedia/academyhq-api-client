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
	$license_repository = $factory->get_course_repository(); 
	[Instance of \AcademyHQ\API\Repository\CourseRepository is required to perform any action related to course]	
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
	$response = $member_repository->save(
		new \AcademyHQ\API\ValueObjects\MemberID($member_id),
		new \AcademyHQ\API\ValueObjects\Password('updated password')
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


## Using License Repository

### 1> Getting Licenses
<pre>
 	/*@returns array of License std object */
 	/* License std object contains id, created_at, updated_at, course_id, name, descripton_message, completion_message, duration, typical_time, is_active and is_deleted  */
	$licenses = $license_repository->get_all();
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
	$courses = $course_repository->get_all();
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