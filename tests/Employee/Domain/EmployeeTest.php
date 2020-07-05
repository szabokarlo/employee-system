<?php

declare(strict_types=1);

namespace Tests\Employee\Domain;

use App\Employee\Domain\Employee;
use App\Employee\Domain\EmployeeCollection;
use ArrayIterator;
use PHPUnit\Framework\TestCase;

class EmployeeTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $id          = 10;
        $firstName   = 'firstName';
        $lastName    = 'lastName';
        $gender      = 'M';
        $birthDate   = '2010-01-01';
        $hireDate    = '2011-02-14';
        $department  = 'Development';
        $position    = 'Developer';
        $salary      = 134341;

        $sut = new Employee(
            $id,
            $firstName,
            $lastName,
            $gender,
            $birthDate,
            $hireDate,
            $department,
            $position,
            $salary
        );

        $this->assertEquals($id, $sut->getId());
        $this->assertEquals($firstName, $sut->getFirstName());
        $this->assertEquals($lastName, $sut->getLastName());
        $this->assertEquals($gender, $sut->getGender());
        $this->assertEquals($birthDate, $sut->getBirthDate());
        $this->assertEquals($hireDate, $sut->getHireDate());
        $this->assertEquals($department, $sut->getDepartment());
        $this->assertEquals($position, $sut->getPosition());
        $this->assertEquals($salary, $sut->getSalary());

        $newFirstName = 'newFirstName';
        $newLastName  = 'newLastName';
        $newGender    = 'F';
        $newBirthDate = '2010-02-04';
        $newHireDate  = '2017-06-09';

        $sut->setFirstName($newFirstName)
            ->setLastName($newLastName)
            ->setGender($newGender)
            ->setBirthDate($newBirthDate)
            ->setHireDate($newHireDate);

        $this->assertEquals($newFirstName, $sut->getFirstName());
        $this->assertEquals($newLastName, $sut->getLastName());
        $this->assertEquals($newGender, $sut->getGender());
        $this->assertEquals($newBirthDate, $sut->getBirthDate());
        $this->assertEquals($newHireDate, $sut->getHireDate());
    }
}
