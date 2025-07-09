<?php

namespace tests\mock;

use app\models\ModelAttribute;
use app\models\ModelAttributeTrait;
use yii\base\Model;


#[ModelAttribute(name: 'id', type: 'integer', label: 'ID', rules: [['someFilter']])]
class ModelAttributeInlineValidator extends Model
{
    use ModelAttributeTrait;

    public function someFilter($attribute, $params, $validatorObject, $attributeValue): void
    {
        $this->$attribute = $attributeValue;
    }
}
