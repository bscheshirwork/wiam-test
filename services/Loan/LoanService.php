<?php

namespace app\services\Loan;

use Override;
use app\contracts\Loan\CreateLoanDto;
use app\contracts\Loan\LoanServiceInterface;
use app\contracts\Loan\LoanStatusEnum;
use app\contracts\Loan\ProcessLoansDto;
use app\models\Loan;
use yii\web\ServerErrorHttpException;

final class LoanService implements LoanServiceInterface
{
    #[Override]
    public function createLoan(CreateLoanDto $createLoanDto): int
    {
        return Loan::createLoan($createLoanDto);
    }

    #[Override]
    public function processLoans(ProcessLoansDto $processLoansDto): bool
    {
        /** @var Loan $loan */
        foreach (Loan::getNewLoans() as $loan) {
            sleep($processLoansDto->delay);
            $rand = rand(0, 100);
            $status = $rand >= 90 ?
                LoanStatusEnum::APPROVED :
                LoanStatusEnum::DECLINED;
            if ($status === LoanStatusEnum::APPROVED) {
                //проверка на то, что не сохранили в другом потоке (без PostgreSQL).
                $loanId = Loan::getApprovedLoanIdByUserId($loan->userId);
                if ($loanId === null) {
                    $loan->status = LoanStatusEnum::APPROVED;
                } elseif ($loanId === $loan->id) {
                    continue;
                } else {
                    $loan->status = LoanStatusEnum::DECLINED;
                }
            } else {
                $loan->status = LoanStatusEnum::DECLINED;
            }

            if (!$loan->save()) {
                throw new ServerErrorHttpException('Failed to update loan');
            }
        }

        return true;
    }
}
