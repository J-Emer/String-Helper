# String Helper

A lightweight PHP library providing useful string and path helper functions.

## Features

- String manipulation utilities
- Path handling helpers
- Easy to integrate and extend
- Fully tested with PHPUnit

## Installation

Install via Composer:

```bash
composer require jemer/string-helper
```

## Usage

```php
use Jemer\StringHelper\PathHelper;

$files = PathHelper::getFiles('/path/to/directory');
print_r($files);
```


## Running Tests
```php
vendor/bin/phpunit
```

## Contributing
Contributions are welcome! Please fork the repo and submit a pull request.
