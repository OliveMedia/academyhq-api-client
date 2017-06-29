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
	* @return request object
	*/
	private function make_request_object($url, $verb){
		$request = new Request(
				new GuzzleClient,
				$this->credentials,
				VO\HTTP\Url::fromNative($this->base_url.$url),
				new VO\HTTP\Method($verb)
			);
		return $request;
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

	/**
		* @return std member object
		*/
		public function fetch_member_by_email(VO\Email $email){
			$member_email = urlencode($email->__toString());
			$request = $this->make_request_object('/member_email/'.$member_email.'/get', 'GET');
			$response = $request->send();
			$data = $response->get_data();
			return $data;
		}

		/**
		* @return std member object
		*/
		public function fetch_member_by_username(VO\Username $username){
			$member_username = $username->__toString();
			$request = $this->make_request_object('/member_username/'.$member_username.'/get', 'GET');
			$response = $request->send();
			$data = $response->get_data();
			return $data;
		}


	/**
	* @return  member objects
	*/
	public function fetch_all_organisation_members(){
		$request = $this->make_request_object('/organisation/all_members', 'GET');
		$response = $request->send();
		$data = $response->get_data();
		return $data;
	}

	/**
	* @return  member object
	*/
	public function fetch_sub_organisation_member($id){
		$request = $this->make_request_object('/organisation/sub_organisation_members/'.$id, 'GET');
		$response = $request->send();
		$data = $response->get_data();
		return $data;
	}
}
