<?php

namespace ByTIC\MediaLibrary\Tests\Media\Manipulators\Images\Drivers;

use ByTIC\MediaLibrary\Conversions\Manipulations\Manipulation;
use ByTIC\MediaLibrary\Conversions\Manipulations\ManipulationSequence;
use ByTIC\MediaLibrary\Media\Manipulators\Images\Drivers\ImagineDriver;
use ByTIC\MediaLibrary\Tests\AbstractTest;
use Intervention\Image\Interfaces\ImageInterface;
use League\Flysystem\Local\LocalFilesystemAdapter;
use Nip\Filesystem\File;
use Nip\Filesystem\FileDisk;

/**
 * Class ImagineDriverTest.
 */
class ImagineDriverTest extends AbstractTest
{
    public function testMakeImage()
    {
        $this->requireImageDriver();

        $fileSystem = new FileDisk(new LocalFilesystemAdapter(TEST_FIXTURE_PATH . '/test-files'));
        $file = new File($fileSystem, '/image1.gif');

        $driver = new ImagineDriver();
        $image = $driver->makeImage($file->read());

        self::assertInstanceOf(ImageInterface::class, $image);
    }

    public function testManipulateSupportsLegacyAliasesAndEncodesImage()
    {
        $this->requireImageDriver();

        $fileSystem = new FileDisk(new LocalFilesystemAdapter(TEST_FIXTURE_PATH . '/test-files'));
        $file = new File($fileSystem, '/image1.gif');
        $manipulations = new ManipulationSequence();
        $manipulations[] = Manipulation::create('orientate');
        $manipulations[] = Manipulation::create('fit', 1, 1);

        $output = (new ImagineDriver())->manipulate($file->read(), $manipulations, 'png');

        self::assertStringStartsWith("\x89PNG\r\n\x1a\n", $output);
    }

    private function requireImageDriver(): void
    {
        if (!extension_loaded('gd') && !extension_loaded('imagick')) {
            $this->markTestSkipped('Image tests require the GD or Imagick PHP extension.');
        }
    }
}
