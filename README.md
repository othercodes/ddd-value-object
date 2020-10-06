# DDD Value Object

Small library to easily manage the Value Object Pattern.

## Installation

Use the following command to install with `composer`:

```bash
composer require othercode/ddd-value-object
```

This will automatically get the latest version and configure a `composer.json` file.

Alternatively you can create the following `composer.json` file and run `composer install` to install it.

```bash
{
    "require": {
        "othercode/ddd-value-object": "*"
    }
}
```

## Usage

Build a Value object is quite simple, you just need to extend the `ValueObject` Next, initialize the values in the 
constructor by using the `initialize` method. Finally, add invariant rules as protected method, using the  prefix 
`invariant` (this prefix can be customized) and execute them with the `checkInvariants` method.

```php
<?php 

declare(strict_types=1);

class Speed extends OtherCode\DDDValueObject\ValueObject
{
    public const KILOMETERS_PER_HOUR = 'km/h';
    public const MILES_PER_HOUR = 'm/h';

    public function __construct(int $amount, string $magnitude)
    {
        $this->initialize([
            'amount' => $amount,
            'magnitude' => $magnitude
        ]);

        $this->checkInvariants();
    }

    protected function invariantSpeedMustBeGreaterThanZero(): bool
    {
        return $this->amount() > 0;
    }

    protected function invariantMagnitudeMustBeValid(): bool
    {
        return in_array($this->magnitude(), [
            self::KILOMETERS_PER_HOUR,
            self::MILES_PER_HOUR
        ]);
    }

    public function amount(): int
    {
        return $this->get('amount');
    }

    public function magnitude(): string
    {
        return $this->get('magnitude');
    }

    public function increase(Speed $speed): self
    {
        if ($speed->magnitude() !== $this->magnitude()) {
            throw new InvalidArgumentException('The given magnitude is not valid.');
        }

        return new self($this->amount() + $speed->amount(), $this->magnitude());
    }

    public function __toString(): string
    {
        return $this->amount() . $this->magnitude();
    }
}
```

### Equality

Value equality is computed by serializing the object and hashing it with the sha256 algorithm. Alternatively, you can 
override `equalityHash` to calculate a proper hash for the object. This hash is used to check if the value objects are 
equals or not.

```php
<?php

declare(strict_types=1);

class Speed extends OtherCode\DDDValueObject\ValueObject
{
// ...
    public function equalityHash(): string
    {
        return md5(sprintf('$s %s', $this->amount(), $this->magnitude());
    }
// ...
}
```

### Immutability

The immutability property blocks any attempt of value modification, that will end in exception:

```php
$s = new Speed(120, 'km/h');
$s->amount = 123;

// PHP Fatal error:  Uncaught OtherCode\DDDValueObject\Exceptions\ImmutableValueException: Illegal attempt to change immutable value.
```

You can customize the exception that will be thrown by overriding the `immutabilityException` property. The same happens 
with the error message, you just need to override the `immutabilityMessages` property.

```php
<?php

declare(strict_types=1);

class Speed extends OtherCode\DDDValueObject\ValueObject
{
// ...
    protected string $immutabilityException = SomeCustomException::class;

    protected array $immutabilityMessages = [
        'default' => 'You shall not update this value!.',
    ];
// ...
}
```

### Invariants

The invariants methods must return a boolean value, `true` if the invariant is successfully, `false` otherwise. If any
in variant is violated you will get an exception: 

```php
<?php
$s = new Speed(-1, 'm/s');

// PHP Fatal error:  Uncaught InvalidArgumentException: Unable to create Speed value object due: 
// invariant speed must be greater than zero
// invariant magnitude must be valid
```

By default, the invariant name is parsed and used as message error on invariant violation, but this can be easily
customized, you just need to throw an exception with your custom message instead returning `false` in the invariants:

```php
<?php

declare(strict_types=1);

class Speed extends OtherCode\DDDValueObject\ValueObject
{
// ...
    protected function invariantSpeedMustBeGreaterThanZero(): bool
    {
        if($this->amount() < 0) {
            throw new InvalidArgumentException('The given speed value is not valid');
        }

        return true;
    }
// ...
}

$s = new Speed(-1, 'm/s');

// PHP Fatal error:  Uncaught InvalidArgumentException: Unable to create Speed value object due: 
// The given speed value is not valid
// invariant magnitude must be valid
```

Additionally, you can fully customize how the invariant violation are managed by passing a custom function to the
`checkInvariants` method:

```php
<?php 

declare(strict_types=1);

class Speed extends OtherCode\DDDValueObject\ValueObject
{
// ...
    public function __construct(int $amount, string $magnitude)
    {
        $this->initialize([
            'amount' => $amount,
            'magnitude' => $magnitude
        ]);

        $this->checkInvariants(function (array $violations) {
           throw new RuntimeException("Epic fail due:\n-" . implode("\n-", $violations) . "\n");
       });
    }

    protected function invariantSpeedMustBeGreaterThanZero(): bool
    {
        if($this->amount() < 0) {
            throw new InvalidArgumentException('The given speed value is not valid');
        }

        return true;
    }
// ...
}

$s = new Speed(-120, 'clicks/s');

// PHP Fatal error:  Uncaught RuntimeException: Epic fail due:
// - The given speed value is not valid
// - invariant magnitude must be valid
```
