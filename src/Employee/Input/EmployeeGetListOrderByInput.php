<?php

declare(strict_types=1);

namespace App\Employee\Input;

class EmployeeGetListOrderByInput
{
    private string $column;
    private string $direction;

    public function __construct(
        string $column,
        string $direction
    ) {
        $this->column    = $column;
        $this->direction = $direction;
    }

    public function getColumn(): string
    {
        return $this->column;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }
}
