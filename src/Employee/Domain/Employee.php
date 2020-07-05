<?php

declare(strict_types=1);

namespace App\Employee\Domain;

class Employee
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $gender;
    private string $birthDate;
    private string $hireDate;
    private string $department;
    private string $position;
    private int $salary;

    public function __construct(
        int $id,
        string $firstName,
        string $lastName,
        string $gender,
        string $birthDate,
        string $hireDate,
        string $department,
        string $position,
        int $salary
    ) {
        $this->id         = $id;
        $this->firstName  = $firstName;
        $this->lastName   = $lastName;
        $this->gender     = $gender;
        $this->birthDate  = $birthDate;
        $this->hireDate   = $hireDate;
        $this->department = $department;
        $this->position   = $position;
        $this->salary     = $salary;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function getHireDate(): string
    {
        return $this->birthDate;
    }

    public function getDepartment(): string
    {
        return $this->department;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function getSalary(): int
    {
        return $this->salary;
    }
}
