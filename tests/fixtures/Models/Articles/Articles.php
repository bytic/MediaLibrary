<?php

namespace ByTIC\MediaLibrary\Tests\Fixtures\Models\Articles;

use ByTIC\MediaLibrary\HasMedia\HasMediaRecordsTrait;
use Nip\Records\RecordManager;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class Articles.
 *
 * @method Article getNew
 */
class Articles extends RecordManager
{
    use HasMediaRecordsTrait;
    use SingletonTrait;

    protected function initRelations()
    {
        $this->initRelationsMedia();
    }

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
