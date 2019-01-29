<?php

namespace ByTIC\MediaLibrary\HasMedia\Interfaces;

/**
 * Interface HasMediaConversions.
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
