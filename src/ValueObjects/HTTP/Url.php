<?php

namespace AcademyHQ\API\ValueObjects\HTTP;

use AcademyHQ\API\ValueObjects\String;
use AcademyHQ\API\ValueObjects\Integer;
use AcademyHQ\API\ValueObjects\HTTP\Host;
use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class Url 
{
	public static function fromNative()
	{
		$url_string = \func_get_arg(0);

		$scheme 	 = \parse_url($url_string, PHP_URL_SCHEME);
        $user        = \parse_url($url_string, PHP_URL_USER);
        $pass        = \parse_url($url_string, PHP_URL_PASS);
        $host        = \parse_url($url_string, PHP_URL_HOST);
        $query_string = \parse_url($url_string, PHP_URL_QUERY);
        $fragment  	= \parse_url($url_string, PHP_URL_FRAGMENT);
        $port        = \parse_url($url_string, PHP_URL_PORT);
        $path       = \parse_url($url_string, PHP_URL_PATH);

        return new self(
        	new String($scheme ? $scheme : ''), 
        	new String($user ? $user : ''), 
        	new String($pass ? $pass : ''), 
        	new Host($host ? $host : ''), 
        	new Integer($port ? $port : null), 
        	new String($path ? $path : ''), 
        	new String($query_string ? '?'.$query_string : ''), 
        	new String($fragment ? '#'.$fragment : '')
        );
	}

	public function __construct(
		String $scheme,
		String $user,
		String $pass,
		Host $host,
		Integer $port,
		String $path,
		String $query_string,
		String $fragment
	)
	{
		$this->scheme = $scheme;
        $this->user = $user;
        $this->pass = $pass;
        $this->host = $host;
        $this->path = $path;
        $this->port = $port;
        $this->query_string = $query_string;
        $this->fragment = $fragment;
	}

	public function get_scheme()
	{
		return $this->scheme;
	}

	public function get_user()
	{
		return $this->user;
	}

	public function get_pass()
	{
		return $this->pass;
	}

	public function get_path()
	{
		return $this->path;
	}

	public function get_port()
	{
		return $this->port;
	}

	public function get_query_string()
	{
		return $this->query_string;
	}

	public function get_host()
	{
		return $this->host;
	}

	public function get_fragment()
	{
		return $this->fragment;
	}

	/**
     * Returns a string representation of the url
     *
     * @return string
     */

	 public function __toString()
    {
        $user_pass = '';
        if (false === $this->get_user()->isEmpty()) {
            $user_pass = \sprintf('%s@', $this->get_user()->toNative());

            if (false === $this->get_pass()->isEmpty()) {
                $user_pass = \sprintf('%s:%s@', $this->get_user()->toNative(), $this->get_pass()->toNative());
            }
        }

        $port = '';
        if ($this->get_port()->toNative()) {
            $port = \sprintf(':%d', $this->get_port()->toNative());
        }

        $url_string = \sprintf('%s://%s%s%s%s%s%s', 
        	$this->get_scheme()->toNative(), 
        	$user_pass, 
        	$this->get_host()->toNative(), 
        	$port, 
        	$this->get_path()->toNative(), 
        	$this->get_query_string()->toNative(), 
        	$this->get_fragment()->toNative()
        );

        return $url_string;
    }
}