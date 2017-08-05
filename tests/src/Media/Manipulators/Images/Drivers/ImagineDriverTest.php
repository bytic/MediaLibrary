<?php

namespace ByTIC\MediaLibrary\Tests\Media\Manipulators\Images\Drivers;

use ByTIC\MediaLibrary\Media\Manipulators\Images\Drivers\ImagineDriver;
use ByTIC\MediaLibrary\Tests\AbstractTest;
use Intervention\Image\Image;
use League\Flysystem\Adapter\Local;
use Nip\Filesystem\File;
use Nip\Filesystem\FileDisk;

/**
 * Class ImagineDriverTest
 * @package ByTIC\MediaLibrary\Tests\Media\Manipulators\Images\Drivers
 */
class ImagineDriverTest extends AbstractTest
{
    public function testMakeImage()
    {
        $fileSystem = new FileDisk((new Local(TEST_FIXTURE_PATH . '/test-files')));
        $file = new File($fileSystem, '/image1.gif');

        $driver = new ImagineDriver();
        $image = $driver->makeImage($file->read());

        self::assertInstanceOf(Image::class, $image);
    }
}