<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject;

/**
 * Trait IsValueObject
 *
 * @package OtherCode\DDDValueObject
 */
trait IsValueObject
{
    use HasValues, HasEquality, HasImmutability, HasInvariants;

    /**
     * Hydrate the current object with the incoming values and
     * run the available invariants.
     *
     * $onFail function must have following signature:
     *  fn(array<string, string>) => void
     *
     * @param array<string, mixed> $values
     * @param callable|null        $onFail
     */
    public function hydrate(array $values, callable $onFail = null)
    {
        $this->initialize($values);
        $this->checkInvariants($onFail);
    }
}
