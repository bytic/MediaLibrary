<?php

namespace ByTIC\MediaLibrary\UrlGenerator;

use ByTIC\MediaLibrary\Conversions\Conversion;
use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\PathGenerator\AbstractPathGenerator;
use Nip\Filesystem\FileDisk;

/**
 * Class AbstractUrlGenerator
 * @package ByTIC\MediaLibrary\UrlGenerator
 */
class AbstractUrlGenerator implements UrlGeneratorInterface
{
    /**
     * @var Media
     */
    protected $media;

    /**
     * @var Conversion
     */
    protected $conversion = null;

    /**
     * @var AbstractPathGenerator
     */
    protected $pathGenerator;

    public function getUrl(): string
    {
        if (!$this->media->hasFile()) {
            return $this->media->getCollection()->getDefaultMediaUrl();
        }

        return $this->getDisk()->getUrl($this->getPath());
    }

    public function getPath(): string
    {
        $convestion = $this->conversion instanceof Conversion ? $this->conversion->getName() : '';
        return $this->media->getPath($convestion);
    }

    public function setMedia(Media $media): UrlGeneratorInterface
    {
        $this->media = $media;

        return $this;
    }

    public function setConversion(Conversion $conversion): UrlGeneratorInterface
    {
        $this->conversion = $conversion;

        return $this;
    }

    public function setPathGenerator(AbstractPathGenerator $pathGenerator): UrlGeneratorInterface
    {
        $this->pathGenerator = $pathGenerator;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getUrl();
    }

//    protected function getDiskName(): string
//    {
//        return $this->conversion === null
//            ? $this->media->disk
//            : $this->media->conversions_disk;
//    }

    protected function getDisk(): FileDisk
    {
//        return app('filesystem')->disk($this->getDiskName());
        return $this->media->getFile()->getFilesystem();
    }
}
