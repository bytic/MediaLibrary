<?php

namespace ByTIC\MediaLibrary\Tests\FileAdder\Traits;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\Exceptions\FileCannotBeAdded;
use ByTIC\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;
use ByTIC\MediaLibrary\FileAdder\FileAdder;
use ByTIC\MediaLibrary\Tests\AbstractTest;
use Symfony\Component\HttpFoundation\File\File as SymfonyFile;

/**
 * Class FileAdderProcessesTraitTest
 * @package ByTIC\MediaLibrary\Tests\FileAdder\Traits
 */
class FileAdderProcessesTraitTest extends AbstractTest
{
    public function testToMediaCollectionItemChecksDisallowedFile()
    {
        $collection = new Collection();
        $collection->acceptsMedia(function ($file) {
            if ($file instanceof SymfonyFile) {
                return false;
            }
            return true;
        });

        $fileAdder = new FileAdder();
        $fileAdder->setFile(TEST_FIXTURE_PATH . '/test-files/image1.gif');

        static::expectException(FileCannotBeAdded::class);
        $fileAdder->toMediaCollection($collection);
    }
}
