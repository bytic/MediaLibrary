<?php

namespace ByTIC\MediaLibrary\Tests\Fixtures\Models\Articles;

use Nip\Records\RecordManager;

/**
 * Class Articles.
 *
 * @method Article getNew
 */
class Articles extends RecordManager
{

    public function generateModelClass($class = null)
    {
        return Article::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrimaryKey()
    {
        return 'id';
    }

    /**
     * {@inheritdoc}
     */
    public function getTable()
    {
        return 'articles';
    }
}
