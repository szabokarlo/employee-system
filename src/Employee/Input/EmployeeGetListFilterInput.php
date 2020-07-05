<?php

declare(strict_types=1);

namespace App\Employee\Input;

class EmployeeGetListFilterInput
{
    private string $column;
    private string $value;

    public function __construct(
        string $column,
        string $value
    ) {
        $this->column = $column;
        $this->value  = $value;
    }

    public function getColumn(): string
    {
        return $this->column;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
