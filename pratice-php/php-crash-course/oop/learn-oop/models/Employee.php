<?php
declare(strict_types=1);

require_once 'User.php';

/**
 * Employee entity class demonstrating inheritance and polymorphism
 */
class Employee extends User
{
    private float $salary;
    private string $department;

    /**
     * Employee constructor
     * @param string $name
     * @param string $email
     * @param int $age
     * @param string $password
     * @param float $salary
     * @param string $department
     * @param string $role
     * @throws InvalidArgumentException
     */
    public function __construct(
        string $name,
        string $email,
        int $age,
        string $password,
        float $salary,
        string $department,
        string $role = 'employee'
    ) {
        parent::__construct($name, $email, $age, $password, $role);
        $this->salary = $this->validateSalary($salary);
        $this->department = $department;
    }

    /**
     * Validate salary
     * @param float $salary
     * @return float
     * @throws InvalidArgumentException
     */
    private function validateSalary(float $salary): float
    {
        if ($salary < 0) {
            throw new InvalidArgumentException('Salary cannot be negative');
        }
        return $salary;
    }

    /**
     * Polymorphic method override
     * @return bool
     */
    public function validate(): bool
    {
        return parent::validate() && $this->salary > 0;
    }

    /**
     * String representation
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('Employee[id=%d, name=%s, department=%s]', $this->getId(), $this->getName(), $this->department);
    }

    // Getters and setters
    public function getSalary(): float { return $this->salary; }
    public function getDepartment(): string { return $this->department; }
    public function setSalary(float $salary): void { $this->salary = $this->validateSalary($salary); }
}