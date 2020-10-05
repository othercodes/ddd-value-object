<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject;

use Exception;
use OtherCode\DDDValueObject\Exceptions\ImmutableValueException;

/**
 * Trait HasImmutability
 *
 * @package OtherCode\DDDValueObject
 */
trait HasImmutability
{
    /**
     * Defines the exception that will be thrown on the change value attempt.
     *
     * @var string
     */
    protected string $immutabilityException = ImmutableValueException::class;

    /**
     * Messages used by this feature, can be customized by overriding the
     * property in the child class.
     *
     * @var array<string, string>
     */
    protected array $immutabilityMessages = [
        'default' => 'Illegal attempt to change immutable value.',
    ];

    /**
     * Always return true as we are using HasImmutability trait.
     *
     * @return bool
     */
    public function isImmutable(): bool
    {
        return true;
    }

    /**
     * Block any value modification attempt.
     *
     * @throws ImmutableValueException|Exception
     */
    protected function immutableSet(): void
    {
        throw new $this->immutabilityException(
            $this->immutabilityMessages['default']
        );
    }
}
