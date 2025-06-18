<?php

namespace app\modules\api\modules\v1\requests\Loan;

use app\contracts\Client\ClientServiceInterface;
use app\contracts\Client\LoanFilter;
use app\contracts\Loan\CreateLoanDto;
use app\modules\api\modules\v1\requests\BaseApiV1Request;
use Yii;

final class CreateLoanRequest extends BaseApiV1Request
{
    public ?int $user_id = null;

    public ?int $amount = null;

    public ?int $term = null;

    public function rules(): array
    {
        return [
            [['user_id', 'amount', 'term'], 'required'],
            [['user_id', 'amount', 'term'], 'integer'],
            ['user_id', function ($attribute, $params): void {
                $clientService = Yii::$container->get(ClientServiceInterface::class);
                if ($clientService->hasLoansFilter(new LoanFilter((int) $this->{$attribute}))) {
                    $this->addError($attribute, 'Already concluded');
                }
            }],
        ];
    }

    public function getCreatedLoanDto(): CreateLoanDto
    {
        return new CreateLoanDto($this->user_id, $this->amount, $this->term);
    }
}
