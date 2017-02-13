# PHP-ShortLink

php package for generating short url friendly strings from integer ids.

## Install

```
composer require carc1n0gen/int-to-basen
```

## Usage

```php
<?php

require 'vendor/autoload.php';

// Initialize a converter with the default alphabet
$converter = new \Carc1n0gen\ShortLink\Converter();

// Get the encoded version of the int 10
$encoded = $converter->encode(10);

// Convert back to the original integer
$num = $converter->decode($encoded);

// Initialize a converter with a custom alphabet
$converter = new \Carc1n0gen\ShortLink\Converter('abc123');
```