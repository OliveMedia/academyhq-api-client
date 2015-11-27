# academyhq-api-client
Client Library that allow third party to access AcademyHQ APIs.

## NOTE: ALL VALUE OBJECTS ARE SHIPPED WITH THIS PACKAGE
## Getting Repository

<pre>
  $credentials = new \AcademyHQ\API\Common\Credentials(
		new \AcademyHQ\API\ValueObjects\AppID('Your App ID'),
		new \AcademyHQ\API\ValueObjects\SecretKey('Your Secret Key')
	);

	$factory = new \AcademyHQ\API\Repository\Factory($credentials);
	
	/*@return instance of \AcademyHQ\API\Repository\MemberRepository */
	$member_repository = $factory->get_member_repository(); [Instance of \AcademyHQ\API\Repository\MemberRepository is required                                                           to perform any action related to member]
	/*@return instance of \AcademyHQ\API\Repository\EnrolmentRepository */
	$enrolment_repository = $factory->get_member_repository(); [Instance of \AcademyHQ\API\Repository\EnrolmentRepository is required                                                     to perform any action related to enrolment]
	/*@return instance of \AcademyHQ\API\Repository\LicenseRepository */
	$license_repository = $factory->get_member_repository(); [Instance of \AcademyHQ\API\Repository\LicenseRepository is required                                                   to perform any action related to license]
	
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
  $member_repository = $this->member_repository();
  $member = $member_repository->get(new VO\MemberID('your member id'));
</pre>

