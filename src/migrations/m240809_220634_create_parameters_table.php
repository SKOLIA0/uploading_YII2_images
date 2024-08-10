<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%parameters}}`.
 */
class m240809_220634_create_parameters_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('parameters', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'type' => $this->integer(1)->notNull(),
            'icon' => $this->string(),        // Поле для хранения имени файла icon
            'icon_gray' => $this->string(),   // Поле для хранения имени файла icon_gray
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('parameters');
    }
}
