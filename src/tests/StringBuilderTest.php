<?php 

namespace Jemer\StringHelper\test;

use PHPUnit\Framework\TestCase;
use Jemer\StringHelper\StringBuilder;

class StringBuilderTest extends TestCase
{
    public function testAddAndToString()
    {
        $builder = new StringBuilder();
        $builder->Add("Hello ");
        $builder->Add("World");
        $this->assertEquals("Hello World", $builder->ToString());
    }

    public function testAddIndented()
    {
        $builder = new StringBuilder();
        $builder->Add_Indented("Indented", 2);
        $this->assertEquals("\t\tIndented", $builder->ToString());
    }

    public function testAddNewLineText()
    {
        $builder = new StringBuilder();
        $builder->AddNewLineText("Hello");
        $expected = PHP_EOL . "Hello" . PHP_EOL;
        $this->assertEquals($expected, $builder->ToString());
    }

    public function testAddHorizontalLine()
    {
        $builder = new StringBuilder();
        $builder->AddHorizontalLine(5);
        $this->assertEquals(PHP_EOL . "-----" . PHP_EOL, $builder->ToString());
    }

    public function testAddComment()
    {
        $builder = new StringBuilder();
        $builder->AddComment("this is a comment");
        $this->assertEquals(PHP_EOL . "//this is a comment" . PHP_EOL, $builder->ToString());
    }

    public function testClear()
    {
        $builder = new StringBuilder();
        $builder->Add("test");
        $builder->Clear();
        $this->assertEquals("", $builder->ToString());
    }
}



?>