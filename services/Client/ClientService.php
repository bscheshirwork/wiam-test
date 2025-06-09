<?php

namespace app\services\Client;

use app\contracts\Client\ClientServiceInterface;
use app\contracts\Client\LoanFilter;

final class ClientService implements ClientServiceInterface
{
    public function hasLoansFilter(LoanFilter $filter): bool {
        return false;
    }
}