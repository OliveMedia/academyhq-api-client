<?php

use PHPUnit\Framework\TestCase;
use AcademyHQ\API\Repository\Factory;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\OMA\AlacrityGroupAdminRepository;

use AcademyHQ\API\ValueObjects as VO;

final class AlacrityGroupAdminTest extends TestCase
{
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
        $this->repo = $this->factory->get_oma_repository('AlacrityGroupAdmin');
    }
    
    public function tearDown()
    {
        parent::tearDown();
    }


//    public function testListEmployer(){
//        $employeer = $this->repo->ListEmployer(new VO\Token("45da55f3fc3fec29eb8d3480fd29c508"), new VO\StringVO(''), new VO\Integer(1));

//        $this->assertEquals(10, count($employeer->organisations_details));
//        $this->assertEquals('Success', $employeer->status);

//    }

//    public function testListApprenticeship(){
//        $apprenticeship = $this->repo->listApprenticeship(new VO\Token("4156c394a37a81aee1cb1aa59dd9c248"), new VO\StringVO(''), new VO\Integer(1));

//        $this->assertEquals(10, count($apprenticeship->apprenticeships_details));
//        $this->assertEquals('Success', $apprenticeship->status);


//    }
//
//    public function testListOccupation()
//    {
//        $occupation = $this->repo->listOccupation(new VO\Token("45da55f3fc3fec29eb8d3480fd29c508"), new VO\StringVO(''), null, new VO\Integer(1));
//
//        $this->assertEquals(2, count($occupation->occupations_details));
//        $this->assertEquals('Success', $occupation->status);
//        $this->assertEquals('OMAOcc2', $occupation->occupations_details[0]->name);
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

    // public function testCreateApprenticeship()
    // {
    //     $apprenticeship = $this->repo->createApprenticeship(
    //         new VO\Token('7d11c89fe6cf866893ed3a962e3b07b8'),
    //         new VO\OrganisationID(2954),
    //         new VO\OccupationID(1),
    //         new VO\MemberID(30648)
    //     );
    // }


    public function testCreateOccupation()
    {
        $apprenticeship = $this->repo->createOccupation(
             new VO\Token('36d89f960a7d82af692fa673a01ae72d'),
             new VO\StringVO('Suman Testing Program Two'),
             new VO\StringVO('Suman Testing Program description is this'),
              new VO\StringVO('http://www.telodicoio.org/wp-content/uploads/2015/02/ROSABLU.jpg')

         );
    }

//    public function testListLicence()
//    {
//        $listLicence = $this->repo->listLicence(new VO\Token("761de76b56c1d10285eae6c5d0be3152"), new VO\StringVO(''), new VO\Integer(1));
//    }

    // public function testListAuditForm()
    // {
    //     $listAudit = $this->repo->listAudit(new VO\Token("59c8c913ea14d851cb838d6279eb4587"), new VO\StringVO(''), new VO\Integer(1));
    // }

    // public function testCreateProgram()
    // {
    //     $program = $this->repo->createProgram(
    //         new VO\Token('bb3a991cf14dbc42cee9b5f1ab708d9c'),
    //         new VO\StringVO('Suman Testing Program phase '),
    //         new VO\StringVO('Suman Testing Program phase description '),
    //         new VO\StringVO('12-12-2018'),
    //         new VO\StringVO('12-12-2019')
            
    //     );
    // }


    // public function testCreateOccupationProgram()
    // {
    //     $Occupationprogram = $this->repo->createOccupationProgram(
    //         new VO\Token('bb3a991cf14dbc42cee9b5f1ab708d9c'),
    //         new VO\Integer(5),
    //         new VO\Integer(1)
    //     );
    // }

    // public function testCreateProgramCourse()
    // {
    //     $programCourse = $this->repo->createProgramCourse(
    //         new VO\Token('bb3a991cf14dbc42cee9b5f1ab708d9c'),
    //         new VO\Integer(1),
    //         new VO\CourseIDArray(array(new VO\CourseID(1), new VO\CourseID(2)))
    //     );
    // }


    // public function testCreateProgramAudit()
    // {
    //     $programAudit = $this->repo->createProgramAudit(
    //         new VO\Token('59c8c913ea14d851cb838d6279eb4587'),
    //         new VO\Integer(1),
    //         new VO\IntegerArray(array(new VO\IDs(224)))
    
    //     );
    // }


    // public function testCreateProgramUnit()
    // {
    //     $programUnit = $this->repo->createProgramUnit(
    //         new VO\Token('59c8c913ea14d851cb838d6279eb4587'),
    //         new VO\StringVO('this is testing program unit'),
    //         new VO\StringVO('this is header'),
    //         new VO\StringVO('this is description'),
    //         new VO\Integer(1),
    //         new VO\Integer(1),
    //         new VO\Integer(1),
    //         new VO\Integer(1),
    //         new VO\Integer(1)
    //     );
    // }


    // public function testCreateProgramWelcomeResource()
    // {
    //     $programUnit = $this->repo->createProgramWelcomeResource(
    //         new VO\Token('555e384c37af2fabce36ae74487ef87d'),
    //         new VO\StringVO('this is welcomeResourceProgram'),
    //         new VO\Integer(1),
    //         new VO\StringVO('sdfasdfasdfasd'),
    //         new VO\StringVO('tthi is description'),
    //         new VO\StringVO('https://google.com')
           
    //     );
    // }
}
