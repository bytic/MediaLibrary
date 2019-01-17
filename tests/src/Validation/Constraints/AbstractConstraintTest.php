<?php

namespace ByTIC\MediaLibrary\Tests\Validation\Constraints;

use ByTIC\MediaLibrary\Tests\AbstractTest;
use ByTIC\MediaLibrary\Validation\Constraints\ImageConstraint;

/**
 * Class AbstractConstraintTest
 * @package ByTIC\MediaLibrary\Tests\Validation\Constraints
 */
class AbstractConstraintTest extends AbstractTest
{
    public function testGetErrorMessage()
    {
        $constraint = new ImageConstraint();

        self::assertSame(
            null,
            $constraint->getErrorMessage(879789)
        );
        self::assertSame(
            'SIZE_NOT_DETECTED_ERROR',
            $constraint->getErrorMessage(ImageConstraint::SIZE_NOT_DETECTED_ERROR)
        );
    }
}