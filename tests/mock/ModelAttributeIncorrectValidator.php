<?php

namespace tests\mock;

use app\models\ModelAttribute;
use app\models\ModelAttributeTrait;
use yii\base\Model;

#[ModelAttribute(name: 'id', type: 'integer', label: 'ID', rules: ['incorrect'])]
class ModelAttributeIncorrectValidator extends Model
{
    use ModelAttributeTrait;
}
