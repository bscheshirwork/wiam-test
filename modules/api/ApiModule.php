<?php

namespace app\modules\api;

use app\modules\api\modules\v1\ApiV1Module;
use Override;
use yii\base\BootstrapInterface;
use yii\base\Module;
use yii\rest\UrlRule;

final class ApiModule extends Module implements BootstrapInterface
{
    public $controllerNamespace = 'app\modules\api\controllers';

    #[Override]
    public function bootstrap($app): void
    {
        $app->getUrlManager()->addRules([
            [
                'class' => UrlRule::class,
                'controller' => $this->id . '/v1/request',
                'pluralize' => true,
            ],
            [
                'class' => UrlRule::class,
                'controller' => $this->id . '/v1/processor',
                'pluralize' => false,
            ],
        ]);
    }

    #[Override]
    public function init(): void
    {
        parent::init();

        $this->setModules([
            'v1' => ApiV1Module::class,
        ]);
    }
}
