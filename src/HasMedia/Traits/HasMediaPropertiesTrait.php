<?php

namespace ByTIC\MediaLibrary\HasMedia\Traits;

use ByTIC\MediaLibrary\Support\MediaModels;

/**
 * Trait HasMediaPropertiesTrait
 * @package ByTIC\MediaLibrary\HasMedia\Traits
 */
trait HasMediaPropertiesTrait
{
    /**
     * @param $collection
     * @return \ByTIC\MediaLibrary\Models\MediaProperties\MediaProperty|\Nip\Records\AbstractModels\Record
     */
    public function mediaProperties($collection)
    {
        $propertiesRecord = MediaModels::properties()->for($this, $collection);
        if (!is_object($propertiesRecord)) {
            $propertiesRecord = $this->generateMediaProperties($collection);
        }

        return $propertiesRecord;
    }

    /**
     * @param $collection
     * @return \ByTIC\MediaLibrary\Models\MediaProperties\MediaProperty
     */
    protected function generateMediaProperties($collection)
    {
        $propertiesRecord = MediaModels::properties()->createFor($this, $collection);

        if ($this->hasRelation('MediaProperties')) {
            return $this->getRelation('MediaProperties')->getResults()->add($propertiesRecord);
        }
        return $propertiesRecord;
    }
}