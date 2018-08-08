<?php

use PHPUnit\Framework\TestCase;
use AcademyHQ\API\Repository\Factory;
use AcademyHQ\API\Common\Credentials; 
use AcademyHQ\API\Repository\OMA\AlacrityGroupAdminRepository;

use AcademyHQ\API\ValueObjects as VO;


final class AlacrityGroupAdminTest extends TestCase
{   
    public function __construct($name = NULL, array $data = array(), $dataName = '') {
        parent::__construct($name, $data, $dataName);
    }
    
    public function setUp() {
        parent::setUp();
        $this->credentials = new Credentials(new VO\AppID('AAAAA0101010101AAAAA'),new VO\SecretKey('AAAAA010101010101010101010101010101AAAAA'));
        $this->factory = new Factory($this->credentials);
        $this->repo = $this->factory->get_oma_repository('AlacrityGroupAdmin');
    }
    
    public function tearDown() {
        parent::tearDown();
    }


//    public function testListEmployer(){
//        $employeer = $this->repo->ListEmployer(new VO\Token("45da55f3fc3fec29eb8d3480fd29c508"), new VO\StringVO(''), new VO\Integer(1));
//
//        $this->assertEquals(10, count($employeer->organisations_details));
//        $this->assertEquals('Success', $employeer->status);
//
//    }
//
//    public function testListApprenticeship(){
//        $apprenticeship = $this->repo->listApprenticeship(new VO\Token("45da55f3fc3fec29eb8d3480fd29c508"), new VO\StringVO(''), new VO\Integer(1));
//
//        $this->assertEquals(10, count($apprenticeship->apprenticeships_details));
//        $this->assertEquals('Success', $apprenticeship->status);
//
//
//    }
//
//    public function testListOccupation(){
//        $occupation = $this->repo->listOccupation(new VO\Token("45da55f3fc3fec29eb8d3480fd29c508"), new VO\StringVO(''), new VO\Integer(1));
//
//        $this->assertEquals(2, count($occupation->occupations_details));
//        $this->assertEquals('Success', $occupation->status);
//        $this->assertEquals('OMAOcc2', $occupation->occupations_details[0]->name);
//
//
//    }

//     public function testCreateEmployer(){
//         $employer = $this->repo->create_employer(
//             new VO\Token("45da55f3fc3fec29eb8d3480fd29c508"),
//             new VO\Email('viperto1@yopmail.com'),
//             new VO\StringVO('test employer'),
//             new VO\Name(new VO\StringVO('Testfirst'), new VO\StringVO('TestLast')),
//             new VO\TaxNumber('125425AVC')
//
//         );
//
//          $this->assertEquals('viperto1@yopmail.com', $employer->member_details->email);
//          $this->assertEquals('Testfirst', $employer->member_details->first_name);
//          $this->assertEquals('TestLast', $employer->member_details->last_name);
//
//          $this->assertEquals('125425AVC', $employer->organisation_details->vat_number);
//          $this->assertEquals('test employer', $employer->organisation_details->name);
//     }

     public function testCreateApprenticeship(){
         $apprenticeship = $this->repo->createApprenticeship(
             new VO\Token('45da55f3fc3fec29eb8d3480fd29c508'),
             new VO\OrganisationID (2954),
             new VO\OccupationID (1),
             new VO\MemberID (30648)
         );

     }

    
}
