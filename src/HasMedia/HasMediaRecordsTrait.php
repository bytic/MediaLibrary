<?php

namespace ByTIC\MediaLibrary\HasMedia;

use ByTIC\MediaLibrary\Support\MediaModels;

/**
 * Trait HasMediaRecordsTrait
 * @package ByTIC\MediaLibrary\HasMedia
 */
trait HasMediaRecordsTrait
{
    /**
     * @deprecated use initRelationsMedia
     */
    protected function initMediaRelations()
    {
        $this->initRelationsMedia();
    }

    protected function initRelationsMedia()
    {
        $this->morphMany(
            'Media',
            ['class' => get_class(MediaModels::records()), 'morphTypeField' => 'model', 'fk' => 'model_id']
        );

        $this->morphMany(
            'MediaProperties',
            ['class' => get_class(MediaModels::properties()), 'morphTypeField' => 'model', 'fk' => 'model_id']
        );
    }
}
