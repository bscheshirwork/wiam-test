<?php

namespace app\modules\api\responses;

use yii\web\Response;

class BaseApiResponse extends Response
{
    public $format = self::FORMAT_JSON;
}
