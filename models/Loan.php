<?php

namespace app\models;

use app\contracts\Loan\CreateLoanDto;
use app\contracts\Loan\LoanStatusEnum;
use yii\web\ServerErrorHttpException;


/**
 * @property int $id
 * @property int $user_id
 * @property int $amount
 * @property int $term
 * @property LoanStatusEnum $status
 */
#[ModelAttribute(name: 'id', type: 'integer', label: 'ID', rules: [['required']])]
#[ModelAttribute(name: 'user_id', type: 'integer', label: 'User ID', rules: [['required']])]
#[ModelAttribute(name: 'amount', type: 'integer', label: 'Amount', rules: [['required']])]
#[ModelAttribute(name: 'term', type: 'integer', label: 'Term', rules: [['required']])]
#[ModelAttribute(name: 'status', type: LoanStatusEnum::class, label: 'Status', rules: [['required']])]
final class Loan extends BaseActiveRecord
{
    public static function tableName(): string
    {
        return '{{%loan}}';
    }

    public static function hasUser(int $userId): bool
    {
        return boolval(Loan::findOne([
            'user_id' => $userId,
            'status' => LoanStatusEnum::APPROVED->value,
        ])?->id ?? false);
    }

    public static function createLoan(CreateLoanDto $createLoanDto): int
    {
        $loan = new self();
        $loan->user_id = $createLoanDto->userId;
        $loan->amount = $createLoanDto->amount;
        $loan->term = $createLoanDto->term;
        $loan->status = LoanStatusEnum::NEW;

        if ($loan->save()) {
            return $loan->id;
        }

        throw new ServerErrorHttpException('Failed to create loan');
    }

    public static function getNewLoans(): iterable
    {
        foreach (Loan::find()
                     ->where([
                         'status' => LoanStatusEnum::NEW->value,
                     ])
                     ->each() as $loan) {
            yield $loan;
        }
    }
}
