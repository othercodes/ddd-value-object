<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject\Tests;

use RuntimeException;
use InvalidArgumentException;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * Class HasInvariantsTest
 *
 * @package OtherCode\DDDValueObject\Tests
 */
class HasInvariantsTest extends MockeryTestCase
{
    public function testShouldExecuteSuccessfullyInvariants(): void
    {
        $vo = new DummyNameVO('some-value');
        $this->assertEquals('some-value', $vo->value);
    }

    public function testShouldThrowExceptionWithDefaultMessage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('value max length must be valid');

        new DummyNameVO('some-value-too-long-for-the-vo');
    }

    public function testShouldThrowExceptionWithCustomMessage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Min length must be greater or equal than 3 characters.'
        );

        new DummyNameVO('so');
    }

    public function testShouldExecuteCustomOnFailFunction(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Invalid value');

        new DummyNameVOManualInvariantValidation('a');
    }
}
