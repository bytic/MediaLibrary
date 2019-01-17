<?php

namespace ByTIC\MediaLibrary\FileAdder\Traits;

use ByTIC\MediaLibrary\FileAdder\FileAdder;
use ByTIC\MediaLibrary\HasMedia\HasMediaTrait;
use ByTIC\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Trait HasSubjectTrait
 * @package ByTIC\MediaLibrary\FileAdder\Traits
 */
trait HasSubjectTrait
{

    /** @var HasMediaTrait|HasMedia subject */
    protected $subject;

    /**
     * @return HasMediaTrait|HasMedia
     */
    public function getSubject(): HasMedia
    {
        return $this->subject;
    }

    /**
     * @return bool
     */
    public function hasSubject()
    {
        return $this->subject instanceof HasMedia;
    }

    /**
     * @param HasMediaTrait $subject
     *
     * @return FileAdder|self
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

}