<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject\Tests;

use OtherCode\DDDValueObject\HasImmutability;

/**
 * Class DummyNameVOImmutable
 *
 * @package OtherCode\DDDValueObject\Tests
 */
class DummyNameVOImmutable extends DummyNameVO
{
    use HasImmutability;
}
