<?php

namespace app\bootstraps;

use app\contracts\Loan\LoanServiceInterface;
use app\services\Loan\LoanService;
use Yii;
use yii\base\BootstrapInterface;

final class Loan implements BootstrapInterface
{
    public function bootstrap($app): void
    {
        Yii::$container->setSingleton(LoanServiceInterface::class, LoanService::class);
    }
}
