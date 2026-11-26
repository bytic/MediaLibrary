<?php

namespace ByTIC\MediaLibrary\Media\Manipulators\Images\Drivers;

use ByTIC\MediaLibrary\Conversions\Manipulations\Manipulation;
use ByTIC\MediaLibrary\Conversions\Manipulations\ManipulationSequence;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver;
use Intervention\Image\ImageManager;
use Intervention\Image\Interfaces\ImageInterface;
use ByTIC\MediaLibrary\Utility\PackageConfig;

/**
 * Class ImagineDriver.
 */
class ImagineDriver extends AbstractDriver
{
    protected int $quality = 95;

    public function __construct(?int $quality = null)
    {
        if ($quality !== null) {
            $this->quality = max(1, min(100, $quality));
        } else {
            $this->quality = PackageConfig::imageQuality($this->quality);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function manipulate($data, ManipulationSequence $manipulations, $extension)
    {
        $image = $this->makeImage($data);
        $this->performManipulations($image, $manipulations);

        $options = match (strtolower($extension)) {
            'jpg', 'jpeg' => [
                'quality' => $this->quality,
                'progressive' => true,
                'strip' => true,
            ],
            'png' => [
                'strip' => true,
            ],
            'webp' => [
                'quality' => $this->quality,
                'strip' => true,
            ],
            default => [],
        };

        return $image->encodeUsingFileExtension($extension, ...$options)->toString();
    }

    /**
     * @param $data
     *
     * @return ImageInterface
     */
    public function makeImage($data)
    {
        if (extension_loaded('imagick')) {
            $driver = ImagickDriver::class;
        } elseif (extension_loaded('gd')) {
            $driver = GdDriver::class;
        } else {
            throw new \RuntimeException(
                'Image manipulation requires either the GD or Imagick PHP extension.'
            );
        }

        return ImageManager::usingDriver($driver)->decode($data);
    }

    /**
     * @param ImageInterface       $image
     * @param ManipulationSequence $manipulations
     */
    protected function performManipulations($image, $manipulations)
    {
        foreach ($manipulations as $manipulation) {
            $this->performManipulation($image, $manipulation);
        }
    }

    /**
     * @param ImageInterface $image
     * @param Manipulation    $manipulation
     */
    protected function performManipulation($image, $manipulation)
    {
        $methodName = match ($manipulation->getName()) {
            'fit' => 'cover',
            'orientate' => 'orient',
            default => $manipulation->getName(),
        };
        $image->{$methodName}(...$manipulation->getAttributes());
    }
}
