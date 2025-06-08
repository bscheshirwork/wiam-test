<?php

namespace app\modules\api;

use app\modules\api\modules\v1\Module;
use yii\base\BootstrapInterface;
use yii\base\Module as BaseModule;
use yii\rest\UrlRule;

final class Module extends BaseModule implements BootstrapInterface
{
    public $controllerNamespace = 'app\modules\api\controllers';

    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
            [
                'class' => UrlRule::class,
                'controller' => $this->getId() . '/v1/requests',
                'pluralize' => false,
            ],
            [
                'class' => UrlRule::class,
                'controller' => $this->getId() . '/v1/processor',
                'pluralize' => false,
            ],
        ]);
    }

    public function init()
    {
        parent::init();

        $this->setModule('v1', Module::class);
    }
}