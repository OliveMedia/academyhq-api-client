<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use \Mockery as m;
use AcademyHQ\API\ValueObjects\Name;
use AcademyHQ\API\ValueObjects\String;
use AcademyHQ\API\ValueObjects\Exception\InvalidValueObjectsArgumentException;

class NameTest extends PHPUnit_Framework_TestCase
{
	public function setup() 
	{

		$this->name = new Name(new String('First_Name'), new String('Last_Name'));
	}
	public function tearDown() 
	{
		m::close();
	}

	public function test_from_native() 
	{

		$name = Name::fromNative('Kiran', 'Guragai');

		$this->assertEquals($name->get_first_name(), 'Kiran');
		$this->assertEquals($name->get_last_name(), 'Guragai');
	}

	public function test_getters() 
	{

		$this->assertEquals($this->name->get_first_name(), 'First_Name');
		$this->assertEquals($this->name->get_last_name(), 'Last_Name');
		$this->assertEquals($this->name->get_full_name(), 'First_Name Last_Name');
		$this->assertEquals($this->name->__toString(), 'First_Name Last_Name');
	}
}