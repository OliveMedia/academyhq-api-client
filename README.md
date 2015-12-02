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
	$enrolment_repository = $factory->get_member_repository(); 
	[Instance of \AcademyHQ\API\Repository\EnrolmentRepository is required to perform any action related to enrolment]
	

	/*@return instance of \AcademyHQ\API\Repository\LicenseRepository */
	$license_repository = $factory->get_member_repository(); 
	[Instance of \AcademyHQ\API\Repository\LicenseRepository is required to perform any action related to license]	
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

### 2> Creating enrolments for all available licenses in organisation
<pre>
	/*@return enrolment_ids / array of enrolment id */
	$enrolment_ids = $enrolment_repository->create_for_organisation(
		new \AcademyHQ\API\ValueObjects\MemberID('member_id')
	);
</pre>

### 3> Getting Enrolment
<pre>
	/*@return Enrolment std object that contain the status of enrolment, registration and course name*/
	$enrolment = $enrolment_repository->get(new \AcademyHQ\API\ValueObjects\EnrolmentID('enrolment_id'));
</pre>

### 4> Deleting Enrolment
<pre>
	/*@return Success message*/
	$enrolment = $enrolment_repository->delete(new \AcademyHQ\API\ValueObjects\EnrolmentID('enrolment_id'));
</pre>

### 5> Getting Launch URl 
<pre>
	/*@Start or resume the enrolment and return the launch url*/
	/*@Require Callback Url: Upon exit, the url in your application that the SCORM player will redirect to */
	/*@ See Note Below regarding callback url*/ 
	$launch_url = $enrolment_repository->get_launch_url(new \AcademyHQ\API\ValueObjects\EnrolmentID('enrolment_id'), \AcademyHQ\API\ValueObjects\HTTP\Url::fromNative('callback_url'));

	/* The launch_url can launched in new window or iframe */
	<!-- <iframe src="{{{$launch_url}}}"></iframe> -->
</pre>

### Information needed for callback url 
<pre>
	/*Below code in callback url will sync registration summary and provide you the recent enrolment status */
	/*@Return enrolment std onbject that contain enrolment status */
	$enrolment = $enrolment_repository->sync_result(new \AcademyHQ\API\ValueObjects\EnrolmentID('enrolment_id'));
</pre>

