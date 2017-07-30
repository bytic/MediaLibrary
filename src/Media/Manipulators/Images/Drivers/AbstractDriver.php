<?php

namespace ByTIC\MediaLibrary\Media\Manipulators\Images\Drivers;

use ByTIC\MediaLibrary\Conversions\Manipulations\ManipulationSequence;
use ByTIC\MediaLibrary\Media\Media;

/**
 * Class AbstractDriver
 * @package ByTIC\MediaLibrary\Media\Manipulators\Images\Drivers
 */
abstract class AbstractDriver
{

    /**
     * @param Media $media
     * @param ManipulationSequence $manipulations
     */
    abstract public function manipulate(Media $media, ManipulationSequence $manipulations);

    /**
     * @param $media
     */
    public function save($media, $content)
    {

    }
}