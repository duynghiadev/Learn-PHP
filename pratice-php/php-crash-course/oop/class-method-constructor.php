<?php
declare(strict_types=1);

/**
 * Professional OOP Implementation in PHP
 * Features:
 * - Type declarations
 * - Visibility modifiers
 * - Static members
 * - Encapsulation
 * - Inheritance
 * - Polymorphism
 * - Magic methods
 * - Interface
 * - Abstract class
 * - Exception handling
 * - Documentation standards
 */

/**
 * Interface for authenticatable entities
 */
interface Authenticatable
{
    public function authenticate(string $password): bool;
}

/**
 * Abstract base class for data models
 */
abstract class Model
{
    protected static string $table = '';
    protected array $attributes = [];

    /**
     * Get the database table name
     * @return string
     */
    public static function getTable(): string
    {
        return static::$table;
    }

    /**
     * Magic getter for undefined properties
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        if (array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        }

        throw new RuntimeException(sprintf('Undefined property: %s', $name));
    }

    /**
     * Magic setter for attributes
     * @param string $name
     * @param mixed $value
     */
    public function __set(string $name, $value): void
    {
        $this->attributes[$name] = $value;
    }

    /**
     * Validate model data
     * @return bool
     */
    abstract public function validate(): bool;
}

/**
 * User entity class
 */
class User extends Model implements Authenticatable
{
    // Class constants
    public const MIN_PASSWORD_LENGTH = 8;
    public const MAX_LOGIN_ATTEMPTS = 5;

    // Static properties
    protected static string $table = 'users';
    private static int $instanceCount = 0;
    private static int $nextId = 1;

    // Instance properties
    private readonly int $id;
    private string $name;
    private string $email;
    private int $age;
    private string $passwordHash;
    private DateTime $createdAt;
    private int $loginAttempts = 0;
    private bool $isActive;
    private readonly string $role;

    /**
     * User constructor with property promotion
     * @param string $name
     * @param string $email
     * @param int $age
     * @param string $password
     * @param string $role
     * @throws InvalidArgumentException
     */
    public function __construct(
        string $name,
        string $email,
        int $age,
        string $password,
        string $role = 'user'
    ) {
        $this->id = self::$nextId++;
        $this->name = $this->sanitizeName($name);
        $this->email = $this->validateEmail($email);
        $this->age = $this->validateAge($age);
        $this->passwordHash = $this->hashPassword($password);
        $this->createdAt = new DateTime();
        $this->isActive = true;
        $this->role = $role;
        self::$instanceCount++;
    }

    /**
     * Get total number of User instances
     * @return int
     */
    public static function getInstanceCount(): int
    {
        return self::$instanceCount;
    }

    /**
     * String representation of User
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('User[id=%d, name=%s, email=%s]', $this->id, $this->name, $this->email);
    }

    /**
     * Authenticate user with password
     * @param string $password
     * @return bool
     * @throws RuntimeException
     */
    public function authenticate(string $password): bool
    {
        if ($this->loginAttempts >= self::MAX_LOGIN_ATTEMPTS) {
            throw new RuntimeException('Account locked due to too many login attempts');
        }

        if (password_verify($password, $this->passwordHash)) {
            $this->loginAttempts = 0;
            return true;
        }

        $this->loginAttempts++;
        return false;
    }

    /**
     * Update user password
     * @param string $currentPassword
     * @param string $newPassword
     * @return bool
     * @throws InvalidArgumentException
     */
    public function updatePassword(string $currentPassword, string $newPassword): bool
    {
        if (!$this->authenticate($currentPassword)) {
            return false;
        }

        $this->passwordHash = $this->hashPassword($newPassword);
        return true;
    }

    /**
     * Validate user data
     * @return bool
     */
    public function validate(): bool
    {
        return !empty($this->name)
            && filter_var($this->email, FILTER_VALIDATE_EMAIL)
            && $this->age >= 13;
    }

    /**
     * Sanitize name input
     * @param string $name
     * @return string
     */
    private function sanitizeName(string $name): string
    {
        return trim(ucwords(strtolower($name)));
    }

    /**
     * Validate email address
     * @param string $email
     * @return string
     * @throws InvalidArgumentException
     */
    private function validateEmail(string $email): string
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(sprintf('Invalid email address: %s', $email));
        }
        return $email;
    }

    /**
     * Validate age
     * @param int $age
     * @return int
     * @throws InvalidArgumentException
     */
    private function validateAge(int $age): int
    {
        if ($age < 0 || $age > 120) {
            throw new InvalidArgumentException('Age must be between 0 and 120');
        }
        return $age;
    }

    /**
     * Hash password
     * @param string $password
     * @return string
     * @throws InvalidArgumentException
     */
    private function hashPassword(string $password): string
    {
        if (strlen($password) < self::MIN_PASSWORD_LENGTH) {
            throw new InvalidArgumentException(
                sprintf('Password must be at least %d characters long', self::MIN_PASSWORD_LENGTH)
            );
        }
        return password_hash($password, PASSWORD_BCRYPT);
    }

    // Getters
    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getEmail(): string { return $this->email; }
    public function getAge(): int { return $this->age; }
    public function getCreatedAt(): DateTime { return $this->createdAt; }
    public function getRole(): string { return $this->role; }
    public function isActive(): bool { return $this->isActive; }
}

/**
 * Employee class demonstrating inheritance and polymorphism
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

// Demonstration
try {
    $user1 = new User('Hoang Nguyen', 'hoang@example.com', 43, 'securepass123');
    $user2 = new User('Bob Smith', 'bob@example.com', 25, 'password123');
    $employee1 = new Employee('Taylor Swift', 'taylor@example.com', 30, 'music123', 75000.0, 'Marketing', 'manager');

    // Test authentication
    $authResult = $user1->authenticate('securepass123');

    // Test password update
    $passwordUpdated = $user1->updatePassword('securepass123', 'newpass456');

    // Test magic setter
    $user1->custom_field = 'Custom Value';
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Professional PHP OOP Tutorial</title>
  <style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    color: #333;
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f5f7fa;
  }

  h1,
  h2 {
    color: #2c3e50;
    border-bottom: 2px solid #3498db;
    padding-bottom: 10px;
  }

  .code-block {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 5px;
    overflow-x: auto;
    border-left: 4px solid #3498db;
    margin: 20px 0;
  }

  .output {
    background: #e8f4f8;
    padding: 15px;
    border-radius: 5px;
    margin: 15px 0;
    border-left: 4px solid #2ecc71;
  }

  .note,
  .error {
    padding: 10px;
    border-radius: 5px;
    margin: 10px 0;
  }

  .note {
    background: #fff3cd;
    border-left: 4px solid #ffc107;
  }

  .error {
    background: #f8d7da;
    border-left: 4px solid #dc3545;
  }

  .property {
    color: #e83e8c;
    font-weight: bold;
  }

  .method {
    color: #6f42c1;
    font-weight: bold;
  }

  .class {
    color: #d63384;
    font-weight: bold;
  }

  .constructor {
    color: #fd7e14;
    font-weight: bold;
  }

  .interface {
    color: #17a2b8;
    font-weight: bold;
  }

  .abstract {
    color: #28a745;
    font-weight: bold;
  }
  </style>
</head>

<body>
  <h1>Professional Object-Oriented Programming in PHP</h1>

  <?php if (isset($errorMessage)): ?>
  <div class="error">
    <strong>Error:</strong> <?php echo htmlspecialchars($errorMessage); ?>
  </div>
  <?php endif; ?>

  <h2>1. Classes, Objects, and Encapsulation</h2>
  <div class="code-block">
    <pre>
class <span class="class">User</span> extends <span class="abstract">Model</span> implements <span class="interface">Authenticatable</span> {
    private readonly int $<span class="property">id</span>;
    private string $<span class="property">name</span>;
    private string $<span class="property">email</span>;
    private int $<span class="property">age</span>;
    private string $<span class="property">passwordHash</span>;

    public function <span class="constructor">__construct</span>(
        string $name,
        string $email,
        int $age,
        string $password,
        string $role = 'user'
    ) {
        $this-><span class="property">id</span> = self::$<span class="property">nextId</span>++;
        $this-><span class="property">name</span> = $this-><span class="method">sanitizeName</span>($name);
        $this-><span class="property">email</span> = $this-><span class="method">validateEmail</span>($email);
        $this-><span class="property">age</span> = $this-><span class="method">validateAge</span>($age);
        $this-><span class="property">passwordHash</span> = $this-><span class="method">hashPassword</span>($password);
    }
}
        </pre>
  </div>
  <div class="note">
    <strong>Note:</strong> Uses readonly properties, property promotion, and private methods for
    encapsulation.
  </div>
  <div class="output">
    <pre>
User 1: <?php echo htmlspecialchars((string)$user1); ?>
User 2: <?php echo htmlspecialchars((string)$user2); ?>
Total Instances: <?php echo User::getInstanceCount(); ?>
        </pre>
  </div>

  <h2>2. Methods, Interfaces, and Authentication</h2>
  <div class="code-block">
    <pre>
interface <span class="interface">Authenticatable</span> {
    public function <span class="method">authenticate</span>(string $password): bool;
}

class <span class="class">User</span> extends <span class="abstract">Model</span> implements <span class="interface">Authenticatable</span> {
    public function <span class="method">authenticate</span>(string $password): bool {
        if ($this-><span class="property">loginAttempts</span> >= self::MAX_LOGIN_ATTEMPTS) {
            throw new RuntimeException('Account locked');
        }
        // ... authentication logic ...
    }
}
        </pre>
  </div>
  <div class="output">
    <pre>
Authentication: <?php echo $authResult ? 'Success' : 'Failed'; ?>
Password Update: <?php echo $passwordUpdated ? 'Success' : 'Failed'; ?>
        </pre>
  </div>

  <h2>3. Constructors, Inheritance, and Polymorphism</h2>
  <div class="code-block">
    <pre>
class <span class="class">Employee</span> extends <span class="class">User</span> {
    private float $<span class="property">salary</span>;
    private string $<span class="property">department</span>;

    public function <span class="constructor">__construct</span>(
        string $name, string $email, int $age, string $password,
        float $salary, string $department, string $role = 'employee'
    ) {
        parent::<span class="constructor">__construct</span>($name, $email, $age, $password, $role);
        $this-><span class="property">salary</span> = $this-><span class="method">validateSalary</span>($salary);
        $this-><span class="property">department</span> = $department;
    }

    public function <span class="method">validate</span>(): bool {
        return parent::<span class="method">validate</span>() && $this-><span class="property">salary</span> > 0;
    }
}
        </pre>
  </div>
  <div class="output">
    <pre>
Employee: <?php echo htmlspecialchars((string)$employee1); ?>
Salary: $<?php echo number_format($employee1->getSalary(), 2); ?>
Department: <?php echo htmlspecialchars($employee1->getDepartment()); ?>
        </pre>
  </div>

  <h2>4. Abstract Classes and Magic Methods</h2>
  <div class="code-block">
    <pre>
abstract class <span class="abstract">Model</span> {
    protected static string $<span class="property">table</span> = '';
    protected array $<span class="property">attributes</span> = [];

    public function <span class="method">__get</span>(string $name) {
        if (array_key_exists($name, $this-><span class="property">attributes</span>)) {
            return $this-><span class="property">attributes</span>[$name];
        }
        throw new RuntimeException("Undefined property: $name");
    }

    public function <span class="method">__set</span>(string $name, $value): void {
        $this-><span class="property">attributes</span>[$name] = $value;
    }
}
        </pre>
  </div>
  <div class="output">
    <pre>
Custom Field: <?php echo htmlspecialchars($user1->custom_field); ?>
Table Name: <?php echo htmlspecialchars(User::getTable()); ?>
        </pre>
  </div>

  <div class="note">
    <strong>Key Concepts Covered:</strong>
    <ul>
      <li>Encapsulation with private/readonly properties</li>
      <li>Type declarations for parameters and return types</li>
      <li>Static members for instance counting</li>
      <li>Inheritance with parent constructor calls</li>
      <li>Polymorphism through method overriding</li>
      <li>Magic methods for dynamic property access</li>
      <li>Interfaces for contract enforcement</li>
      <li>Abstract classes for shared functionality</li>
      <li>Exception handling for robust error management</li>
      <li>Professional PHPDoc documentation</li>
    </ul>
  </div>
</body>

</html>