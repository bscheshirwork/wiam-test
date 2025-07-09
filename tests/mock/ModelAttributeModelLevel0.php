<?php

namespace tests\mock;

use app\models\ModelAttribute;
use app\models\ModelAttributeTrait;
use yii\base\Model;

#[ModelAttribute(name: 'idFrom0', type: 'integer', label: 'ID', rules: [['required']])]
#[ModelAttribute(name: 'statusFrom0', type: CorrectEnum::class, label: 'Status', rules: [['required']])]
class ModelAttributeModelLevel0 extends Model
{
    use ModelAttributeTrait;
}