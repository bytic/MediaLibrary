<?php

namespace ByTIC\MediaLibrary\Collections\Traits;

use ByTIC\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Trait HasRecordTrait.
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
