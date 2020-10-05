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
class BoolValueObject
{
    use HasValues, HasImmutability, HasEquality;

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
     * To string value.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->value() ? 'true' : 'false';
    }
}
