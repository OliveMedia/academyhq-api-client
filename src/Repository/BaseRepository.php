<?php 
namespace AcademyHQ\API\Repository;

Class BaseRepository {

	protected $base_url;
	protected $credentials;
	public function __construct(){
		$this->base_url ='https://api.sandbox.academyhq.olive.media/api/v2/oma';
	}
}