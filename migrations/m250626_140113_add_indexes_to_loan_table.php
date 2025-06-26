<?php

use yii\db\Migration;

class m250626_140113_add_indexes_to_loan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            '{{%idx-loan-user_id}}',
            '{{%loan}}',
            'user_id',
        );

        //postgresql partial index
        $command = $this->db->createCommand()->createIndex(
            '{{%idx-loan-user_id-approved}}',
            '{{%loan}}',
            ['user_id', 'status'],
            true
        );
        $command->setSql(
            $command->getRawSql() .
            ' WHERE user_id IS NOT NULL and status = 1'
        )->execute();
        /* @see LoanStatusEnum::APPROVED */
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            '{{%idx-loan-user_id-approved}}',
            '{{%loan}}',
        );
        $this->dropIndex(
            '{{%idx-loan-user_id}}',
            '{{%loan}}',
        );
    }
}
