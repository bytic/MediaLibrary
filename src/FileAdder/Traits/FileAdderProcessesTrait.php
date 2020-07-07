<?php

namespace ByTIC\MediaLibrary\FileAdder\Traits;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\Exceptions\FileCannotBeAdded;
use ByTIC\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;
use ByTIC\MediaLibrary\Media\Manipulators\ManipulatorFactory;
use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\PathGenerator\PathGeneratorFactory;
use ByTIC\MediaLibrary\Validation\Violations\ViolationsBag;
use Nip\Filesystem\File;

/**
 * Trait FileAdderProcessesTrait.
 */
trait FileAdderProcessesTrait
{
    /**
     * @param string|Collection $collection
     */
    public function toMediaCollection($collection)
    {
        if (is_string($collection)) {
            $collection = $this->getMediaRepository()->getCollection($collection);
        }
        $this->processMediaItem($collection);
    }

    /**
     * @param Collection $collection
     * @param Media      $media
     */
    protected function processMediaItem(Collection $collection, Media $media = null)
    {
        $this->guardAgainstDisallowedFileAdditions($collection, $this->getFile());

        $media = $media ? $media : $this->getMedia();
        $media->setCollection($collection);

        $this->copyMediaToFilesystem();
        $this->createMediaConversions();

        $collection->appendMedia($media);
    }

    protected function copyMediaToFilesystem()
    {
        $media = $this->getMedia();
        $destination = PathGeneratorFactory::create()::getBasePathForMediaOriginal($media);
        $destination .= DIRECTORY_SEPARATOR . $media->getCollection()->getStrategy()::makeFileName($this);

        $media->generateFileFromContent($destination, fopen($this->getPathToFile(), 'r'));

        $file = new File($media->getCollection()->getFilesystem(), $destination);
        $media->setFile($file);
    }

    protected function createMediaConversions()
    {
        $media = $this->getMedia();
        ManipulatorFactory::createForMedia($media)->performConversions(
            $this->getSubject()->getMediaConversions()->forCollection($media->getCollection()->getName()),
            $media
        );
    }

    /**
     * @param Collection $collection
     * @param mixed      $file
     */
    protected function guardAgainstDisallowedFileAdditions(Collection $collection, $file)
    {
        $guardTest = ($collection->acceptsMedia)($file);
        if ($guardTest instanceof ViolationsBag) {
            throw FileUnacceptableForCollection::createFromViolationsBag($file, $collection, $guardTest);
        }
        if ($guardTest === false) {
            throw new FileCannotBeAdded();
        }
    }
}
