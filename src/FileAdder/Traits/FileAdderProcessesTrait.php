<?php

namespace ByTIC\MediaLibrary\FileAdder\Traits;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\Exceptions\FileCannotBeAdded;
use ByTIC\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;
use ByTIC\MediaLibrary\Loaders\Filesystem;
use ByTIC\MediaLibrary\Media\Manipulators\ManipulatorFactory;
use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\PathGenerator\PathGeneratorFactory;
use ByTIC\MediaLibrary\Support\MediaModels;
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
     * @param Media|null $media
     */
    protected function processMediaItem(Collection $collection, Media $media = null)
    {
        $this->guardAgainstDisallowedFileAdditions($collection, $this->getFile());

        $media = $media ? $media : $this->getMedia();
        $media->setCollection($collection);

        $this->copyMediaToFilesystem($media);
        $this->createMediaConversions($media);
        $this->saveMediaRecord($media);

        $collection->appendMedia($media);
    }

    /**
     * @param Media|null $media
     */
    protected function copyMediaToFilesystem(Media $media = null)
    {
        $media = $media ? $media : $this->getMedia();
        $destination = PathGeneratorFactory::create()::getBasePathForMediaOriginal($media);
        $destination .= DIRECTORY_SEPARATOR . $media->getCollection()->getStrategy()::makeFileName($this);

        $media->generateFileFromContent($destination, fopen($this->getPathToFile(), 'r'));

        $file = new File($media->getCollection()->getFilesystem(), $destination);
        $media->setFile($file);
    }

    /**
     * @param Media|null $media
     */
    protected function createMediaConversions(Media $media = null)
    {
        $media = $media ? $media : $this->getMedia();

        ManipulatorFactory::createForMedia($media)->performConversions(
            $this->getSubject()->getMediaConversions()->forCollection($media->getCollection()->getName()),
            $media
        );
    }

    /**
     * @param Media|null $media
     */
    protected function saveMediaRecord(Media $media = null)
    {
        $media = $media ? $media : $this->getMedia();

        if ($media->getCollection()->getLoader() instanceof Filesystem) {
            return;
        }
        $propertiesRecord = $this->getSubject()->mediaProperties($media->getCollection());
        $propertiesRecord->saveDbLoaded(true);

        MediaModels::records()->createFor(
            $media->getFile(),
            $this->getSubject(),
            $media->getCollection()
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
