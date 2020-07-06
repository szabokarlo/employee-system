<?php

declare(strict_types=1);

namespace Tests\Employee\Input;

use App\Employee\Input\EmployeeGetListFilterInput;
use Exception;
use PHPUnit\Framework\TestCase;

class EmployeeGetListFilterInputTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testGetters()
    {
        $column = 'column';
        $value  = 'value';

        $sut = new EmployeeGetListFilterInput($column, $value);

        $this->assertEquals($column, $sut->getColumn());
        $this->assertEquals($value, $sut->getValue());
    }
}
