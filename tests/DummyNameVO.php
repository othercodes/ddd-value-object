<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject\Tests;

use InvalidArgumentException;
use OtherCode\DDDValueObject\HasEquality;
use OtherCode\DDDValueObject\HasInvariants;
use OtherCode\DDDValueObject\HasValues;

/**
 * Class DummyNameValueObject
 *
 * @package OtherCode\DDDValueObject\Tests
 */
class DummyNameVO
{
    use HasValues, HasInvariants, HasEquality;

    /**
     * DummyNameVO constructor.
     *
     * @param string $value
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $value)
    {
        $this->initialize(['value' => $value]);
        $this->checkInvariants();
    }

    protected function invariantValueMaxLengthMustBeValid(): bool
    {
        return strlen($this->get('value')) <= 10;
    }

    protected function invariantValueMinLengthMustBeValid(): bool
    {
        if (strlen($this->get('value')) < 3) {
            throw new InvalidArgumentException(
                'Min length must be greater or equal than 3 characters.'
            );
        }

        return true;
    }
}
