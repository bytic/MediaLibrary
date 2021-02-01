<?php

namespace ByTIC\MediaLibrary\Tests\HasMedia\Traits;

use ByTIC\MediaLibrary\Tests\AbstractTest;
use ByTIC\MediaLibrary\Tests\Fixtures\Models\HasMediaModel;
use ByTIC\MediaLibrary\Tests\Fixtures\Models\ModelWithDiskName;

/**
 * Class HasMediaFilesystemTraitTest
 * @package ByTIC\MediaLibrary\Tests\HasMedia\Traits
 */
class HasMediaFilesystemTraitTest extends AbstractTest
{
    public function test_getMediaFilesystemDiskName_null()
    {
        $model = new HasMediaModel();
        self::assertSame('public', $model->getMediaFilesystemDiskName());
    }

    public function test_getMediaFilesystemDiskName_with_custom_collection()
    {
        $model = new ModelWithDiskName();
        self::assertSame('custom-images', $model->getMediaFilesystemDiskName('my-images'));
    }

    public function test_getMediaFilesystemDiskName_with_disk_name()
    {
        $model = new ModelWithDiskName();
        self::assertSame('custom', $model->getMediaFilesystemDiskName());
    }
}
