<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject\Basic;

use OtherCode\DDDValueObject\HasEquality;
use OtherCode\DDDValueObject\HasImmutability;
use OtherCode\DDDValueObject\HasValues;

/**
 * Class BoolValueObject
 *
 * @package Antares\Shared\Domain\ValueObjects
 */
class BoolValueObject implements HasEquality
{
    use HasValues, HasImmutability;

    /**
     * BoolValueObject constructor.
     *
     * @param bool $value
     */
    public function __construct(bool $value)
    {
        $this->initialize(['value' => $value]);
    }

    /**
     * Get the bool value.
     *
     * @return bool
     */
    public function value(): bool
    {
        return $this->get('value');
    }

    /**
     * Compare other object with HasEquality capabilities.
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
        return $this->value() ? 'true' : 'false';
    }
}
