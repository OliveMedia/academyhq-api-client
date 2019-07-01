<?php
namespace AcademyHQ\API\Repository;

/**
 * Class BaseRepository
 *
 * @package AcademyHQ\API\Repository
 */
class BaseRepository
{
	/**
	 * @var string
	 */
	protected $base_url;
	/**
	 * @var
	 */
	protected $credentials;

	/**
	 * BaseRepository constructor.
	 */
	public function __construct()
    {
        $this->base_url = "https://api.academyhq.com/api/v2"; //PROD URL
        // $this->base_url ='https://api.sandbox.academyhq.olive.media/api/v2'; //SDBX URL
		// $this->base_url = "http://api.academyhq.localhost/api/v2"; //LOCALHOST URL
		// $this->base_url ='http://api.academyhq.hiup.tk/api/v2'; //mt-server web

    }
}
