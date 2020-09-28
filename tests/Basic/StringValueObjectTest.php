<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject\Tests\Basic;

use InvalidArgumentException;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use OtherCode\DDDValueObject\Basic\StringValueObject;

/**
 * Class StringValueObjectTest
 *
 * @package OtherCode\DDDValueObject\Tests\Basic
 */
class StringValueObjectTest extends MockeryTestCase
{
    public function testShouldCreateValidValueObject(): void
    {
        $vo = new StringValueObject('sample');
        $this->assertEquals('sample', $vo->value());
    }

    public function testShouldReturnTrueOnEqualObjects(): void
    {
        $vo = new StringValueObject('sample');
        $this->assertTrue($vo->equals(new StringValueObject('sample')));
    }

    public function testShouldReturnFalseOnNotEqualObjects(): void
    {
        $vo = new StringValueObject('sample');
        $this->assertFalse($vo->equals(new StringValueObject('diff')));
    }

    public function testShouldThrowExceptionOnMinLengthViolation(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new class('one') extends StringValueObject {
            protected int $minLength = 5;
        };
    }

    public function testShouldThrowExceptionOnMaxLengthViolation(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new class('this is long') extends StringValueObject {
            protected int $maxLength = 5;
        };
    }

    public function testShouldThrowExceptionOnRegexViolation(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new class('INVALID') extends StringValueObject {
            protected string $pattern = '[a-z]';
        };
    }
}
