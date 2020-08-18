<?php

namespace ByTIC\MediaLibrary\UrlGenerator;

use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\Media\Traits\UrlMethodsTrait;
use ByTIC\MediaLibrary\PathGenerator\PathGeneratorFactory;

/**
 * Class UrlGeneratorFactory.
 */
class UrlGeneratorFactory
{
    /**
     * @param Media|UrlMethodsTrait $media
     *
     * @param string $conversionName
     * @return UrlGeneratorInterface|BaseUrlGenerator
     * @noinspection PhpDocMissingThrowsInspection
     */
    public static function createForMedia(Media $media, string $conversionName = ''): UrlGeneratorInterface
    {
        $pathGenerator = PathGeneratorFactory::create();

        $urlGenerator = new BaseUrlGenerator();

        $urlGenerator
            ->setMedia($media)
            ->setPathGenerator($pathGenerator);

        if ($conversionName !== '') {
            /** @noinspection PhpUnhandledExceptionInspection */
            $conversion = $media->getConversions()->getByName($conversionName);

            $urlGenerator->setConversion($conversion);
        }

        return $urlGenerator;
    }
}
