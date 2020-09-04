<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

/**
 * Class OrgReportsFileStatus
 */
final class CreateMediaPropertiesTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('media-properties');

        $table->addColumn('model', 'string');
        $table->addColumn('model_id', 'biginteger');
        $table->addColumn('collection_name', 'string');

        $table->addColumn('custom_properties', 'json');

        $table->addIndex(['model']);
        $table->addIndex(['model_id']);
        $table->addIndex(['collection_name']);
        $table->addIndex(['model', 'model_id', 'collection_name'], ['unique' => true]);

        $table->save();

        $table->changeColumn('id', 'biginteger', ['identity' => true]);
        $table->save();
    }
}
