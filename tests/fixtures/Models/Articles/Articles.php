<?php

namespace ByTIC\MediaLibrary\Tests\Fixtures\Models\Articles;

use Nip\Records\RecordManager;

/**
 * Class Articles
 * @package ByTIC\MediaLibrary\Tests\Fixtures\Models\Articles
 *
 * @method Article getNew
 */
class Articles extends RecordManager
{

    /**
     * @inheritdoc
     */
    public function getPrimaryKey()
    {
        return 'id';
    }

    /**
     * @inheritdoc
     */
    public function getTable()
    {
        return 'articles';
    }
}