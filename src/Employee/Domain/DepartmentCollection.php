<?php

declare(strict_types=1);

namespace App\Employee\Domain;

use ArrayIterator;

class DepartmentCollection extends ArrayIterator
{
    private array $departments = [];

    public function add(Department $department): self
    {
        $this->departments[] = $department;

        return $this;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->departments);
    }
}
