<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%nomenclatures}}`.
 */
class m231226_180711_create_nomenclatures_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%nomenclatures}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'abbreviation' => $this->string()->notNull(),
        ]);

        $this->batchInsert('{{%nomenclatures}}', ['name', 'abbreviation'], [
            ['Piece', 'pcs'],
            ['Kilogram', 'kg'],
            ['Meter', 'm'],
            ['Liter', 'L'],
            ['Square Meter', 'm²'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%nomenclatures}}');
    }
}
