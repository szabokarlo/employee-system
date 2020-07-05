<?php

declare(strict_types=1);

namespace App\Employee\Repository;

use App\Employee\Domain\EmployeeCollection;
use App\Employee\Input\EmployeeGetListInput;
use App\Employee\Mapper\EmployeeMapper;
use InvalidArgumentException;
use PDO;

class EmployeeRepository
{
    private PDO $dbConnection;
    private EmployeeMapper $employeeMapper;

    public function __construct(PDO $dbConnection, EmployeeMapper $employeeMapper)
    {
        $this->dbConnection   = $dbConnection;
        $this->employeeMapper = $employeeMapper;
    }

    public function getList(EmployeeGetListInput $input): EmployeeCollection
    {
        $recordsPerPage = $input->getRecordsPerPage();
        $offset         = ($input->getPage() - 1) * $recordsPerPage;

        $filters = $input->getFilters();

        $whereConditions = [];
        $parameters      = [];

        $employeeNameFilter = $filters->getFilterByColumn(EmployeeGetListInput::COLUMN_EMPLOYEE_NAME);
        if ($employeeNameFilter) {
            $whereConditions[] = $this->getDatabaseColumnByInput(EmployeeGetListInput::COLUMN_EMPLOYEE_NAME) . ' LIKE CONCAT("%", ?, "%")';
            $parameters[]      = $employeeNameFilter->getValue();
        }

        $departmentNameFilter = $filters->getFilterByColumn(EmployeeGetListInput::COLUMN_DEPARTMENT_NAME);
        if ($departmentNameFilter) {
            $whereConditions[] = $this->getDatabaseColumnByInput(EmployeeGetListInput::COLUMN_DEPARTMENT_NAME) . ' = ?';
            $parameters[]      = $departmentNameFilter->getValue();
        }

        $positionNameFilter = $filters->getFilterByColumn(EmployeeGetListInput::COLUMN_POSITION_NAME);
        if ($positionNameFilter) {
            $whereConditions[] = $this->getDatabaseColumnByInput(EmployeeGetListInput::COLUMN_POSITION_NAME) . ' = ?';
            $parameters[]      = $positionNameFilter->getValue();
        }

        $where = '';

        if ($whereConditions) {
            $where = 'WHERE ' . implode('AND ', $whereConditions);
        }

        $orderBy = $input->getOrderBy();
        if ($orderBy) {
            $orderBy = 'ORDER BY ' . $this->getDatabaseColumnByInput($orderBy->getColumn()) . ' ' . $orderBy->getDirection();
        }

        $statement = $this->dbConnection->prepare("
            SELECT 
                e.*, cde.from_date, cde.to_date, d.dept_no, d.dept_name, cet.title, ces.salary
            FROM
                employees AS e
            LEFT JOIN current_dept_emp AS cde ON cde.emp_no = e.emp_no
            LEFT JOIN departments AS d ON d.dept_no = cde.dept_no
            LEFT JOIN current_employee_title AS cet ON cet.emp_no = e.emp_no
            LEFT JOIN current_employee_salary AS ces ON ces.emp_no = e.emp_no
            $where
            $orderBy
            LIMIT $offset, $recordsPerPage
        ");

        $statement->execute($parameters);

        $employees = $statement->fetchAll();

        return $this->employeeMapper->toCollection($employees);
    }

    public function delete(int $id)
    {
        $statement = $this->dbConnection->prepare("
            DELETE
            FROM
                employees
            WHERE 
                emp_no = ?
        ");

        $statement->execute([$id]);
    }

    /**
     * @throws InvalidArgumentException
     */
    private function getDatabaseColumnByInput(string $inputColumnName): string
    {
        switch ($inputColumnName) {
            case EmployeeGetListInput::COLUMN_DEPARTMENT_NAME:
                return 'd.dept_name';

                break;
            case EmployeeGetListInput::COLUMN_EMPLOYEE_NAME:
                return 'CONCAT(e.first_name, " ", e.last_name)';

                break;

            case EmployeeGetListInput::COLUMN_POSITION_NAME:
                return 'cet.title';

                break;

            default:
                throw new InvalidArgumentException('Unsupported column name. Got ' . $inputColumnName);
        }
    }
}
