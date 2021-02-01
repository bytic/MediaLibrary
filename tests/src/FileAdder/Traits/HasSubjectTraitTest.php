<?php

namespace ByTIC\MediaLibrary\Tests\FileAdder\Traits;

use ByTIC\MediaLibrary\Exceptions\RuntimeException;
use ByTIC\MediaLibrary\FileAdder\FileAdder;
use ByTIC\MediaLibrary\Tests\AbstractTest;
use ByTIC\MediaLibrary\Tests\Fixtures\Models\HasMediaModel;
use ByTIC\MediaLibrary\Tests\Fixtures\Models\HasMediaWithoughtInterface;

/**
 * Class HasSubjectTraitTest
 * @package ByTIC\MediaLibrary\Tests\FileAdder\Traits
 */
class HasSubjectTraitTest extends AbstractTest
{
    public function test_hasSubject()
    {
        $adder = new FileAdder();
        self::assertFalse($adder->hasSubject());

        $model = new HasMediaModel();
        $adder->setSubject($model);
        self::assertTrue($adder->hasSubject());
    }

    public function test_hasSubject_no_interface()
    {
        $adder = new FileAdder();

        $model = new HasMediaWithoughtInterface();
        $adder->setSubject($model);
        $this->expectException(RuntimeException::class);
        $adder->hasSubject();
    }
}