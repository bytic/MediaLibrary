<?php

namespace ByTIC\MediaLibrary\Tests\Validation\Traits;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\Tests\AbstractTest;
use ByTIC\MediaLibrary\Validation\Validators\FileValidator;
use ByTIC\MediaLibrary\Validation\Validators\ImageValidator;

/**
 * Class HasValidatorTraitTest
 * @package ByTIC\MediaLibrary\Tests\Validation\Traits
 */
class HasValidatorTraitTest extends AbstractTest
{
    /**
     * @dataProvider getValidatorByMediaTypeData
     * @param string $type
     * @param string $class
     */
    public function testGetValidatorByMediaType($type, $class)
    {
        $collection = new Collection();
        if ($type !== null) {
            $collection->setMediaType($type);
        }

        $validator = $collection->getValidator();
        self::assertInstanceOf($class, $validator);
    }

    /**
     * @return array
     */
    public function getValidatorByMediaTypeData()
    {
        return [
            [null, FileValidator::class],
            ['images', ImageValidator::class],
            ['files', FileValidator::class],
        ];
    }
}