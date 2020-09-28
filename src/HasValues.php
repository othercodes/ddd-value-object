<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject;

use OtherCode\DDDValueObject\Exceptions\ImmutableValueException;

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
     * Set value into the value storage.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @throws ImmutableValueException
     */
    protected function set(string $key, $value): void
    {
        if (method_exists($this, 'isImmutable') && $this->isImmutable()) {
            throw new ImmutableValueException(
                'Illegal attempt to change immutable value.'
            );
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
