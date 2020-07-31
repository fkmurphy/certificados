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

        $this->createTable('{{%quiz}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
        
        // preguntas del cuestionario
        $this->createTable('{{%question}}', [
            'id' => $this->primaryKey(),
            'question' => $this->string()->notNull(),
            'correct_responses' => $this->string()->notNull(),
            'responses' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'type' => $this->integer()->notNull()->defaultValue(0),
            'quiz_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-question-quiz',
            'question',
            'quiz_id',
            'quiz',
            'id',
            'no action',
            'no action'
        );

        //respuesta por usuario
        // preguntas del cuestionario
        $this->createTable('{{%user_response}}', [
            'id' => $this->primaryKey(),
            'response' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'user_id' => $this->integer()->notNull(),
            'question_id' => $this->integer()->notNull(),
            'quiz_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->addForeignKey(
            'fk-user_response-user',
            'user_response',
            'user_id',
            'user',
            'id',
            'no action',
            'no action'
        );
        $this->addForeignKey(
            'fk-user_response-question',
            'user_response',
            'question_id',
            'question',
            'id',
            'no action',
            'no action'
        );
        $this->addForeignKey(
            'fk-user_response-quiz',
            'user_response',
            'quiz_id',
            'quiz',
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
        echo "m200728_035013_cuestionarios can be reverted.\n";
        $this->dropForeignKey('fk-user_response-quiz','user_response');
        $this->dropForeignKey('fk-user_response-question','user_response');
        $this->dropForeignKey('fk-user_response-user','user_response');

        $this->dropForeignKey('fk-question-quiz','question');

        $this->dropTable('{{%user_response}}');
        $this->dropTable('{{%question}}');
        $this->dropTable('{{%quiz}}');
        return true;
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

