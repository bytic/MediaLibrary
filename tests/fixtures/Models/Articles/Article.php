<?php

namespace ByTIC\MediaLibrary\Tests\Fixtures\Models\Articles;

use ByTIC\MediaLibrary\HasMedia\HasMediaTrait;
use ByTIC\MediaLibrary\HasMedia\Interfaces\HasMedia;
use ByTIC\MediaLibrary\HasMedia\Interfaces\HasMedia;
use League\Flysystem\Adapter\Local as LocalAdapter;
use Nip\Filesystem\FileDisk;
use Nip\Records\Record;

/**
 * Class Article.
 */
class Article extends Record implements HasMedia
{
    use HasMediaTrait;

    public function getFolderNameForMedia()
    {
        return 'articles';
    }

    /**
     * @return FileDisk
     */
    public function getMediaFilesystemDisk()
    {
        $disk = new FileDisk(
            new LocalAdapter(TEST_FIXTURE_PATH.DIRECTORY_SEPARATOR.'storage'),
            []
        );

        return $disk;
    }
}
