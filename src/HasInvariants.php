<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject;

use Exception;
use InvalidArgumentException;

/**
 * Trait HasInvariants
 *
 * @package OtherCode\DDDValueObject
 */
trait HasInvariants
{
    /**
     * Defines the invariant string prefix: "invariant" by default.
     *
     * @var string
     */
    protected string $invariantPrefix = "invariant";

    /**
     * Defines the exception that will be thrown on an invariant violation.
     *
     * @var string
     */
    protected string $invariantException = InvalidArgumentException::class;

    /**
     * Messages used by this feature, can be customized by overriding the
     * property in the child class.
     *
     * @var array|string[]
     */
    protected array $invariantMessages = [
        'fail' => "Unable to create {class} value object due: \n{violations}\n",
    ];

    /**
     * Retrieve the object invariants.
     *
     * @return string[]
     */
    protected function getInvariants(): array
    {
        return array_filter(
            get_class_methods($this),
            function (string $name) {
                return strpos($name, trim($this->invariantPrefix)) === 0;
            }
        );
    }

    /**
     * Execute all the registered invariants.
     *
     *  - All invariants method names must begin with the invariant prefix
     *    ("invariant" by default) and must be written in PascalCase.
     *  - All invariant can either return bool or throw an exception.
     *  - Return true by invariant means the invariants is passed successfully.
     *  - Return false by the invariant means the invariant has failed.
     *
     * If boolean is returned the error message will be the invariant method name
     * (PascalCase) in normal case.
     *
     * If exception is thrown the error message will be the exception message.
     *
     * $onFail function must have following signature:
     *  fn(array<string, string>) => void
     *
     * @param callable|null $onFail
     *
     * @return void
     * @throws InvalidArgumentException
     */
    protected function checkInvariants(callable $onFail = null): void
    {
        $violations = [];
        foreach ($this->getInvariants() as $invariant) {
            try {
                if (!call_user_func_array([$this, $invariant], [])) {
                    $violations[$invariant] = $this->parseInvariant($invariant);
                }
            } catch (Exception $e) {
                $violations[$invariant] = $e->getMessage();
            }
        }

        if (count($violations) > 0) {
            is_null($onFail)
                ? $this->onFail($violations)
                : $onFail($violations);
        }
    }

    /**
     * Parse the invariant name to get human readable string, no PascalCase.
     *
     * @param string $invariant
     *
     * @return string
     */
    protected function parseInvariant(string $invariant): string
    {
        return strtolower(
            preg_replace('/[A-Z]([A-Z](?![a-z]))*/', ' $0', $invariant)
        );
    }

    /**
     * Process the invariants violations and generate a report that is
     * raised as exception if the silence validation is off, return
     * false otherwise.
     *
     * @param array $violations
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     */
    protected function onFail(array $violations): bool
    {
        throw new $this->invariantException(
            strtr(
                $this->invariantMessages['fail'],
                [
                    '{class}'      => basename(
                        str_replace('\\', '/', static::class)
                    ),
                    '{violations}' => implode("\n", $violations),
                ]
            )
        );
    }
}
