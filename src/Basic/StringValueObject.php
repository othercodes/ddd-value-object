<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject\Basic;

use InvalidArgumentException;
use OtherCode\DDDValueObject\HasEquality;
use OtherCode\DDDValueObject\HasImmutability;
use OtherCode\DDDValueObject\HasInvariants;
use OtherCode\DDDValueObject\HasValues;

/**
 * Class StringValueObject
 *
 * @package OtherCode\DDDValueObject\Basic
 */
class StringValueObject
{
    use HasValues, HasImmutability, HasInvariants, HasEquality;

    /**
     * Check the min length or the string.
     *
     * @var int
     */
    protected int $minLength = 0;

    /**
     * Check the max length of the string.
     *
     * @var int
     */
    protected int $maxLength = 0;

    /**
     * The pattern to match for the given string.
     *
     * @var string
     */
    protected string $pattern = '';

    /**
     * StringValueObject constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->initialize(['value' => $value]);
        $this->checkInvariants();
    }

    protected function invariantValueMinLengthMustBeValid(): bool
    {
        $length = strlen($this->get('value'));
        if ($this->minLength > 0 && $length < $this->minLength) {
            throw new InvalidArgumentException(
                "Min length {$this->minLength} is required, given {$length}"
            );
        }

        return true;
    }

    protected function invariantValueMaxLengthMustBeValid(): bool
    {
        $length = strlen($this->get('value'));
        if ($this->maxLength > 0 && $length > $this->maxLength) {
            throw new InvalidArgumentException(
                "Max length {$this->maxLength} exceeded, given {$length}"
            );
        }

        return true;
    }

    protected function invariantValueMustMatchRegexPattern(): bool
    {
        if (!empty($this->pattern)
            && preg_match($this->pattern, $this->get('value')) !== 1
        ) {
            throw new InvalidArgumentException(
                "Invalid value, does not match pattern {$this->pattern}"
            );
        }

        return true;
    }

    /**
     * Get the string value.
     *
     * @return string
     */
    public function value(): string
    {
        return $this->get('value');
    }

    /**
     * To string method.. string is a string...
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
