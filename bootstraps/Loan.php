<?php

namespace app\bootstraps;

use app\contracts\Loan\LoanServiceInterface;
use app\services\Loan\LoanService;
use Override;
use Yii;
use yii\base\BootstrapInterface;

final class Loan implements BootstrapInterface
{
    #[Override]
    public function bootstrap($app): void
    {
        Yii::$container->setSingleton(LoanServiceInterface::class, LoanService::class);
    }
}
