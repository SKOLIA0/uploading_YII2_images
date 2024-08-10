<?php

use yii\db\Migration;

/**
 * Class m240809_225034_add_original_name_to_parameters
 */
class m240809_225034_add_original_name_to_parameters extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('parameters', 'icon_original_name', $this->string()->after('icon'));
        $this->addColumn('parameters', 'icon_gray_original_name', $this->string()->after('icon_gray'));
    }

    public function safeDown()
    {
        $this->dropColumn('parameters', 'icon_original_name');
        $this->dropColumn('parameters', 'icon_gray_original_name');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240809_225034_add_original_name_to_parameters cannot be reverted.\n";

        return false;
    }
    */
}
