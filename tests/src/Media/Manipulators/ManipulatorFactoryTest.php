<?php

namespace ByTIC\MediaLibrary\Tests\Media\Manipulators;

use ByTIC\MediaLibrary\Media\Manipulators\Images\ImageManipulator;
use ByTIC\MediaLibrary\Media\Manipulators\ManipulatorFactory;
use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\Tests\AbstractTest;
use League\Flysystem\Adapter\Local;
use Nip\Filesystem\File;
use Nip\Filesystem\FileDisk;

/**
 * Class ManipulatorFactoryTest
 * @package ByTIC\MediaLibrary\Tests\Media\Manipulators
 */
class ManipulatorFactoryTest extends AbstractTest
{
    public function testCreateForMediaImage()
    {
        $fileSystem = new FileDisk((new Local(TEST_FIXTURE_PATH . '/test-files')));

        $file = new File($fileSystem, '/image1.gif');

        $media = new Media();
        $media->setFile($file);

        $manipulator = ManipulatorFactory::createForMedia($media);
        self::assertInstanceOf(ImageManipulator::class, $manipulator);
    }
}
