<?php

namespace app\modules\api\controllers;

use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\rest\OptionsAction;
use yii\web\Response;

class BaseApiController extends Controller
{
    public function behaviors(): array
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'verbFilter' => [
                'class' => VerbFilter::class,
                'actions' => $this->verbs(),
            ],
        ];
    }

    protected function getRequestData(): array
    {
        if ($this->request->isPost) {
            return $this->request->post();
        }

        return $this->request->get();
    }

    public function actions(): array
    {
        return [
            'options' => [
                'class' => OptionsAction::class,
            ],
        ];
    }
}
