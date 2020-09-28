<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject\Tests\Basic;

use Mockery\Adapter\Phpunit\MockeryTestCase;
use OtherCode\DDDValueObject\Basic\IntValueObject;

/**
 * Class IntValueObjectTest
 *
 * @package OtherCode\DDDValueObject\Tests\Basic
 */
class IntValueObjectTest extends MockeryTestCase
{
    public function testShouldCreateValidValueObject(): void
    {
        $vo = new IntValueObject(42);
        $this->assertEquals(42, $vo->value());
    }

    public function testShouldReturnTrueOnEqualObjects(): void
    {
        $vo = new IntValueObject(42);
        $this->assertTrue($vo->equals(new IntValueObject(42)));
    }

    public function testShouldReturnFalseOnNotEqualObjects(): void
    {
        $vo = new IntValueObject(42);
        $this->assertFalse($vo->equals(new IntValueObject(402)));
    }
}
