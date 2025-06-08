<?php

namespace app\modules\api\requests;

use yii\base\Model;

class BaseApiRequest extends Model
{
    public function load($data, $formName = null): bool
    {
        if ($formName === null) {
            $formName = '';
        }

        return parent::load($data, $formName);
    }
}
