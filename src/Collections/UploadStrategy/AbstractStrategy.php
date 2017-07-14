<?php

namespace ByTIC\MediaLibrary\Collections\UploadStrategy;

/**
 * Class AbstractStrategy
 * @package ByTIC\MediaLibrary\Collections\UploadStrategy
 */
abstract class AbstractStrategy implements AbstractStrategyInterface
{
    /**
     * @param $fileAdder
     * @return mixed
     */
    abstract public static function makeFileName($fileAdder);
}