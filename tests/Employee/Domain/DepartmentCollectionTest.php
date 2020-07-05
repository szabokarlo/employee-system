<?php

declare(strict_types=1);

namespace Tests\Employee\Domain;

use App\Employee\Domain\Department;
use App\Employee\Domain\DepartmentCollection;
use ArrayIterator;
use PHPUnit\Framework\TestCase;

class DepartmentCollectionTest extends TestCase
{
    public function testArrayIterator()
    {
        $sut = new DepartmentCollection();

        $this->assertInstanceOf(ArrayIterator::class, $sut->getIterator());
    }

    public function testAdd()
    {
        /** @var Department $department1 */
        $department1 = $this->getMockBuilder(Department::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var Department $department2 */
        $department2 = $this->getMockBuilder(Department::class)
            ->disableOriginalConstructor()
            ->getMock();

        $sut = new DepartmentCollection();
        $sut->add($department1);
        $sut->add($department2);

        $iterator = $sut->getIterator();

        $this->assertEquals($department1, $iterator->current());
        $iterator->next();
        $this->assertEquals($department2, $iterator->current());
    }
}
