<?php

namespace tests\mock;

use app\models\ModelAttribute;
use app\models\ModelAttributeTrait;
use yii\base\Model;
use yii\validators\RequiredValidator;

#[ModelAttribute(name: 'id', type: 'integer', label: 'ID', rules: [new RequiredValidator(['attributes' => ['id']])])]
class ModelAttributeValidatorIsObject extends Model
{
    use ModelAttributeTrait;
}
