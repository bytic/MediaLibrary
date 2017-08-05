<?php

namespace ByTIC\MediaLibrary\Media\Manipulators\Images\Drivers;

use ByTIC\MediaLibrary\Conversions\Manipulations\Manipulation;
use ByTIC\MediaLibrary\Conversions\Manipulations\ManipulationSequence;
use ByTIC\MediaLibrary\Media\Media;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

/**
 * Class ImagineDriver
 * @package ByTIC\MediaLibrary\Media\Manipulators\Images\Drivers
 */
class ImagineDriver extends AbstractDriver
{

    /**
     * @param Media $media
     * @param ManipulationSequence $manipulations
     * @return string
     */
    public function manipulate(Media $media, ManipulationSequence $manipulations)
    {
        $image = $this->makeImage($media->getFile()->read());
        $this->performManipulations($image, $manipulations);

        $image->encode($media->getExtension());

        return $image->__toString();
    }

    /**
     * @param $data
     * @return Image
     */
    public function makeImage($data)
    {
        $manager = new ImageManager();
        return $manager->make($data);
    }

    /**
     * @param Image $image
     * @param ManipulationSequence $manipulations
     */
    protected function performManipulations($image, $manipulations)
    {
        foreach ($manipulations as $manipulation) {
            $this->performManipulation($image, $manipulation);
        }
    }

    /**
     * @param Image $image
     * @param Manipulation $manipulation
     */
    protected function performManipulation($image, $manipulation)
    {
        $methodName = $manipulation->getName();
        $image->{$methodName}(...$manipulation->getAttributes());
    }
}
