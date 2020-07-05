<?php

declare(strict_types=1);

namespace App\Employee\Repository;

use App\Employee\Domain\EmployeeCollection;
use App\Employee\Input\EmployeeGetListInput;
use App\Employee\Mapper\EmployeeMapper;
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

        $employeeNameFilter = $filters->getFilterByColumn(EmployeeGetListInput::FILTER_COLUMN_EMPLOYEE_NAME);
        if ($employeeNameFilter) {
            $whereConditions[] = 'CONCAT(e.first_name, " ", e.last_name) LIKE CONCAT("%", ?, "%")';
            $parameters[]      = $employeeNameFilter->getValue();
        }

        $departmentNameFilter = $filters->getFilterByColumn(EmployeeGetListInput::FILTER_COLUMN_DEPARTMENT_NAME);
        if ($departmentNameFilter) {
            $whereConditions[] = 'd.dept_name = ?';
            $parameters[]      = $departmentNameFilter->getValue();
        }

        $where = '';

        if ($whereConditions) {
            $where = 'WHERE ' . implode('AND ', $whereConditions);
        }

        $statement = $this->dbConnection->prepare("
            SELECT 
                e.*, cde.from_date, cde.to_date, d.dept_no, d.dept_name
            FROM
                employees AS e
            LEFT JOIN current_dept_emp AS cde ON cde.emp_no = e.emp_no
            LEFT JOIN departments AS d ON d.dept_no = cde.dept_no
            $where
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
}
