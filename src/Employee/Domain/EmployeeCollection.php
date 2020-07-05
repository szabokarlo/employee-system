<?php

declare(strict_types=1);

namespace App\Employee\Domain;

use ArrayIterator;

class EmployeeCollection extends ArrayIterator
{
    private array $employees = [];

    public function add(Employee $employee): self
    {
        $this->employees[] = $employee;

        return $this;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->employees);
    }
}
