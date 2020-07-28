<?php

use yii\db\Migration;

/**
 * Class m200728_035013_cuestionarios
 */
class m200728_035013_cuestionarios extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%cuestionario}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->createTable('{{%respuesta}}', [
            'id' => $this->primaryKey(),
            'correcta' => $this->string()->notNull(),
            'respuestas' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'cuestionario_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_respuesta-cuestionario',
            'respuesta',
            'cuestionario_id',
            'cuestionario',
            'id',
            'no action',
            'no action'
          );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200728_035013_cuestionarios cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200728_035013_cuestionarios cannot be reverted.\n";

        return false;
    }
    */
}
