# PHP-ShortLink

[![Build Status](https://travis-ci.org/carc1n0gen/php-shortlink.svg?branch=master)](https://travis-ci.org/carc1n0gen/php-shortlink)

php package for generating short url friendly strings from integer ids.

## Install

```
composer require carc1n0gen/short-link
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
