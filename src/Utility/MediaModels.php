<?php

declare(strict_types=1);

namespace ByTIC\MediaLibrary\Utility;

use ByTIC\PackageBase\Utility\ModelFinder;
use ByTIC\MediaLibrary\MediaLibraryServiceProvider;
use ByTIC\MediaLibrary\Models\MediaProperties\MediaProperties;
use ByTIC\MediaLibrary\Models\MediaRecords\MediaRecords;
use Nip\Records\RecordManager;

/**
 * Class MediaModels.
 */
class MediaModels extends ModelFinder
{
    protected static array $models = [];

    /**
     * @return RecordManager|MediaRecords
     */
    public static function records()
    {
        return static::getModels('records', MediaRecords::class);
    }

    /**
     * @return RecordManager|MediaProperties
     */
    public static function properties()
    {
        return static::getModels('properties', MediaProperties::class);
    }

    protected static function packageName(): string
    {
        return MediaLibraryServiceProvider::NAME;
    }
}
