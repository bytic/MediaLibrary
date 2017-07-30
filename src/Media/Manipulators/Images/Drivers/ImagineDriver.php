<?php

namespace ByTIC\MediaLibrary\Media\Manipulators\Images\Drivers;

use ByTIC\MediaLibrary\Conversions\Manipulations\ManipulationSequence;
use ByTIC\MediaLibrary\Media\Media;
use Intervention\Image\Image;

/**
 * Class ImagineDriver
 * @package ByTIC\MediaLibrary\Media\Manipulators\Images\Drivers
 */
class ImagineDriver extends AbstractDriver
{

    /**
     * @param Media $media
     * @param ManipulationSequence $manipulations
     */
    public function manipulate(Media $media, ManipulationSequence $manipulations)
    {
        $image = Image::make($media->getFile()->read());
        $image = $this->performManipulations($image, $manipulations);
    }

    /**
     * @param $image
     * @param $manipulations
     */
    protected function performManipulations($image, $manipulations)
    {

    }
}