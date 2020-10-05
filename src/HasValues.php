<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject;

/**
 * Trait HasValues
 *
 * @package OtherCode\DDDValueObject
 */
trait HasValues
{
    /**
     * Value storage.
     *
     * @var array<string, mixed>
     */
    private array $values = [];

    /**
     * Initialize a set of values.
     *
     * $this->initialize([
     *     'key' => 'value'
     * ]);
     *
     * @param array<string, mixed> $values
     */
    protected function initialize(array $values = []): void
    {
        $this->values = $values;
    }

    /**
     * Return the internal list of values.
     *
     * @return array<string, string>
     */
    protected function getValues(): array
    {
        return $this->values;
    }

    /**
     * Set value into the value storage.
     *
     * @param string $key
     * @param mixed  $value
     */
    protected function set(string $key, $value): void
    {
        if (method_exists($this, 'immutableSet')) {
            $this->immutableSet();
        }

        $this->values[$key] = $value;
    }

    /**
     * Get the required value from the value storage.
     *
     * @param string $key
     *
     * @return mixed|null
     */
    protected function get(string $key)
    {
        return isset($this->values[$key])
            ? $this->values[$key]
            : null;
    }

    /**
     * Set value into the value storage.
     *
     * @param string $key
     * @param mixed  $value
     */
    public function __set(string $key, $value): void
    {
        $this->set($key, $value);
    }

    /**
     * Get the required value from the value storage.
     *
     * @param string $key
     *
     * @return mixed|null
     */
    public function __get(string $key)
    {
        return $this->get($key);
    }
}
