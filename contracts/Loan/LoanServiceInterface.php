<?php

namespace app\contracts\Loan;

interface LoanServiceInterface
{
    public function createLoan(CreateLoanDto $createLoanDto): int;

    public function processLoans(ProcessLoansDto $processLoansDto): bool;
}
