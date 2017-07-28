<?php

namespace ByTIC\MediaLibrary\Media\Manipulator;

use ByTIC\MediaLibrary\Media\Media;
use Nip\Collection;

/**
 * Class AbstractManipulator
 * @package ByTIC\MediaLibrary\Media\Manipulator
 */
abstract class AbstractManipulator implements ManipulatorInterface
{
    /**
     * @param Media $media
     * @return bool
     */
    public function canConvert(Media $media): bool
    {
        if (!$this->requirementsAreInstalled()) {
            return false;
        }
        if ($this->supportedExtensions()->contains(strtolower($media->getExtension()))) {
            return true;
        }
//        $urlGenerator = UrlGeneratorFactory::createForMedia($media);
//        if (method_exists($urlGenerator, 'getPath') && file_exists($media->getPath())
//            && $this->supportedMimetypes()->contains(strtolower(File::getMimetype($media->getPath())))) {
//            return true;
//        }
        return false;
    }

    /**
     * @return bool
     */
    abstract public function requirementsAreInstalled(): bool;

    /**
     * @return Collection
     */
    abstract public function supportedExtensions(): Collection;

    /**
     * @return Collection
     */
    abstract public function supportedMimetypes(): Collection;
}
