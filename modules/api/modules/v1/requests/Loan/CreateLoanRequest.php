<?php


namespace app\modules\api\modules\v1\requests\Loan;

use app\modules\api\modules\v1\requests\BaseApiV1Request;

final class CreateLoanRequest extends BaseApiV1Request
{
    public ?int $user_id = null;

    public ?int $amount = null;

    public ?int $term = null;

    public function rules(): array
    {
        return [
            [['user_id', 'amount', 'term'], 'required'],
        ];
    }
}
