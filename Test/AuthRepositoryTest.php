<?php

use PHPUnit\Framework\TestCase;
use AcademyHQ\API\Repository\Factory;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\OMA\AlacrityGroupAdminRepository;

use AcademyHQ\API\ValueObjects as VO;

final class AuthRepositoryTest extends TestCase
{
    protected $_token;
    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }
    
    public function setUp()
    {
        parent::setUp();
        $_SERVER['HTTP_HOST']='localhost';
        $this->credentials = new Credentials(new VO\AppID('AAAAA0101010101AAAAA'), new VO\SecretKey('AAAAA010101010101010101010101010101AAAAA'));
        $this->factory = new Factory($this->credentials);
        $this->repo = $this->factory->get_auth_repository(); //this is bit different than OMA repos access via facatories, seek help if need
    }
    
    public function tearDown()
    {
        parent::tearDown();
    }

    public function testLogin()
    {
        $login = $this->repo->login(new VO\Username('alacrity'), new VO\Password('pp'));
        echo $login->token;
        $this->assertEquals('Success', $login->status);
        $this->assertEquals('alacrity', $login->member_details->username);
        $this->assertNotNull($login->token);
    }

    // public function testLoginToAcademy()
    // {
    //     $login = $this->repo->login_to_academy(new VO\Username('omaemp01'), new VO\Password('pp'));

    //     $this->assertEquals('Success', $login->status);
    //     $this->assertEquals('omaemp01', $login->member_details->username);
    //     $this->assertNotNull($login->token);
    // }

    // public function testLoginFromEmail()
    // {
    //     $login = $this->repo->login_from_email(new VO\Email('omaemp01@yopmail.com'), new VO\Password('pp'));

      
    //     $this->assertEquals('Success', $login->status);
    //     $this->assertEquals('omaemp01@yopmail.com', $login->member_details->email);
    //     $this->assertNotNull($login->token);
    // }

    //be wise when testing logou
    // public function testLogout(){
    //     $logout = $this->repo->logout(new VO\Token('0fb802d08342ca68b29e7c9972e1d86d'));
    //     $this->assertEquals('Success', $logout->status);
    //     $this->assertEquals('Logout Successful', $logout->message);
    // }
}
