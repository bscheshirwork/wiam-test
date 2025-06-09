<?php

namespace app\contracts\Loan;

final readonly class ProcessLoansDto
{
    public function __construct(
        public int $delay,
    )
    {
    }
}
