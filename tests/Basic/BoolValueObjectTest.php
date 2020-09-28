<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject\Tests\Basic;

use Mockery\Adapter\Phpunit\MockeryTestCase;
use OtherCode\DDDValueObject\Basic\BoolValueObject;

/**
 * Class BoolValueObjectTest
 *
 * @package OtherCode\DDDValueObject\Tests\Basic
 */
class BoolValueObjectTest extends MockeryTestCase
{
    public function testShouldCreateValidValueObject(): void
    {
        $vo = new BoolValueObject(true);
        $this->assertTrue($vo->value());
    }

    public function testShouldReturnTrueOnEqualObjects(): void
    {
        $vo = new BoolValueObject(true);
        $this->assertTrue($vo->equals(new BoolValueObject(true)));
    }

    public function testShouldReturnFalseOnNotEqualObjects(): void
    {
        $vo = new BoolValueObject(true);
        $this->assertFalse($vo->equals(new BoolValueObject(false)));
    }
}
