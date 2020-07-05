<?php

declare(strict_types=1);

namespace App\Employee\Input;

use ArrayIterator;

class EmployeeGetListFilterCollectionInput extends ArrayIterator
{
    private array $filters = [];

    public function add(EmployeeGetListFilterInput $filter): self
    {
        $this->filters[$filter->getColumn()] = $filter;

        return $this;
    }

    public function getFilterByColumn(string $columnName): ?EmployeeGetListFilterInput
    {
        return isset($this->filters[$columnName])
            ? $this->filters[$columnName]
            : null;
    }
}
