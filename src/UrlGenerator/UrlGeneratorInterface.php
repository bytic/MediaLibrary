<?php

namespace ByTIC\MediaLibrary\UrlGenerator;

use ByTIC\MediaLibrary\Conversions\Conversion;
use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\PathGenerator\AbstractPathGenerator;

/**
 * Interface UrlGeneratorInterface.
 */
interface UrlGeneratorInterface
{

    public function getUrl(): string;

    public function getPath(): string;

    public function setMedia(Media $media): self;

    public function setConversion(Conversion $conversion): self;

    public function setPathGenerator(AbstractPathGenerator $pathGenerator): self;

//    public function getTemporaryUrl(DateTimeInterface $expiration, array $options = []): string;
//
//    public function getResponsiveImagesDirectoryUrl(): string;
}
