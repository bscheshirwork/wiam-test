<?php

namespace app\services\Client;

use app\contracts\Client\ClientServiceInterface;
use app\contracts\Client\LoanFilter;
use app\models\Loan;
use Override;

final class ClientService implements ClientServiceInterface
{
    #[Override]
    public function hasLoansFilter(LoanFilter $filter): bool
    {
        return Loan::hasUser($filter->userId);
    }
}
