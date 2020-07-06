<?php

declare(strict_types=1);

namespace Tests\Employee\Input;

use App\Employee\Input\EmployeeGetListOrderByInput;
use PHPUnit\Framework\TestCase;

class EmployeeGetListOrderByInputTest extends TestCase
{
    public function testGetters()
    {
        $column    = 'column';
        $direction = 'direction';

        $sut = new EmployeeGetListOrderByInput($column, $direction);

        $this->assertEquals($column, $sut->getColumn());
        $this->assertEquals($direction, $sut->getDirection());
    }
}
