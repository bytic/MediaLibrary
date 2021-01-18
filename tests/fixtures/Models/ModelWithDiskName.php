<?php

namespace ByTIC\MediaLibrary\Tests\Fixtures\Models;

use ByTIC\MediaLibrary\HasMedia\HasMediaTrait;
use ByTIC\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Nip\Records\Record;

/**
 * Class ModelWithDiskName.
 */
class ModelWithDiskName extends Record implements HasMedia
{
    use HasMediaTrait;

    public function generateMediaFilesystemDiskNameMyImages()
    {
        return 'custom-images';
    }

    public function generateMediaFilesystemDiskName()
    {
        return 'custom';
    }
}
