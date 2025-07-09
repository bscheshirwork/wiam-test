<?php

namespace tests\mock;

use app\models\ModelAttribute;

#[ModelAttribute(name: 'idFrom0', type: 'integer', label: 'IDFrom0In1', rules: [['required']])]
#[ModelAttribute(name: 'statusFrom0', type: CorrectEnum::class, label: 'StatusFrom0In1', rules: [['required']])]
#[ModelAttribute(name: 'idFrom1', type: 'integer', label: 'ID', rules: [['required']])]
#[ModelAttribute(name: 'statusFrom1', type: CorrectEnum::class, label: 'Status', rules: [['required']])]
class ModelAttributeModelLevel1 extends ModelAttributeModelLevel0
{

}
