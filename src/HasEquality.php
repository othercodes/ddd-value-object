<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject;

/**
 * Interface HasEquality
 *
 * @package OtherCode\DDDValueObject
 */
trait HasEquality
{
    /**
     * Defines the algorithm used to hash the string representation
     * of the value object. sha256 by default.
     *
     * @var string
     */
    private string $equalityHashAlgorithm = 'sha256';

    /**
     * Compare $this object with $other object. If the class is not
     * the same directly return false, compare value equality hash
     * otherwise.
     *
     * @param object $other
     *
     * @return bool
     */
    public function equals(object $other): bool
    {
        if (!($other instanceof static)) {
            return false;
        }

        return $this->equalityHash() === $other->equalityHash();
    }

    /**
     * Calculate a string hash based in the object value.
     *
     * @return string
     */
    public function equalityHash(): string
    {
        return hash(
            $this->equalityHashAlgorithm,
            method_exists($this, 'getValues')
                ? json_encode($this->getValues())
                : serialize($this)
        );
    }
}
