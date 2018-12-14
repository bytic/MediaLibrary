<?php

namespace ByTIC\MediaLibrary\Tests\Fixtures\Models\Articles;

use ByTIC\MediaLibrary\HasMedia\HasMediaTrait;
use ByTIC\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Nip\Filesystem\FileDisk;
use League\Flysystem\Adapter\Local as LocalAdapter;
use Nip\Records\Record;

/**
 * Class Article
 * @package ByTIC\MediaLibrary\Tests\Fixtures\Models\Articles
 */
class Article extends Record implements HasMedia
{
    use HasMediaTrait;


    /**
     * @return FileDisk
     */
    public function getMediaFilesystemDisk()
    {
        $disk = new FileDisk(
            new LocalAdapter(TEST_FIXTURE_PATH . DIRECTORY_SEPARATOR . 'storage'),
            []
        );

        return $disk;
    }
}