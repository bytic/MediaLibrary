<?php

namespace ByTIC\MediaLibrary\Tests\FileAdder;

use ByTIC\MediaLibrary\FileAdder\FileAdder;
use ByTIC\MediaLibrary\FileAdder\FileAdderInterface;
use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\Tests\AbstractTest;
use ByTIC\MediaLibrary\Tests\Fixtures\Models\HasMediaModel;
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

    public function testCreateMediaWithoughtFile()
    {
        $fileAdder = new FileAdder();
        self::expectExceptionMessage(FileAdderInterface::NO_FILE_DEFINED);
        $fileAdder->getMedia();
    }

    public function testCreateMediaWithFileWithoughtMedia()
    {
        self::expectExceptionMessage(FileAdderInterface::NO_SUBJECT_DEFINED);
        $filePath = TEST_FIXTURE_PATH . '/test-files/image1.gif';

        $fileAdder = new FileAdder();
        $fileAdder->setFile($filePath);
        $media = $fileAdder->getMedia();
        self::assertInstanceOf(Media::class, $media);
    }

    public function testCreateMedia()
    {
        $filePath = TEST_FIXTURE_PATH . '/test-files/image1.gif';

        $fileAdder = new FileAdder();
        $fileAdder->setFile($filePath);

        $model = new HasMediaModel();
        $fileAdder->setSubject($model);

        $media = $fileAdder->getMedia();
        self::assertInstanceOf(Media::class, $media);
    }

}