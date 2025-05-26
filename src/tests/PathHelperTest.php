<?php 

namespace Jemer\StringHelper\test;

use PHPUnit\Framework\TestCase;
use Jemer\StringHelper\PathHelper;

class PathHelperTest extends TestCase
{
    private string $testFile;
    private string $testDir;

    protected function setUp(): void
    {
        $this->testDir = sys_get_temp_dir() . '/path_helper_test';
        mkdir($this->testDir);
        file_put_contents($this->testDir . '/file.txt', 'test');
        mkdir($this->testDir . '/subdir');
    }

    protected function tearDown(): void
    {
        unlink($this->testDir . '/file.txt');
        rmdir($this->testDir . '/subdir');
        rmdir($this->testDir);
    }

    public function testContainingDirectory()
    {
        $path = $this->testDir . '/file.txt';
        $this->assertEquals($this->testDir, PathHelper::ContainingDirectory($path));
    }

    public function testFileName()
    {
        $path = '/some/path/to/file.txt';
        $this->assertEquals('file.txt', PathHelper::FileName($path));
    }

    public function testExtension()
    {
        $path = '/some/path/to/file.txt';
        $this->assertEquals('txt', PathHelper::Extension($path));
    }

    public function testFileNameWithoutExtension()
    {
        $path = '/some/path/to/file.txt';
        $this->assertEquals('file', PathHelper::FileNamewithoutExtension($path));
    }

    public function testGeneratePath()
    {
        $path = ['folder', 'subfolder', 'file.txt'];
        $expected = 'folder' . DIRECTORY_SEPARATOR . 'subfolder' . DIRECTORY_SEPARATOR . 'file.txt';
        $this->assertEquals($expected, PathHelper::GeneratePath($path));
    }

    public function testGetFiles()
    {
        $files = PathHelper::GetFiles($this->testDir);
        $this->assertEquals(['file.txt'], $files);
    }

    public function testGetDirectories()
    {
        $dirs = PathHelper::GetDirectories($this->testDir);
        $this->assertEquals(['subdir'], $dirs);
    }
}


?>