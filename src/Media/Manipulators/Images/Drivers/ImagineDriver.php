<?php

namespace ByTIC\MediaLibrary\Media\Manipulators\Images\Drivers;

use ByTIC\MediaLibrary\Conversions\Manipulations\Manipulation;
use ByTIC\MediaLibrary\Conversions\Manipulations\ManipulationSequence;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver;
use Intervention\Image\ImageManager;
use Intervention\Image\Interfaces\ImageInterface;

/**
 * Class ImagineDriver.
 */
class ImagineDriver extends AbstractDriver
{
    /**
     * {@inheritdoc}
     */
    public function manipulate($data, ManipulationSequence $manipulations, $extension)
    {
        $image = $this->makeImage($data);
        $this->performManipulations($image, $manipulations);

        return $image->encodeUsingFileExtension($extension)->toString();
    }

    /**
     * @param $data
     *
     * @return ImageInterface
     */
    public function makeImage($data)
    {
        if (extension_loaded('gd')) {
            $driver = GdDriver::class;
        } elseif (extension_loaded('imagick')) {
            $driver = ImagickDriver::class;
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
