<?php

namespace ByTIC\MediaLibrary\Tests\Media\Traits;

use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\MediaRepository\MediaRepository;
use ByTIC\MediaLibrary\Tests\AbstractTest;
use ByTIC\MediaLibrary\Tests\Fixtures\Models\Articles\Article;
use ByTIC\MediaLibrary\Tests\Fixtures\Models\HasConversionsModel;

/**
 * Class HasConversionsTraitTest
 * @package ByTIC\MediaLibrary\Tests\Media\Traits
 */
class HasConversionsTraitTest extends AbstractTest
{

    public function testPrepareCollectionImages()
    {
        $repository = new MediaRepository();
        $repository->setRecord(new HasConversionsModel());

        $media = $repository->getCollection('images')->newMedia();
        self::assertInstanceOf(Media::class, $media);
        self::assertSame(['thumb'], $media->getConversionNames());
    }
}
