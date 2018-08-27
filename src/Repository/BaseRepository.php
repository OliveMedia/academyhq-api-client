<?php
namespace AcademyHQ\API\Repository;

class BaseRepository
{
    protected $base_url;
    protected $credentials;
    public function __construct()
    {
        $this->base_url = "https://api.academyhq.com/api/v2"; //PROD URL
        // $this->base_url ='https://api.sandbox.academyhq.olive.media/api/v2'; //SDBX URL
        // $this->base_url = "https://api.academyhq.localhost/api/v2"; //LOCALHOST URL
    }
}
