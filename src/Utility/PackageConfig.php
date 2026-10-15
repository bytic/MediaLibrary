<?php

declare(strict_types=1);

namespace ByTIC\MediaLibrary\Utility;

use Nip\Config\Config;

/**
 * Class PackageConfig.
 */
class PackageConfig
{
    public static function configPath(): string
    {
        return dirname(__DIR__, 2) . '/config/media-library.php';
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get(string $key, $default = null)
    {
        if (!function_exists('config')) {
            return $default;
        }

        $config = config();
        if (!($config instanceof Config) && !is_object($config)) {
            return $default;
        }
        if (method_exists($config, 'has') && method_exists($config, 'get')) {
            $fullKey = 'media-library.' . $key;
            if ($config->has($fullKey)) {
                return $config->get($fullKey);
            }
        }

        return $default;
    }

    /**
     * @param string $key
     * @return bool
     */
    public static function has(string $key): bool
    {
        if (!function_exists('config')) {
            return false;
        }

        $config = config();
        if (!is_object($config) || !method_exists($config, 'has')) {
            return false;
        }

        return $config->has('media-library.' . $key);
    }
}
