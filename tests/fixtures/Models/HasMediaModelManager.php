<?php

namespace ByTIC\MediaLibrary\Tests\Fixtures\Models;

use ByTIC\MediaLibrary\HasMedia\HasMediaRecordsTrait;
use Nip\Records\RecordManager;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class HasMediaModel.
 */
class HasMediaModelManager extends RecordManager
{
    use HasMediaRecordsTrait;
    use SingletonTrait;
}
