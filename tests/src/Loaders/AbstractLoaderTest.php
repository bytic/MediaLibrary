<?php

namespace ByTIC\MediaLibrary\Tests\Loaders;

use ByTIC\MediaLibrary\Loaders\Filesystem;
use ByTIC\MediaLibrary\Tests\AbstractTest;
use ByTIC\MediaLibrary\Tests\Fixtures\Models\Articles\Article;
use ByTIC\MediaLibrary\Tests\Fixtures\Models\Articles\Articles;
use Mockery;

/**
 * Class AbstractLoaderTest.
 */
class AbstractLoaderTest extends AbstractTest
{
    public function testGetBasePathGeneric()
    {
        $record = new Article();
        $record->id = 99;
        $record->getMediaRepository()->getCollection('files')->setLoaderClass(Filesystem::class);

        $collection = $record->getFiles();

        $loader = new Filesystem();
        $loader->setCollection($collection);

        self::assertSame('/files/articles/99/', $loader->getBasePath());
    }

    public function testGetBasePathCustom()
    {
        $record = Mockery::mock(Article::class)->makePartial();
        $record->shouldReceive('getFolderNameForMedia')->andReturn('articles-custom');
        $record->setManagerName(Articles::class);
        $record->id = 99;
        $record->getMediaRepository()->getCollection('files')->setLoaderClass(Filesystem::class);

        $collection = $record->getFiles();

        $loader = new Filesystem();
        $loader->setCollection($collection);

        self::assertSame('/files/articles-custom/99/', $loader->getBasePath());
    }
}
