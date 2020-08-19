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
     * @return BaseUrlGenerator
     */
    public static function create()
    {
        $pathGenerator = PathGeneratorFactory::create();

        $urlGenerator = new BaseUrlGenerator();
        $urlGenerator->setPathGenerator($pathGenerator);
        return $urlGenerator;
    }

    /**
     * @param Media|UrlMethodsTrait $media
     *
     * @param string $conversionName
     * @return UrlGeneratorInterface|BaseUrlGenerator
     * @noinspection PhpDocMissingThrowsInspection
     */
    public static function createForMedia(Media $media, string $conversionName = ''): UrlGeneratorInterface
    {
        $urlGenerator = static::create()
            ->setMedia($media);

        if (!empty($conversionName)) {
            /** @noinspection PhpUnhandledExceptionInspection */
            $conversion = $media->getConversions()->getByName($conversionName);

            $urlGenerator->setConversion($conversion);
        }

        return $urlGenerator;
    }
}
