<?php

namespace ByTIC\MediaLibrary\Media\Manipulators;

use ByTIC\MediaLibrary\Conversions\Conversion;
use ByTIC\MediaLibrary\Conversions\ConversionCollection;
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

        if (!$this->supportedExtensions()->contains(strtolower($media->getExtension()))) {
            return false;
        }
//        $urlGenerator = UrlGeneratorFactory::createForMedia($media);
//        if (method_exists($urlGenerator, 'getPath') && file_exists($media->getPath())
//            && $this->supportedMimetypes()->contains(strtolower(File::getMimetype($media->getPath())))) {
//            return true;
//        }
        return true;
    }

    /**
     * @param ConversionCollection $conversions
     * @param Media $media
     */
    public function performConversions(ConversionCollection $conversions, Media $media)
    {
        if (!$conversions->isEmpty()) {
            return;
        }

        foreach ($conversions as $conversion) {
            $this->performConversion($media, $conversion);
        }
    }

    /**
     * @param Media $media
     * @param Conversion $conversion
     */
    abstract public function performConversion(Media $media, Conversion $conversion);

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
