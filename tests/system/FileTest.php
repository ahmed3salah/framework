<?php

namespace system;

use App\system\File;
use PHPUnit\Framework\TestCase;
use Webmozart\Assert\Assert;


class FileTest extends TestCase
{

    public function setUp(): void
    {
        # create a test empty file
        $file_test = fopen(Assets('/images/test.png'), 'wb') or die('Error while creating the test file');
        fclose($file_test);
    }

    public function testGettingFile(){

        $file = new File(Assets('/images/test.png'));

        $this->assertFileExists($file->getPath());
        $this->assertEquals('test', $file->getName());
        $this->assertEquals('png', $file->getExt());
    }

    public function testCopy()
    {
        $dest_path = '/images/new.png';

        $file = new File(Assets('/images/test.png'));

        $file->copy(Assets($dest_path));

        $file = new File(Assets($dest_path));

        $this->assertFileExists($file->getPath());
        $this->assertEquals('new', $file->getName());
        $this->assertEquals('png', $file->getExt());
        $this->assertEquals('new.png', $file->getBaseName());
        

        unlink(Assets($dest_path));
    }

    public function testCut()
    {
        $dest_path = ('./images/cut_test.png');

        $file = new File(Assets('./images/test.png'));

        $file->move(Assets($dest_path));

        $file = new File(Assets($dest_path));

        $this->assertFileExists($file->getPath());
        $this->assertEquals('cut_test', $file->getName());
        $this->assertEquals('png', $file->getExt());
        $this->assertEquals('cut_test.png', $file->getBaseName());

        unlink(Assets($dest_path));

    }

    public function testRename()
    {
        $file = new File(Assets('./images/test.png'));

        $file->rename(Assets('./images/test_edited.png'));

        $this->assertFileExists($file->getPath());
        $this->assertEquals('test_edited', $file->getName());
        $this->assertEquals('png', $file->getExt());
        $this->assertEquals('test_edited.png', $file->getBaseName());

        $file->rename(Assets('./images/test.png'));
    }
}
