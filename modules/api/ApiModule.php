<?php

namespace app\modules\api;

use app\modules\api\modules\v1\ApiV1Module;
use yii\base\BootstrapInterface;
use yii\base\Module;
use yii\rest\UrlRule;

final class ApiModule extends Module implements BootstrapInterface
{
    public $controllerNamespace = 'app\modules\api\controllers';

    public function bootstrap($app): void
    {
        $app->getUrlManager()->addRules([
            [
                'class' => UrlRule::class,
                'controller' => $this->id . '/v1/requests',
                'pluralize' => false,
            ],
            [
                'class' => UrlRule::class,
                'controller' => $this->id . '/v1/processor',
                'pluralize' => false,
            ],
        ]);
    }

    public function init(): void
    {
        parent::init();

        $this->setModules([
            'v1' => ApiV1Module::class,
        ]);
    }
}
