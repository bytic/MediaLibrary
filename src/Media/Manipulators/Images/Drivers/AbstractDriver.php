<?php

namespace ByTIC\MediaLibrary\Media\Manipulators\Images\Drivers;

use ByTIC\MediaLibrary\Conversions\Manipulations\ManipulationSequence;

/**
 * Class AbstractDriver
 * @package ByTIC\MediaLibrary\Media\Manipulators\Images\Drivers
 */
abstract class AbstractDriver
{

    /**
     * @param $data
     * @param ManipulationSequence $manipulations
     * @param $extension
     * @return string
     */
    abstract public function manipulate($data, ManipulationSequence $manipulations, $extension);
}