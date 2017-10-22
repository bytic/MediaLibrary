<?php

namespace ByTIC\MediaLibrary\Tests\Fixtures\Models;

use ByTIC\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

/**
 * Class HasConversionsModel
 * @package ByTIC\MediaLibrary\Tests\Fixtures\Models
 */
class HasConversionsModel extends HasMediaModel implements HasMediaConversions
{

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10)
            ->optimize();
    }

}