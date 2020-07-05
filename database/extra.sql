USE employees;

CREATE OR REPLACE VIEW employee_title_latest_date AS
    SELECT emp_no, MAX(from_date) AS from_date, MAX(to_date) AS to_date
    FROM titles
    GROUP BY emp_no;

# shows only the current title for each employee
CREATE OR REPLACE VIEW current_employee_title AS
    SELECT t.emp_no, t.title, l.from_date, l.to_date
    FROM titles t
        INNER JOIN employee_title_latest_date l
        ON t.emp_no=l.emp_no AND t.from_date=l.from_date AND t.to_date = l.to_date;

CREATE OR REPLACE VIEW employee_salary_latest_date AS
    SELECT emp_no, MAX(from_date) AS from_date, MAX(to_date) AS to_date
    FROM salaries
    GROUP BY emp_no;

# shows only the current salary for each employee
CREATE OR REPLACE VIEW current_employee_salary AS
    SELECT s.emp_no, s.salary, l.from_date, l.to_date
    FROM salaries s
        INNER JOIN employee_salary_latest_date l
        ON s.emp_no=l.emp_no AND s.from_date=l.from_date AND s.to_date = l.to_date;
