<?php

namespace app\contracts\Loan;

enum LoanStatusEnum: int
{
    case NEW = 0;
    case APPROVED = 1;
    case DECLINED = 2;
}
