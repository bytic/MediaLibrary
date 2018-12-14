<?php

namespace ByTIC\MediaLibrary\Collections\Traits;

use ByTIC\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Trait HasRecordTrait
 * @package ByTIC\MediaLibrary\Collections\Traits
 */
trait HasRecordTrait
{

    /**
     * @return HasMediaTrait|\Nip\Records\Record
     */
    protected function getRecord()
    {
        return $this->getMediaRepository()->getRecord();
    }
}