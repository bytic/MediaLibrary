<?php

namespace ByTIC\MediaLibrary\FileAdder\Traits;

use ByTIC\MediaLibrary\Exceptions\RuntimeException;
use ByTIC\MediaLibrary\FileAdder\FileAdder;
use ByTIC\MediaLibrary\HasMedia\HasMediaTrait;
use ByTIC\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Nip\Utility\Oop;

/**
 * Trait HasSubjectTrait.
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
    public function hasSubject(): bool
    {
        if (!is_object($this->subject)) {
            return false;
        }
        $hasInterface = $this->subject instanceof HasMedia;
        if ($hasInterface) {
            return true;
        }
        if (Oop::classUsesTrait($this->subject, HasMediaTrait::class)) {
            throw new RuntimeException("Class " . get_class($this->subject) . " does not have the HasMedia interface");
        }
        return false;
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
