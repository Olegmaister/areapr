<?php

use yii\db\Migration;

/**
 * Class m231226_102203_add_fields_to_user_table
 */
class m231226_102203_add_fields_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('{{%user}}', 'first_name', $this->string()->notNull()->after('id'));
        $this->addColumn('{{%user}}', 'last_name', $this->string()->notNull()->after('first_name'));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('{{%user}}', 'first_name');
        $this->dropColumn('{{%user}}', 'last_name');
    }

}
