<?php

namespace app\contracts\Client;

interface ClientServiceInterface
{
    public function hasLoansFilter(LoanFilter $filter): bool;
}
