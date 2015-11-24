<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use \Mockery as m;
use AcademyHQ\API\ValueObjects\HTTP\Url;
use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class UrlTest extends PHPUnit_Framework_TestCase
{
	public function tearDown()
	{
		m::close();
	}

	public function test_from_native()
	{
		$url = Url::fromNative('https://www.academyhq.com:8080/admin?member=abc&org=def#fragment');

		$this->assertEquals($url->get_user()->toNative(), '');
		$this->assertEquals($url->get_pass()->toNative(), '');
		$this->assertEquals($url->get_scheme()->toNative(), 'https');
		$this->assertEquals($url->get_host()->toNative(), 'www.academyhq.com');
		$this->assertEquals($url->get_port()->toNative(), 8080);
		$this->assertEquals($url->get_path()->toNative(), '/admin');
		$this->assertEquals($url->get_query_string()->toNative(), '?member=abc&org=def');
		$this->assertEquals($url->get_fragment()->toNative(), '#fragment');

	}

	public function test_get_url() {

		$url = Url::fromNative('https://kuragai:password@www.academyhq.com:8080/admin?member=abc&org=def#fragment');

		$this->assertEquals($url->__toString(), 'https://kuragai:password@www.academyhq.com:8080/admin?member=abc&org=def#fragment');

		$url = Url::fromNative('http://www.olivemedia.co');

		$this->assertEquals($url->__toString(), 'http://www.olivemedia.co');

		$url = Url::fromNative('https://sandbox.hiho.olive.media:443');

		$this->assertEquals($url->__toString(), 'https://sandbox.hiho.olive.media:443');
	}
}