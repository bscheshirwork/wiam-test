<?php

namespace app\modules\api\modules\v1\controllers;

use app\modules\api\controllers\BaseApiController;
use app\modules\api\modules\v1\requests\Loan\ProcessLoansRequest;
use app\modules\api\modules\v1\responses\ResponseSuccess;

final class ProcessorController extends BaseApiController
{
    public function actionIndex(int $delay): ResponseSuccess
    {
        $request = new ProcessLoansRequest();
        $request->load($this->getRequestData());
        if ($request->validate()) {

        }

        return new ResponseSuccess(['result' => false]);
    }
}
