<?php

namespace app\modules\api\modules\v1\responses;

final class ResponseValidationError extends BaseApiV1Response
{
    public int $statusCode = 400;

    public function __construct(array $config = [])
    {
        $this->data['result'] = false;

        parent::__construct($config);
    }
}
