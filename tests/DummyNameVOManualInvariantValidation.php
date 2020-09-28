<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject\Tests;

use InvalidArgumentException;
use OtherCode\DDDValueObject\HasInvariants;
use OtherCode\DDDValueObject\HasValues;
use RuntimeException;

/**
 * Class DummyNameVOImmutableManualInvariantValidation
 *
 * @package OtherCode\DDDValueObject\Tests
 */
class DummyNameVOManualInvariantValidation
{
    use HasValues, HasInvariants;

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
        $this->checkInvariants(
            function (array $violations): void {
                throw new RuntimeException('Invalid value');
            }
        );
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
