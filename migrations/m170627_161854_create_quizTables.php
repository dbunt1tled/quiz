<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m170627_161854_create_quizTables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull()->unique(),
            'password' => $this->string(255)->notNull()
        ]);

        $this->createTable('quiz', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->unique()
        ]);
        $this->createTable('question', [
            'id' => $this->primaryKey(),
            'quiz' => $this->integer()->notNull(),
            'name' => $this->integer(6)->notNull(),
            'count' => $this->integer(6)->notNull(),
            'answer' => $this->integer(6)->notNull(),
            'num_let' => $this->integer(6)->notNull(),
        ]);
        $this->createTable('highscore', [
            'id' => $this->primaryKey(),
            'score' => $this->integer(6)->notNull(),
            'user' => $this->integer()->notNull(),
            'quiz' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('users');
        $this->dropTable('quiz');
        $this->dropTable('question');
        $this->dropTable('highscore');
    }

}
