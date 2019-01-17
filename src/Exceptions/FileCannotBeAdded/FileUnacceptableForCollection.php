<?php

namespace ByTIC\MediaLibrary\Exceptions\FileCannotBeAdded;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\Exceptions\FileCannotBeAdded;
use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\Validation\Violations\ViolationsBag;

/**
 * Class FileUnacceptableForCollection
 * @package ByTIC\MediaLibrary\Exceptions\FileCannotBeAdded
 */
class FileUnacceptableForCollection extends FileCannotBeAdded
{
    public $violations;

    /**
     * @param Media $media
     * @param Collection $collection
     * @param ViolationsBag $bag
     * @return FileUnacceptableForCollection
     */
    public static function createFromViolationsBag(Media $media, Collection $collection, ViolationsBag $bag)
    {
        $exception = new static(
            "The media was not accepted into the collection"
        );
        $exception->violations = $bag;
        return $exception;
    }
}