<?php

namespace app\contracts\Client;
final readonly class LoanFilter
{
    public function __construct(
        public int $userId,
    )
    {
    }
}