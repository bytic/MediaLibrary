<?php

declare(strict_types=1);

namespace ByTIC\MediaLibrary\Support;

use ByTIC\MediaLibrary\Utility\MediaModels as UtilityMediaModels;

/**
 * @deprecated Use ByTIC\MediaLibrary\Utility\MediaModels instead.
 */
class MediaModels extends UtilityMediaModels
{
    public static function __callStatic($name, $arguments)
    {
        trigger_error(
            sprintf('%s is deprecated; use %s instead.', __CLASS__, UtilityMediaModels::class),
            E_USER_DEPRECATED
        );

        return forward_static_call_array([UtilityMediaModels::class, $name], $arguments);
    }
}
