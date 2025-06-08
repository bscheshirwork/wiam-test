<?php

namespace app\modules\api\controllers;

use yii\rest\Controller;

class BaseApiController extends Controller
{
    protected function getRequestData(): array
    {
        if ($this->request->isPost) {
            return $this->request->post();
        }

        return $this->request->get();
    }
}
