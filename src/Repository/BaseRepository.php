<?php

	namespace AcademyHQ\API\Repository;
	
	Class BaseRepository{
		// for production 
		protected $base_url = 'https://api.academyhq.com/api/v2'; 

		// for sandbox 
		//protected $base_url = 'https://api.sandbox.academyhq.olive.media/api/v2'; 

		// for local 
		// protected $base_url = 'http://api.academyhq.localhost/api/v2'; 

		public function __construct()
		{
			
		}
	}
?>