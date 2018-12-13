<?php

namespace ByTIC\MediaLibrary\Tests\HasMedia\StandardCollections;

use ByTIC\MediaLibrary\Loaders\Filesystem;
use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\Tests\AbstractTest;
use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\Tests\Fixtures\Models\Articles\Articles;

/**
 * Class FilesShortcodesTest
 * @package ByTIC\MediaLibrary\Tests\HasMedia\StandardCollections
 */
class FilesShortcodesTest extends AbstractTest
{
    public function testGetBasePathForMedia()
    {
        $manager = new Articles();
        $article = $manager->getNew();
        $article->id = 9;

        $mediaCollection = $article->getFiles();
        self::assertInstanceOf(Collection::class, $mediaCollection);

        $loader = $mediaCollection->getLoader();
        self::assertInstanceOf(Filesystem::class, $loader);
        self::assertSame('/files/articles/9/', $loader->getBasePath());
    }

    public function testGetFiles()
    {
        $manager = new Articles();
        $article = $manager->getNew();
        $article->id = 9;

        $mediaCollection = $article->getFiles();
        self::assertInstanceOf(Collection::class, $mediaCollection);
        self::assertCount(1, $mediaCollection);

        $file = $mediaCollection->get('test.txt');
        self::assertInstanceOf(Media::class, $file);
    }
}