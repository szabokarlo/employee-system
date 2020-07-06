<?php

declare(strict_types=1);

namespace App\Employee\Input;

use InvalidArgumentException;
use Webmozart\Assert\Assert;

class EmployeeUpdateInput
{
    public const KEY_BIRTH_DATE = 'birth_date';
    public const KEY_FIRST_NAME = 'first_name';
    public const KEY_LAST_NAME  = 'last_name';
    public const KEY_GENDER     = 'gender';
    public const KEY_HIRE_DATE  = 'hire_date';

    private string $birthDate;
    private string $firstName;
    private string $lastName;
    private string $gender;
    private string $hireDate;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(array $postParameters) {

        Assert::keyExists($postParameters, self::KEY_BIRTH_DATE, 'The birth_date key should be defined.');
        Assert::keyExists($postParameters, self::KEY_FIRST_NAME, 'The first_name key should be defined.');
        Assert::keyExists($postParameters, self::KEY_LAST_NAME, 'The last_name key should be defined.');
        Assert::keyExists($postParameters, self::KEY_GENDER, 'The gender key should be defined.');
        Assert::keyExists($postParameters, self::KEY_HIRE_DATE, 'The hire_date key should be defined.');

        //some another validations should be required here

        $this->birthDate = $postParameters[self::KEY_BIRTH_DATE];
        $this->firstName = $postParameters[self::KEY_FIRST_NAME];
        $this->lastName  = $postParameters[self::KEY_LAST_NAME];
        $this->gender    = $postParameters[self::KEY_GENDER];
        $this->hireDate  = $postParameters[self::KEY_HIRE_DATE];
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
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

    public function getHireDate(): string
    {
        return $this->hireDate;
    }
}
