<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject\Tests\Basic;

use InvalidArgumentException;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use OtherCode\DDDValueObject\Basic\UUIDValueObject;

/**
 * Class UUIDValueObjectTest
 *
 * @package OtherCode\DDDValueObject\Tests\Basic
 */
class UUIDValueObjectTest extends MockeryTestCase
{
    public function testShouldCreateValidValueObject(): void
    {
        $uuid = '32b10769-50a7-4141-bfb7-a08fc7045a19';

        $vo = new UUIDValueObject($uuid);
        $this->assertIsString($vo->value());
    }

    public function testShouldCreateValidRandomValueObject(): void
    {
        $vo = UUIDValueObject::random();
        $this->assertIsString($vo->value());
    }

    public function testShouldReturnTrueOnEqualObjects(): void
    {
        $uuid = '32b10769-50a7-4141-bfb7-a08fc7045a19';

        $vo = new UUIDValueObject($uuid);
        $this->assertTrue($vo->equals(new UUIDValueObject($uuid)));
    }

    public function testShouldReturnFalseOnNotEqualObjects(): void
    {
        $uuid1 = '32b10769-50a7-4141-bfb7-a08fc7045a19';
        $uuid2 = '09d4396b-e5e1-43e7-acb8-ba1704128e15';

        $vo = new UUIDValueObject($uuid1);
        $this->assertFalse($vo->equals(new UUIDValueObject($uuid2)));
    }

    public function testShouldThrowExceptionOnInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new UUIDValueObject('wrong');
    }
}
