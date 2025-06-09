<?php

namespace app\modules\api\modules\v1\requests\Loan;

use app\contracts\Loan\ProcessLoansDto;
use app\modules\api\modules\v1\requests\BaseApiV1Request;

final class ProcessLoansRequest extends BaseApiV1Request
{
    public ?int $delay = null;

    public function rules(): array
    {
        return [
            [['delay'], 'required'],
        ];
    }

    public function getProcessLoansDto(): ProcessLoansDto
    {
        return new ProcessLoansDto($this->delay);
    }
}
