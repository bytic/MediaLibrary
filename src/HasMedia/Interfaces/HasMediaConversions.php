<?php

namespace ByTIC\MediaLibrary\HasMedia\Interfaces;

/**
 * Interface HasMediaConversions
 * @package ByTIC\MediaLibrary\HasMedia\Interfaces
 */
interface HasMediaConversions extends HasMedia
{
    /**
     * Register the conversions that should be performed.
     *
     * @return array
     */
    public function initMediaConversions();
}