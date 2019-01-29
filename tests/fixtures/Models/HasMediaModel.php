<?php

namespace ByTIC\MediaLibrary\Tests\Fixtures\Models;

use ByTIC\MediaLibrary\HasMedia\HasMediaTrait;
use ByTIC\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Nip\Records\Record;

/**
 * Class HasMediaModel.
 */
class HasMediaModel extends Record implements HasMedia
{
    use HasMediaTrait;
}
