<?php

namespace ByTIC\MediaLibrary\Tests\HasMedia;

use ByTIC\MediaLibrary\Tests\AbstractTest;
use ByTIC\MediaLibrary\Tests\Fixtures\Models\Articles\Articles;
use ByTIC\MediaLibrary\Models\MediaProperties\MediaProperties;
use ByTIC\MediaLibrary\Models\MediaRecords\MediaRecords;
use Nip\Records\Locator\ModelLocator;
use Nip\Records\Relations\Relation;

/**
 * Class HasMediaRecordsTraitTest
 * @package ByTIC\MediaLibrary\Tests\HasMedia
 */
class HasMediaRecordsTraitTest extends AbstractTest
{
    public function test_initRelationsMedia()
    {
        ModelLocator::set(MediaRecords::class, new MediaRecords());
        ModelLocator::set(MediaProperties::class, new MediaProperties());
        $manager = Articles::instance();

        $relation = $manager->getRelation('Media');
        self::assertInstanceOf(Relation::class, $relation);
        self::assertInstanceOf(MediaRecords::class, $relation->getWith());
    }
}