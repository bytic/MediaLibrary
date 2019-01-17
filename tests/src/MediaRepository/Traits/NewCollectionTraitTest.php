<?php

namespace ByTIC\MediaLibrary\Tests\MediaRepository\Traits;

use ByTIC\MediaLibrary\MediaRepository\MediaRepository;
use ByTIC\MediaLibrary\Tests\AbstractTest;
use ByTIC\MediaLibrary\Tests\Fixtures\Models\Articles\Article;

/**
 * Class NewCollectionTraitTest
 * @package ByTIC\MediaLibrary\Tests\MediaRepository\Traits
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

        $collection = $article->getFiles();
        self::assertSame('files', $collection->getMediaType());
    }
}
