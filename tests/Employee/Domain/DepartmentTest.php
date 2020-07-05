<?php

declare(strict_types=1);

namespace Tests\Employee\Domain;

use App\Employee\Domain\Department;
use PHPUnit\Framework\TestCase;

class DepartmentTest extends TestCase
{
    public function testGetters()
    {
        $id   = 'id';
        $name = 'name';

        $sut = new Department($id, $name);

        $this->assertEquals($id, $sut->getId());
        $this->assertEquals($name, $sut->getName());
    }
}
