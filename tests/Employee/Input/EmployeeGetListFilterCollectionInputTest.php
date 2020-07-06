<?php

declare(strict_types=1);

namespace Tests\Employee\Input;

use App\Employee\Input\EmployeeGetListFilterCollectionInput;
use App\Employee\Input\EmployeeGetListFilterInput;
use Exception;
use PHPUnit\Framework\TestCase;

class EmployeeGetListFilterCollectionInputTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testGetFilterByColumn()
    {
        $filter1Column = 'filter1';

        $filter1 = $this->createMock(EmployeeGetListFilterInput::class);

        $filter1->expects($this->once())
            ->method('getColumn')
            ->willReturn($filter1Column);

        $filter2Column = 'filter2';

        $filter2 = $this->createMock(EmployeeGetListFilterInput::class);

        $filter2->expects($this->once())
            ->method('getColumn')
            ->willReturn($filter2Column);

        $sut = new EmployeeGetListFilterCollectionInput();

        $sut->add($filter1);
        $sut->add($filter2);

        $this->assertSame($filter1, $sut->getFilterByColumn($filter1Column));
        $this->assertSame($filter2, $sut->getFilterByColumn($filter2Column));
        $this->assertEquals(null, $sut->getFilterByColumn('undefined'));

    }
}

