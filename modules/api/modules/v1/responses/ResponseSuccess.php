<?php

namespace app\modules\api\modules\v1\responses;

final class ResponseSuccess extends BaseApiV1Response
{
    public int $statusCode = 200;

    public function __construct(array $data, array $config = [])
    {
        $this->data['result'] = true;
        $this->data += $data;

        parent::__construct($config);
    }
}
