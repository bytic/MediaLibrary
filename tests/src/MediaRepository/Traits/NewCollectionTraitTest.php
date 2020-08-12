<?php

namespace ByTIC\MediaLibrary\Tests\MediaRepository\Traits;

use ByTIC\MediaLibrary\Loaders\Filesystem;
use ByTIC\MediaLibrary\MediaRepository\MediaRepository;
use ByTIC\MediaLibrary\Tests\AbstractTest;
use ByTIC\MediaLibrary\Tests\Fixtures\Models\Articles\Article;

/**
 * Class NewCollectionTraitTest.
 */
class NewCollectionTraitTest extends AbstractTest
{
    public function testPrepareCollectionImages()
    {
        $repository = new MediaRepository();
        $repository->setRecord(new Article());

        $collection = $repository->getCollection('images');
        self::assertSame('images', $collection->getMediaType());
    }

    public function testPrepareCollectionFiles()
    {
        $article = new Article();
        $article->getMediaRepository()->getCollection('files')->setLoaderClass(Filesystem::class);

        $collection = $article->getFiles();
        self::assertSame('files', $collection->getMediaType());
    }
}
