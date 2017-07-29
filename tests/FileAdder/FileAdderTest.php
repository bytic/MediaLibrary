<?php

namespace ByTIC\MediaLibrary\Tests\FileAdder;

use ByTIC\MediaLibrary\FileAdder\FileAdder;
use ByTIC\MediaLibrary\Tests\AbstractTest;
use Symfony\Component\HttpFoundation\File\File as SymfonyFile;

/**
 * Class FileAdderTest
 * @package ByTIC\MediaLibrary\Tests\FileAdder
 */
class FileAdderTest extends AbstractTest
{

    public function testSetFileString()
    {
        $filePath = TEST_FIXTURE_PATH . '/test-files/image1.gif';

        $fileAdder = new FileAdder();
        $fileAdder->setFile($filePath);
        self::assertSame($filePath, $fileAdder->getPathToFile());
        self::assertSame('image1.gif', $fileAdder->getFileName());
        self::assertSame('image1', $fileAdder->getMediaName());
        self::assertInstanceOf(SymfonyFile::class, $fileAdder->getFile());
    }

}