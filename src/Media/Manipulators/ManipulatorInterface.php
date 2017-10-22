<?php

namespace ByTIC\MediaLibrary\Media\Manipulators;

use ByTIC\MediaLibrary\Media\Media;

/**
 * Interface ManipulatorInterface
 * @package ByTIC\MediaLibrary\Media\Manipulator
 */
interface ManipulatorInterface
{
    /**
     * @param Media $media
     * @return true
     */
    public function canConvert(Media $media);

}