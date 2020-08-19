<?php

namespace ByTIC\MediaLibrary\Media\Traits;

use ByTIC\MediaLibrary\UrlGenerator\UrlGeneratorFactory;
use function Nip\url;

/**
 * Trait UrlMethodsTrait
 * @package ByTIC\MediaLibrary\Media\Traits
 */
trait UrlMethodsTrait
{


    /**
     * Get the full url to a original media file.
     *
     * @param string $conversionName
     *
     * @return string
     */
    public function getFullUrl(string $conversionName = ''): string
    {
        return url()->to($this->getUrl($conversionName));
    }

    /**
     * Get the url to a original media file.
     *
     * @param string $conversionName
     *
     * @return string
     */
    public function getUrl(string $conversionName = '')
    {
        $conversionName = $conversionName ? $conversionName : ($this->hasConversion('default') ? 'default' : '');
        return UrlGeneratorFactory::createForMedia($this, $conversionName);
    }
}