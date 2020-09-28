<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject\Tests;

use Mockery\Adapter\Phpunit\MockeryTestCase;
use OtherCode\DDDValueObject\Exceptions\ImmutableValueException;

/**
 * Class HasImmutabilityTest
 *
 * @package OtherCode\DDDValueObject\Tests
 */
class HasImmutabilityTest extends MockeryTestCase
{
    public function testShouldHasImmutability(): void
    {
        $vo = new DummyNameVOImmutable('some value');

        $this->assertTrue($vo->isImmutable());
    }

    public function testShouldToggleImmutability(): void
    {
        $vo = new DummyNameVOImmutable('some value');

        $vo->disableImmutability();
        $this->assertFalse($vo->isImmutable());

        $vo->enableImmutability();
        $this->assertTrue($vo->isImmutable());
    }

    public function testShouldThrowExceptionOnValueModificationAttempt(): void
    {
        $this->expectException(ImmutableValueException::class);

        $vo = new DummyNameVOImmutable('some value');
        $vo->value = 'new value';
    }

    public function testShouldAllowValueModificationWithDisabledImmutability(
    ): void
    {
        $vo = new DummyNameVOImmutable('some value');
        $vo->disableImmutability();

        $newValue = 'new value';

        $vo->value = $newValue;
        $this->assertEquals($newValue, $vo->value);
    }
}
