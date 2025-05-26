<?php

use PHPUnit\Framework\TestCase;
use Jemer\StringHelper\StringHelper;

class StringHelperTest extends TestCase
{
    public function testToSnakeCase()
    {
        $this->assertEquals('this_is_a_test', StringHelper::toSnakeCase('thisIsATest'));
    }

    public function testToCamelCase()
    {
        $this->assertEquals('thisIsATest', StringHelper::toCamelCase('this_is_a_test'));
    }

    public function testToUpper()
    {
        $this->assertEquals('HELLO', StringHelper::toUpper('hello'));
    }

    public function testToLower()
    {
        $this->assertEquals('world', StringHelper::toLower('WORLD'));
    }

    public function testLimit()
    {
        $this->assertEquals('This is a...', StringHelper::limit('This is a long string that needs trimming', 12));
        $this->assertEquals('Short', StringHelper::limit('Short', 10));
    }

    public function testStartsWith()
    {
        $this->assertTrue(StringHelper::startsWith('hello world', 'hello'));
        $this->assertFalse(StringHelper::startsWith('hello world', 'world'));
    }

    public function testEndsWith()
    {
        $this->assertTrue(StringHelper::endsWith('hello world', 'world'));
        $this->assertFalse(StringHelper::endsWith('hello world', 'hello'));
    }

    public function testContains()
    {
        $this->assertTrue(StringHelper::contains('hello world', 'lo wo'));
        $this->assertFalse(StringHelper::contains('hello world', 'planet'));
    }
    
    public function testSlugifyWithCustomSeparator()
    {
        $this->assertEquals('hello_world', StringHelper::slugify('Hello World!', '_'));
        $this->assertEquals('a_simple_title', StringHelper::slugify('A Simple Title', '_'));
        $this->assertEquals('n_a', StringHelper::slugify('   ', '_'));
        $this->assertEquals('cafe_au_lait', StringHelper::slugify('Café au lait', '_'));
    }

}
