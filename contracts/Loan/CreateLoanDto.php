<?php

namespace app\contracts\Loan;

final readonly class CreateLoanDto
{
    public function __construct(
        public int $userId,
        public int $amount,
        public int $term,
    )
    {
    }
}