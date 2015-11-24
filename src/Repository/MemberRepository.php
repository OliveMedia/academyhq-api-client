<?php

namespace AcademyHQ\API\Repository;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\Request\Request as Request;
use Guzzle\Service\Client as GuzzleClient;

class MemberRepository
{
	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials
	}
	
	public function create(
		VO\Name $name,
		VO\Username $username,
		VO\Email $email,
		VO\Password $password
	)
	{
		$request = new Request(
			new GuzzleClient,
			new Credentias
			new VO\HTTP\Url(),
			new VO\HTTP\Method(),
			new 
		);

		$request->send();
	}
}