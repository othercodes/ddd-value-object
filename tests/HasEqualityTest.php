<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject\Tests;

use stdClass;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * Class HasEqualityTest
 *
 * @package OtherCode\DDDValueObject\Tests
 */
class HasEqualityTest extends MockeryTestCase
{
    public function testShouldReturnTrueOnEqualObjects(): void
    {
        $vo = new DummyNameVO('some value');

        $this->assertTrue($vo->equals(new DummyNameVO('some value')));
    }

    public function testShouldReturnFalseOnNonEqualObjects(): void
    {
        $vo = new DummyNameVO('some value');
        $this->assertFalse($vo->equals(new DummyNameVO('different')));
        $this->assertFalse($vo->equals(new stdClass()));
    }

    public function testShouldReturnTrueOnEqualObjectWithCustomHash(): void
    {
        $vo = new DummyNameVOCustomEqualityHash('sample');
        $this->assertTrue(
            $vo->equals(new DummyNameVOCustomEqualityHash('sample'))
        );
    }

    public function testShouldReturnFalseOnNonEqualObjectWithCustomHash(): void
    {
        $vo = new DummyNameVOCustomEqualityHash('sample');
        $this->assertFalse(
            $vo->equals(new DummyNameVOCustomEqualityHash('different'))
        );
    }
}
