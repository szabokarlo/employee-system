<?php

declare(strict_types=1);

namespace App\Employee\Domain;

class CurrentDepartment
{
    private Department $department;
    private string $fromDate;
    private string $toDate;

    public function __construct(
        Department $department,
        string $fromDate,
        string $toDate
    ) {
        $this->department = $department;
        $this->fromDate   = $fromDate;
        $this->toDate     = $toDate;
    }

    public function getDepartment(): Department
    {
        return $this->department;
    }

    public function getFromDate(): string
    {
        return $this->fromDate;
    }

    public function getToDate(): string
    {
        return $this->fromDate;
    }
}
