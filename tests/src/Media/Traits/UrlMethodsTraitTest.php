<?php

namespace ByTIC\MediaLibrary\Tests\Media\Traits;

use ByTIC\MediaLibrary\MediaRepository\MediaRepository;
use ByTIC\MediaLibrary\Tests\AbstractTest;
use ByTIC\MediaLibrary\Tests\Fixtures\Models\HasConversionsModel;
use ByTIC\MediaLibrary\Tests\Fixtures\Models\HasMediaModelManager;
use ByTIC\MediaLibrary\UrlGenerator\BaseUrlGenerator;

/**
 * Class UrlMethodsTraitTest
 * @package ByTIC\MediaLibrary\Tests\Media\Traits
 */
class UrlMethodsTraitTest extends AbstractTest
{
    public function test_getUrl()
    {
        $record = new HasConversionsModel();
        $record->setManager(new HasMediaModelManager());

        $repository = new MediaRepository();
        $repository->setRecord($record);

        $media = $repository->getCollection('images')->newMedia();
        $generator = $media->getUrl();
        self::assertInstanceOf(BaseUrlGenerator::class, $generator);
    }
}
