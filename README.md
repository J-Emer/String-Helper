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

// Get the filename from a path
echo PathHelper::fileName("/var/www/index.php"); // index.php

// Get the filename without extension
echo PathHelper::fileNameWithoutExtension("/var/www/index.php"); // index

// Get the extension from a file path
echo PathHelper::extension("/var/www/index.php"); // php

// Get all files from a directory (non-recursive)
print_r(PathHelper::getFiles("/path/to/directory"));

// Get all subdirectories from a directory
print_r(PathHelper::getDirectories("/path/to/directory"));

// Generate a path by joining parts
echo PathHelper::generatePath(["var", "www", "html"]); // var/www/html (or platform-specific separators)

// Get the containing directory for a file
echo PathHelper::containingDirectory("/var/www/index.php"); // /var/www



-------------------------------------------------------------------------------

use Jemer\StringHelper\StringBuilder;

// Create a new StringBuilder instance
$stringBuilder = new StringBuilder();

// Add a simple string
$stringBuilder->Add("Hello, world!");

// Add an indented line (2 tabs)
$stringBuilder->Add_Indented("This is indented text.", 2);

// Add a comment line
$stringBuilder->AddComment("This is a comment");

// Add a horizontal dashed line of width 10
$stringBuilder->AddHorizontalLine(10);

// Add text surrounded by new lines
$stringBuilder->AddNewLineText("This text has blank lines before and after");

// Add just a new line
$stringBuilder->AddNewLine();

// Convert the built lines to a single string and output
echo $stringBuilder->ToString();

/*
Output example:

Hello, world!
        This is indented text.

//This is a comment

----------

This text has blank lines before and after

*/

// Clear the builder content to start fresh
$stringBuilder->Clear();


```


## Running Tests
```php
vendor/bin/phpunit
```

## Contributing
Contributions are welcome! Please fork the repo and submit a pull request.
