<?php
declare(strict_types=1);

/**
 * Entry point for PHP OOP Tutorial
 * Handles presentation logic and object demonstration
 */

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

require_once 'models/Authenticatable.php';
require_once 'models/Model.php';
require_once 'models/User.php';
require_once 'models/Employee.php';

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
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <h1>Professional Object-Oriented Programming in PHP</h1>

  <?php if (isset($errorMessage)): ?>
  <div class="error">
    <strong>Error:</strong> <?= htmlspecialchars($errorMessage) ?>
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
User 1: <?= htmlspecialchars((string)$user1) ?>
</pre>
    <pre>
User 2: <?= htmlspecialchars((string)$user2) ?>
</pre>
    <pre>
Total Instances: <?= User::getInstanceCount() ?>
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
Authentication: <?= $authResult ? 'Success' : 'Failed' ?> </pre>
    <pre>
Password Update: <?= $passwordUpdated ? 'Success' : 'Failed' ?>
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
Employee: <?= htmlspecialchars((string)$employee1) ?>
</pre>
    <pre>
Salary: $<?= number_format($employee1->getSalary(), 2) ?>
</pre>
    <pre>
Department: <?= htmlspecialchars($employee1->getDepartment()) ?>
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
Custom Field: <?= htmlspecialchars($user1->custom_field) ?>
</pre>
    <pre>
Table Name: <?= htmlspecialchars(User::getTable()) ?>
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