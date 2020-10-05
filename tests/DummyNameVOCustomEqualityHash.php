<?php

declare(strict_types=1);

namespace OtherCode\DDDValueObject\Tests;

/**
 * Class DummyNameValueObject
 *
 * @package OtherCode\DDDValueObject\Tests
 */
class DummyNameVOCustomEqualityHash extends DummyNameVO
{
    public function equalityHash(): string
    {
        return hash('md5', $this->get('value'));
    }
}
