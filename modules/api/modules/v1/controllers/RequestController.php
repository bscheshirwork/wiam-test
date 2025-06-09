<?php

namespace app\modules\api\modules\v1\controllers;

use app\modules\api\controllers\BaseApiController;
use app\modules\api\modules\v1\requests\Loan\CreateLoanRequest;
use app\modules\api\modules\v1\responses\ResponseSuccess;
use app\modules\api\modules\v1\responses\ResponseValidationError;

final class RequestController extends BaseApiController
{
    public function actionIndex(): ResponseSuccess|ResponseValidationError
    {
        $request = new CreateLoanRequest();
        $request->load($this->getRequestData());
        if ($request->validate()) {

        }

        //note: было бы удобно для пользователей видить ошибка валидации, но в спецификации такого нет
        return new ResponseValidationError();
    }
}
