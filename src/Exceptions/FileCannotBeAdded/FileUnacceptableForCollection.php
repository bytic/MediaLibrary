<?php

namespace ByTIC\MediaLibrary\Exceptions\FileCannotBeAdded;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\Exceptions\FileCannotBeAdded;
use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\Validation\Violations\ViolationsBag;

/**
 * Class FileUnacceptableForCollection.
 */
class FileUnacceptableForCollection extends FileCannotBeAdded
{
    public $violations;

    /**
     * @param mixed         $media
     * @param Collection    $collection
     * @param ViolationsBag $bag
     *
     * @return FileUnacceptableForCollection
     */
    public static function createFromViolationsBag($file, Collection $collection, ViolationsBag $bag)
    {
        $exception = new static(
            'The media was not accepted into the collection'
        );
        $exception->violations = $bag;

        return $exception;
    }
}
