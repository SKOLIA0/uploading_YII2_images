<?php

use yii\db\Migration;

class m240809_232949_alter_table_parameters_to_utf8mb4 extends Migration
{
    public function safeUp()
    {
        // Изменение кодировки таблицы на utf8mb4
        $this->execute('ALTER TABLE parameters CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    }

    public function safeDown()
    {
        // Возврат к предыдущей кодировке (например, если была utf8)
        $this->execute('ALTER TABLE parameters CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci');
    }
}
