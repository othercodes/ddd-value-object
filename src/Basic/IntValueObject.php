<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject\Basic;

use OtherCode\DDDValueObject\HasEquality;
use OtherCode\DDDValueObject\HasImmutability;
use OtherCode\DDDValueObject\HasValues;

/**
 * Class IntValueObject
 *
 * @package OtherCode\DDDValueObject\Basic
 */
class IntValueObject implements HasEquality
{
    use HasValues, HasImmutability;

    /**
     * IntValueObject constructor.
     *
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->initialize(['value' => $value]);
    }

    /**
     * Get the int value.
     *
     * @return int
     */
    public function value(): int
    {
        return $this->get('value');
    }

    /**
     * Check if the int are equals.
     *
     * @param HasEquality $other
     *
     * @return bool
     */
    public function equals(HasEquality $other): bool
    {
        return (string)$this === (string)$other;
    }

    /**
     * To string value.
     *
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->value();
    }
}
