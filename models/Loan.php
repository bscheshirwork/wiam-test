<?php

namespace app\models;

use app\contracts\Loan\CreateLoanDto;
use app\contracts\Loan\LoanStatusEnum;
use yii\db\ActiveRecord;
use yii\web\ServerErrorHttpException;


/**
 * @property int $id
 * @property int $user_id
 * @property int $amount
 * @property int $term
 * @property int $status
 */
final class Loan extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%loan}}';
    }

    public function rules(): array
    {
        return [
            [['user_id', 'amount', 'term', 'status'], 'required'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'amount' => 'Amount',
            'term' => 'Term',
            'status' => 'Status',
        ];
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
        $loan->status = LoanStatusEnum::NEW->value;

        if ($loan->save()) {
            return $loan->id;
        }

        throw new ServerErrorHttpException('Failed to create loan');
    }

    //todo должно работать. Нет времени тестить, пока onePiece
//    public static function getNewLoans(): iterable
//    {
//        yield Loan::find()
//            ->where([
//                'status' => LoanStatusEnum::NEW->value,
//            ])
//            ->each();
//    }

    public static function getNewLoans(): array
    {
        return Loan::find()
            ->where([
                'status' => LoanStatusEnum::NEW->value,
            ])
            ->all();
    }
}
