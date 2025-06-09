<?php

namespace app\services\Loan;
use app\contracts\Loan\CreateLoanDto;
use app\contracts\Loan\LoanServiceInterface;

final class LoanService implements LoanServiceInterface
{
    public function createLoan(CreateLoanDto $createLoanDto): int
    {
        return 42;
    }
}
