<?php

declare(strict_types=1);

namespace ByTIC\MediaLibrary\Utility;

use ByTIC\MediaLibrary\Models\MediaProperties\MediaProperties;
use ByTIC\MediaLibrary\Models\MediaRecords\MediaRecords;
use Nip\Records\Locator\ModelLocator;

/**
 * Class MediaModels.
 */
class MediaModels
{
    protected static array $models = [];

    /**
     * @return MediaRecords
     */
    public static function records()
    {
        return static::getModels('records', MediaRecords::class);
    }

    /**
     * @return MediaProperties
     */
    public static function properties()
    {
        return static::getModels('properties', MediaProperties::class);
    }

    /**
     * @param string $type
     * @param string $default
     * @return mixed
     */
    protected static function getModels($type, $default)
    {
        if (!isset(static::$models[$type])) {
            $modelManager = static::getConfigVar($type, $default);
            return static::$models[$type] = ModelLocator::get($modelManager);
        }

        return static::$models[$type];
    }

    /**
     * @param string $type
     * @param null|string $default
     * @return mixed
     */
    protected static function getConfigVar($type, $default = null)
    {
        $value = PackageConfig::get('media_models.' . $type);
        if ($value !== null) {
            return $value;
        }

        return $default;
    }
}
