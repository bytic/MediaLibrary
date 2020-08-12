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
    public function getRecord()
    {
        return $this->getMediaRepository()->getRecord();
    }
}
