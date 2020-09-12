<?php

namespace ByTIC\MediaLibrary\Tests\Collections;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\Tests\AbstractTest;
use ByTIC\MediaLibrary\Validation\Constraints\ImageConstraint;

/**
 * Class CollectionTest
 * @package ByTIC\MediaLibrary\Tests\Collections
 */
class CollectionTest extends AbstractTest
{
    public function test_contraint_name_from_collection_name()
    {
        $collection = new Collection();
        $collection->setMediaType('images');
        $collection->setName('covers');

        $constraint = $collection->getConstraint();
        self::assertInstanceOf(ImageConstraint::class, $constraint);
        self::assertSame('covers', $constraint->getName());
    }

}
