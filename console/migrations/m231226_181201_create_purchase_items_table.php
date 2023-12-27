<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%purchase_items}}`.
 */
class m231226_181201_create_purchase_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%purchase_items}}', [
            'id' => $this->primaryKey(),
            'purchase_id' => $this->integer()->notNull(),
            'nomenclature_id' => $this->integer()->notNull(),
            'description' => $this->text(),
            'quantity' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-purchase_items-purchase_id',
            '{{%purchase_items}}',
            'purchase_id',
            '{{%purchases}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-purchase_items-nomenclature_id',
            '{{%purchase_items}}',
            'nomenclature_id',
            '{{%nomenclatures}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-purchase_items-purchase_id', '{{%purchase_items}}');
        $this->dropForeignKey('fk-purchase_items-nomenclature_id', '{{%purchase_items}}');
        $this->dropTable('{{%purchase_items}}');
    }
}
