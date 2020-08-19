<?php

namespace ByTIC\MediaLibrary\Tests\Fixtures\Models;

use ByTIC\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

/**
 * Class HasConversionsModel.
 */
class HasConversionsModel extends HasMediaModel implements HasMediaConversions
{
    protected $managerName = HasMediaModelManager::class;

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10)
            ->optimize();
    }
}
