<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject\Tests;

use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * Class HasValuesTest
 *
 * @package OtherCode\DDDValueObject\Tests
 */
class HasValuesTest extends MockeryTestCase
{
    public function testObjectHasValues(): void
    {
        $vo = new DummyNameVO('some value');

        $this->assertEquals("some value", $vo->value);
    }

    public function testObjectCanUpdateValues(): void
    {
        $initialValue = 'some value';
        $newValue = 'new value';

        $vo = new DummyNameVO($initialValue);
        $this->assertEquals($initialValue, $vo->value);

        $vo->value = $newValue;
        $this->assertEquals($newValue, $vo->value);
    }
}
