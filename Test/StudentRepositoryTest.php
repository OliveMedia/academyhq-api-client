<?php

use PHPUnit\Framework\TestCase;
use AcademyHQ\API\Repository\Factory;
use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\Repository\OMA\StudentRepository;

use AcademyHQ\API\ValueObjects as VO;

final class StudentRepositoryTest extends TestCase
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
        $this->repo = $this->factory->get_oma_repository('Student');
        $_SERVER['HTTP_HOST']='localhost';
    }

    public function tearDown()
    {
        parent::tearDown();
    }


    public function testlistStudent()
    {
        $student_list_member = $this->repo->list_member_apprenticeship(
            new VO\Token('f99208b802494daa')
        //new VO\Integer(1)
        );
    }
}
