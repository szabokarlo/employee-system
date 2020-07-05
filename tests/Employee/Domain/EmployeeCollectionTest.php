<?php

declare(strict_types=1);

namespace Tests\Employee\Domain;

use App\Employee\Domain\Employee;
use App\Employee\Domain\EmployeeCollection;
use ArrayIterator;
use PHPUnit\Framework\TestCase;

class EmployeeCollectionTest extends TestCase
{
    public function testArrayIterator()
    {
        $sut = new EmployeeCollection();

        $this->assertInstanceOf(ArrayIterator::class, $sut->getIterator());
    }

    public function testAdd()
    {
        /** @var Employee $employee1 */
        $employee1 = $this->getMockBuilder(Employee::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var Employee $employee2 */
        $employee2 = $this->getMockBuilder(Employee::class)
            ->disableOriginalConstructor()
            ->getMock();

        $sut = new EmployeeCollection();
        $sut->add($employee1);
        $sut->add($employee2);

        $iterator = $sut->getIterator();

        $this->assertEquals($employee1, $iterator->current());
        $iterator->next();
        $this->assertEquals($employee2, $iterator->current());
    }
}
