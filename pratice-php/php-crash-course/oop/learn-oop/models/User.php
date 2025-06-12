<?php
declare(strict_types=1);

require_once 'Authenticatable.php';
require_once 'Model.php';

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
    private int $id;
    private string $name;
    private string $email;
    private int $age;
    private string $passwordHash;
    private DateTime $createdAt;
    private int $loginAttempts = 0;
    private bool $isActive;
    private string $role;

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