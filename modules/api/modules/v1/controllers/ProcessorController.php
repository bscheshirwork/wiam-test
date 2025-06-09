<?php

namespace app\modules\api\modules\v1\controllers;

use app\contracts\Loan\LoanServiceInterface;
use app\modules\api\controllers\BaseApiController;
use app\modules\api\modules\v1\requests\Loan\ProcessLoansRequest;
use app\modules\api\modules\v1\responses\ResponseSuccess;
use Yii;

final class ProcessorController extends BaseApiController
{
    public function actionIndex(int $delay): ResponseSuccess
    {
        $request = new ProcessLoansRequest();
        $request->load($this->getRequestData());
        if ($request->validate()) {
            $loanService = Yii::$container->get(LoanServiceInterface::class);
            $result = $loanService->processLoans($request->getProcessLoansDto());

            return new ResponseSuccess(['result' => $result]);
        }

        return new ResponseSuccess(['result' => false]);
    }
}
