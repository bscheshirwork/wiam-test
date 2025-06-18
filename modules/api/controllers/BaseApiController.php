<?php

namespace app\modules\api\controllers;

use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\rest\OptionsAction;
use yii\web\Response;

class BaseApiController extends Controller
{
    protected const BEHAVIOR_CONTENT_NEGOTIATION = 'contentNegotiation';

    protected const BEHAVIOR_VERB_FILTER = 'verbFilter';

    protected const BEHAVIOR_CORS_FILTER = 'corsFilter';

    public function behaviors(): array
    {
        return [
            self::BEHAVIOR_CONTENT_NEGOTIATION => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            self::BEHAVIOR_VERB_FILTER => [
                'class' => VerbFilter::class,
                'actions' => $this->verbs(),
            ],
            self::BEHAVIOR_CORS_FILTER => [
                'class' => Cors::class,
                'cors' => [
                    'Origin' => [
                        env('CORS_ORIGIN_SWAGGER', 'http://0.0.0.0:8001'),
                    ], //responseHeaders Access-Control-Allow-Origin
                    'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'], //Access-Control-Allow-Methods
                    'Access-Control-Request-Headers' => ['*'], // 'Access-Control-Allow-Headers'
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age' => 3600,
                ],
            ],
        ];
    }

    public function actions(): array
    {
        return [
            'options' => [
                'class' => OptionsAction::class,
            ],
        ];
    }

    public function afterAction($action, $result): Response
    {
        /** @var Cors $cors */
        $cors = $this->getBehavior(self::BEHAVIOR_CORS_FILTER);
        if ($cors->response->headers->count()) {
            foreach ($cors->response->headers as $name => $value) {
                $result->headers->set($name, $value);
            }
        }

        return $result;
    }

    protected function getRequestData(): array
    {
        if ($this->request->isPost) {
            return $this->request->post();
        }

        return $this->request->get();
    }
}
