# PHP Int To BaseN

This is a small library for converting integers to any base you want, with the
ability to provide a custom alphabet.

## Install

```
composer require carc1n0gen/int-to-basen
```

## Usage

```php
<?php

require 'vendor/autoload.php';

// Initialize a converter with the default alphabet
$converter = new \Carc1n0gen\BaseN\BaseNConverter();

// Get the encoded version of the int 10
$encoded = $converter->encode(10);

// Convert back to the original integer
$num = $converter->decode($encoded);

// Initialize a converter with a custom alphabet
$converter = new \Carc1n0gen\BaseN\BaseNConverter('abc123');

// Initialize a converter and randomize the alphabet
$converter = new \Carc1n0gen\BaseN\BaseNConverter(null, true);

// Initialize a converter with a custom and randomized alphabet
$converter = new \Carc1n0gen\BaseN\BaseNConverter('abc123', true);
```