<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject\Basic;

use Exception;
use OtherCode\DDDValueObject\HasEquality;
use OtherCode\DDDValueObject\HasImmutability;
use OtherCode\DDDValueObject\HasInvariants;
use OtherCode\DDDValueObject\HasValues;
use Ramsey\Uuid\Uuid;

/**
 * Class UUIDValueObject
 *
 * @package OtherCode\DDDValueObject\Basic
 */
class UUIDValueObject implements HasEquality
{
    use HasValues, HasImmutability, HasInvariants;

    private const RANDOM = 'random';

    /**
     * UUIDValueObject constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->initialize(
            [
                'value' => ($value === self::RANDOM)
                    ? Uuid::uuid4()->toString()
                    : $value,
            ]
        );

        $this->checkInvariants();
    }

    protected function invariantMustBeValidUniversallyUniqueIdentifier(): bool
    {
        return Uuid::isValid($this->get('value'));
    }

    /**
     * Get the uuid value.
     *
     * @return string
     */
    public function value(): string
    {
        return $this->get('value');
    }

    /**
     * Check if the uuid is equals to another.
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
     * Generate a random UUIDValueObject.
     *
     * @return static
     * @throws Exception
     */
    public static function random(): self
    {
        return new static(self::RANDOM);
    }

    /**
     * To string method.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
