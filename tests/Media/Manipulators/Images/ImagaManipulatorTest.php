<?php

namespace ByTIC\MediaLibrary\Tests\Media\Manipulators\Images;

use ByTIC\MediaLibrary\Media\Manipulators\Images\Drivers\ImagineDriver;
use ByTIC\MediaLibrary\Media\Manipulators\Images\ImageManipulator;
use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\Tests\AbstractTest;
use League\Flysystem\Adapter\Local;
use Nip\Filesystem\File;
use Nip\Filesystem\FileDisk;

/**
 * Class ImagaManipulatorTest
 * @package ByTIC\MediaLibrary\Tests\Media\Manipulators\Images
 */
class ImagaManipulatorTest extends AbstractTest
{
    public function testCreateForMediaImage()
    {
        $fileSystem = new FileDisk((new Local(TEST_FIXTURE_PATH . '/test-files')));

        $file = new File($fileSystem, '/image1.gif');

        $media = new Media();
        $media->setFile($file);

        $manipulator = new ImageManipulator();
        self::assertTrue($manipulator->canConvert($media));
    }

    public function testGetDriver()
    {
        $manipulator = new ImageManipulator();
        self::assertInstanceOf(ImagineDriver::class, $manipulator->getDriver());
    }
}
