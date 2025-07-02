<?php

namespace tests\unit\models;

use app\models\ModelAttribute;
use tests\mock\CorrectEnum;
use PHPUnit\Framework\TestCase;
use tests\mock\IncorrectEnum;

final class ModelAttributeTest extends TestCase
{

    public function test__construct()
    {
        $model = new ModelAttribute(
            'name',
            'string',
            'nameLabel',
            [['string']],
        );
        $this->assertInstanceOf(ModelAttribute::class, $model);
        $this->assertFalse($model->isEnum);

        $model = new ModelAttribute(
            'incorrectEnum',
            IncorrectEnum::class,
            'incorrectEnumLabel',
            [['required']],
        );
        $this->assertFalse($model->isEnum);

        $model = new ModelAttribute(
            'correctEnum',
            CorrectEnum::class,
            'correctEnumLabel',
            [['require']],
        );
        $this->assertTrue($model->isEnum);


    }
}
