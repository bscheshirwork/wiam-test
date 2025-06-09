<?php

namespace app\contracts\Loan;

interface LoanServiceInterface
{
    public function createLoan(CreateLoanDto $createLoanDto): int;
}
