<?php

declare(strict_types=1);

namespace ByTIC\MediaLibrary\Utility;

use ByTIC\MediaLibrary\Loaders\Database;
use ByTIC\MediaLibrary\MediaLibraryServiceProvider;
use ByTIC\MediaLibrary\Models\MediaProperties\MediaProperties;
use ByTIC\MediaLibrary\Models\MediaRecords\MediaRecords;
use Exception;
use Nip\Config\Config;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class PackageConfig.
 */
class PackageConfig extends \ByTIC\PackageBase\Utility\PackageConfig
{
    use SingletonTrait;

    protected $name = MediaLibraryServiceProvider::NAME;

    public static function configPath(): string
    {
        return dirname(__DIR__, 2) . '/config/media-library.php';
    }

    /**
     * @return mixed|Config|string|null
     * @throws Exception
     */
    public static function diskName(string $default = 'public')
    {
        return static::instance()->get('disk_name', $default);
    }

    /**
     * @return mixed|Config|string|null
     * @throws Exception
     */
    public static function mediaModels(string $type, $default = null)
    {
        return static::instance()->get('media_models.' . $type, $default);
    }

    /**
     * @return mixed|Config|string|null
     * @throws Exception
     */
    public static function mediaModelsRecords($default = MediaRecords::class)
    {
        return static::mediaModels('records', $default);
    }

    /**
     * @return mixed|Config|string|null
     * @throws Exception
     */
    public static function mediaModelsProperties($default = MediaProperties::class)
    {
        return static::mediaModels('properties', $default);
    }

    /**
     * @return mixed|Config|string|null
     * @throws Exception
     */
    public static function mediaLoader($default = Database::class)
    {
        return static::instance()->get('media_loader', $default);
    }

    /**
     * @return mixed|Config|string|null
     * @throws Exception
     */
    public static function constraints(string $name, $default = null)
    {
        $configKey = 'contraints.' . $name;
        if (!static::has($configKey)) {
            return $default;
        }

        return static::instance()->get($configKey, $default);
    }
}
