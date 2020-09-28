<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject;

/**
 * Trait HasImmutability
 *
 * @package OtherCode\DDDValueObject
 */
trait HasImmutability
{
    /**
     * Immutability flag.
     *
     * @var bool
     */
    private bool $isImmutable = true;

    /**
     * Return if the object is immutable or not, always true.
     *
     * @return bool
     */
    public function isImmutable(): bool
    {
        return $this->isImmutable;
    }

    /**
     * Set the immutability flag as false.
     *
     * @return void
     */
    public function disableImmutability(): void
    {
        $this->isImmutable = false;
    }

    /**
     * Set the immutability flag as true.
     *
     * @return void
     */
    public function enableImmutability(): void
    {
        $this->isImmutable = true;
    }
}
