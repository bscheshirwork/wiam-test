<?php

namespace app\modules\api\requests;

use Override;
use yii\base\Model;

class BaseApiRequest extends Model
{
    #[Override]
    public function load($data, $formName = null): bool
    {
        if ($formName === null) {
            $formName = '';
        }

        return parent::load($data, $formName);
    }
}
