<?php

namespace AcademyHQ\API\Repository;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class MemberRepository
{

	private $base_url = 'https://api.academyhq.com/api/v2';

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	/**
	* @return member_id
	*/
	
	public function create(
		VO\Name $name,
		VO\Username $username,
		VO\Email $email,
		VO\Password $password,
		VO\ID $pub_id = null
	)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/member/create'),
			new VO\HTTP\Method('POST')
		);

		$request_parameters = array(
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString(),
			'username' => $username->__toString(),
			'email' => $email->__toString(),
			'password' => $password->__toString(),
			'password_confirmation' => $password->__toString()
		);

		if($pub_id) {
			$request_parameters['pub_id'] = $pub_id->__toString();
		}

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data->member_id;
	}

	/**
	* @return success message
	*/

	public function save(
		VO\MemberID $id,
		VO\Name $name,
		VO\Username $username,
		VO\Email $email
	)
	{
		$member_id = $id->__toString();
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/member/'.$member_id.'/save'),
			new VO\HTTP\Method('PUT')
		);

		$request_parameters = array(
			'first_name' => $name->get_first_name()->__toString(),
			'last_name' => $name->get_last_name()->__toString(),
			'username' => $username->__toString(),
			'email' => $email->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();
		return $data->message;
	}

	/**
	* @return success message
	*/

	public function change_password(
		VO\MemberID $id,
		VO\Password $password
	)
	{
		$member_id = $id->__toString();
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/member/'.$member_id.'/password/change'),
			new VO\HTTP\Method('PUT')
		);

		$request_parameters = array(
			'password' => $password->__toString(),
			'password_confirmation' => $password->__toString()
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();
		return $data->message;
	}

	/**
	* @return std member object
	*/

	public function get(VO\MemberID $id)
	{

		$member_id = $id->__toString();
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/member/'.$member_id.'/get'),
			new VO\HTTP\Method('GET')
		);

		$response = $request->send();

		$data = $response->get_data();
		return $data->member;
	}

	/**
	* @return success message
	*/

	public function delete(VO\MemberID $id)
	{
		$member_id = $id->__toString();
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/member/'.$member_id.'/delete'),
			new VO\HTTP\Method('DELETE')
		);

		$response = $request->send();

		$data = $response->get_data();
		return $data->message;
	}

	public function create_bulk_members_array (
		VO\FirstNameArray $first_name_array,
		VO\LastNameArray $last_name_array,
		VO\UsernameArray $username_array,
		VO\EmailArray $email_array,
		VO\PasswordArray $password_array,
		VO\PubIDArray $pub_id_array = null
	)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/member/create/bulk/members'),
			new VO\HTTP\Method('POST')
		);

		$members = array();

		$first_names = $first_name_array->__toArray();
		$last_names = $last_name_array->__toArray();
		$usernames = $username_array->__toArray();
		$emails = $email_array->__toArray();
		$passwords = $password_array->__toArray();

		if($pub_id_array){
			$pub_ids = $pub_id_array->__toArray();
		}

		for ($i=0; $i < count($first_names); $i++) { 

			$members[$i]['first_name'] = $first_names[$i];
			$members[$i]['last_name'] = $last_names[$i];
			$members[$i]['username'] = $usernames[$i];
			$members[$i]['email'] = $emails[$i];
			$members[$i]['password'] = $passwords[$i];

			if(isset($pub_ids[$i])) {
				$members[$i]['pub_id'] = $pub_ids[$i];
			}

		}

		$request_parameters = array(
			'members' => $members
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data->members_ids;
	}

	public function create_bulk_members_json (
		VO\FirstNameArray $first_name_array,
		VO\LastNameArray $last_name_array,
		VO\UsernameArray $username_array,
		VO\EmailArray $email_array,
		VO\PasswordArray $password_array,
		VO\PubIDArray $pub_id_array = null
	)
	{
		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/member/create/bulk/members'),
			new VO\HTTP\Method('POST')
		);

		$members = array();

		$first_names = $first_name_array->__toArray();
		$last_names = $last_name_array->__toArray();
		$usernames = $username_array->__toArray();
		$emails = $email_array->__toArray();
		$passwords = $password_array->__toArray();

		if($pub_id_array){
			$pub_ids = $pub_id_array->__toArray();
		}

		for ($i=0; $i < count($first_names); $i++) { 

			$members[$i]['first_name'] = $first_names[$i];
			$members[$i]['last_name'] = $last_names[$i];
			$members[$i]['username'] = $usernames[$i];
			$members[$i]['email'] = $emails[$i];
			$members[$i]['password'] = $passwords[$i];

			if(isset($pub_ids[$i])) {
				$members[$i]['pub_id'] = $pub_ids[$i];
			}

		}

		$request_parameters = array(
			'members' => json_encode($members)
		);

		$response = $request->send($request_parameters);

		$data = $response->get_data();

		return $data->members_ids;
	}
}