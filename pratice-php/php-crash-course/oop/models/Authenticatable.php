<?php
declare(strict_types=1);

/**
 * Interface for authenticatable entities
 */
interface Authenticatable
{
    /**
     * Authenticate with a password
     * @param string $password
     * @return bool
     */
    public function authenticate(string $password): bool;
}