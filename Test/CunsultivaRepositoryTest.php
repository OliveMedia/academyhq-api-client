<?php

use PHPUnit\Framework\TestCase;
use AcademyHQ\API\Repository\Factory;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\OMA\ConsultivaAdminRepository;

use AcademyHQ\API\ValueObjects as VO;

final class CunsultivaRepositoryTest extends TestCase
{
    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }
    
    public function setUp()
    {
        parent::setUp();
        $this->credentials = new Credentials(new VO\AppID('AAAAA0101010101AAAAA'), new VO\SecretKey('AAAAA010101010101010101010101010101AAAAA'));
        $this->factory = new Factory($this->credentials);
        $this->repo = $this->factory->get_oma_repository('ConsultivaAdmin');
    }
    
    public function tearDown()
    {
        parent::tearDown();
    }

    public function testCreateCunsultiva()
    {
        $employer = $this->repo->createCunsultiva(
             new VO\Token("45da55f3fc3fec29eb8d3480fd29c508"),
             new VO\ApprenticeshipID('125425AVC'),
             new VO\OrganisationID('1254asdfsf25AVC'),
             new VO\Name(new VO\StringVO('suman'), new VO\StringVO('ghimire')),
             new VO\StringVO('1254asdfsf25AVC'),
             new VO\StringVO('1254asdfsf25AVC'),
             new VO\Integer(123456459),
             new VO\Email('sumanghaaimaaaire@yopmailaa.com'),
             new VO\StringVO('1254asdfsf25AVC'),
             new VO\Integer(123456459),
             new VO\StringVO('asdfasdfsadfasfdsafdasdf'),
             new VO\StringVO('123123 kathmandu'),
             new VO\StringVO('heafasdfasfda'),
             new VO\StringVO('heafasdfasfda'),
             new VO\StringVO('heafasdfasfda'),
             new VO\Integer(1234545),
             new VO\StringVO('heafasdfasfda'),
             new VO\StringVO('heafasdfasfda'),
             new VO\StringVO('heafasdfasfda'),
             new VO\StringVO('heafasdfasfda')


         );

        $this->assertEquals('suman', $employer->member_details->first_name);
        $this->assertEquals('ghimire', $employer->member_details->last_name);
        $this->assertEquals('sumanghaaimaaaire@yopmailaa.com', $employer->member_details->email);
    }
}
