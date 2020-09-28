<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject;

/**
 * Interface HasEquality
 *
 * @package OtherCode\DDDValueObject
 */
interface HasEquality
{
    /**
     * Represents the object as string.
     *
     * @return string
     */
    public function __toString(): string;

    /**
     * Compare other object with HasEquality capabilities.
     *
     * @param HasEquality $other
     *
     * @return bool
     */
    public function equals(HasEquality $other): bool;
}
