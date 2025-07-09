<?php

namespace app\bootstraps;

use app\contracts\Client\ClientServiceInterface;
use app\services\Client\ClientService;
use Override;
use Yii;
use yii\base\BootstrapInterface;

final class Client implements BootstrapInterface
{
    #[Override]
    public function bootstrap($app): void
    {
        Yii::$container->setSingleton(ClientServiceInterface::class, ClientService::class);
    }
}
