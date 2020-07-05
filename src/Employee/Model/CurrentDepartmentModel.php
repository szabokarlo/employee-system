<?php

declare(strict_types=1);

namespace App\Employee\Model;

use App\Employee\Domain\CurrentDepartment;
use JsonSerializable;

class CurrentDepartmentModel implements JsonSerializable
{
    private CurrentDepartment $currentDepartment;

    public function __construct(CurrentDepartment $currentDepartment)
    {
        $this->currentDepartment = $currentDepartment;
    }

    public function jsonSerialize(): array
    {
        return [
            'department' => new DepartmentModel($this->currentDepartment->getDepartment()),
            'from_date'  => $this->currentDepartment->getFromDate(),
            'to_date'    => $this->currentDepartment->getToDate(),
        ];
    }
}
