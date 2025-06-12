<?php
declare(strict_types=1);

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
     * @throws RuntimeException
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