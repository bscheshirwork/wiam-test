<?php

namespace tests\mock;

use app\models\ModelAttribute;

#[ModelAttribute(name: 'idFrom0', type: 'integer', label: 'IDFrom0In2', rules: [['required']])]
#[ModelAttribute(name: 'idFrom1', type: 'integer', label: 'IDFrom1In2', rules: [['required']])]
#[ModelAttribute(name: 'id', type: 'integer', label: 'ID', rules: [['required']])]
#[ModelAttribute(name: 'status', type: CorrectEnum::class, label: 'Status', rules: [['required']])]
final class ModelAttributeModelLevel2 extends ModelAttributeModelLevel1
{

}
