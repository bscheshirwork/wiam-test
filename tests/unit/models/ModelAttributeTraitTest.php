<?php

namespace tests\unit\models;

use app\models\ModelAttribute;
use ArrayObject;
use PHPUnit\Framework\TestCase;
use tests\mock\CorrectEnum;
use tests\mock\ModelAttributeIncorrectValidator;
use tests\mock\ModelAttributeInlineValidator;
use tests\mock\ModelAttributeModelLevel0;
use tests\mock\ModelAttributeModelLevel1;
use tests\mock\ModelAttributeModelLevel2;
use tests\mock\ModelAttributeValidatorIsObject;
use yii\base\InvalidConfigException;
use yii\validators\Validator;

final class ModelAttributeTraitTest extends TestCase
{

    public function testRules()
    {
        $model = new ModelAttributeModelLevel0();
        $this->expectException(InvalidConfigException::class);
        $model->rules();
    }

    public function testGetAttributesConfig()
    {
        $model = new ModelAttributeModelLevel0();
        $attributesConfig = $model->getAttributesConfig();
        $this->assertIsArray($attributesConfig);
        $this->assertArrayHasKey('idFrom0', $attributesConfig);
        $this->assertArrayHasKey('statusFrom0', $attributesConfig);
        $this->assertEquals($attributesConfig['idFrom0'], new ModelAttribute(name: 'idFrom0', type: 'integer', label: 'ID', rules: [['required']]));
        $this->assertEquals($attributesConfig['statusFrom0'], new ModelAttribute(name: 'statusFrom0', type: CorrectEnum::class, label: 'Status', rules: [['required']]));

        $model1 = new ModelAttributeModelLevel1();
        $attributesConfig = $model1->getAttributesConfig();
        $this->assertEquals($attributesConfig['idFrom0'], new ModelAttribute(name: 'idFrom0', type: 'integer', label: 'IDFrom0In1', rules: [['required']]));
        $this->assertEquals($attributesConfig['statusFrom0'], new ModelAttribute(name: 'statusFrom0', type: CorrectEnum::class, label: 'StatusFrom0In1', rules: [['required']]));

        $model2 = new ModelAttributeModelLevel2();
        $attributesConfig = $model2->getAttributesConfig();
        $this->assertEquals($attributesConfig['idFrom0'], new ModelAttribute(name: 'idFrom0', type: 'integer', label: 'IDFrom0In2', rules: [['required']]));
        $this->assertArrayNotHasKey('statusFrom0', $attributesConfig);
        $this->assertEquals($attributesConfig['idFrom1'], new ModelAttribute(name: 'idFrom1', type: 'integer', label: 'IDFrom1In2', rules: [['required']]));
        $this->assertArrayNotHasKey('statusFrom1', $attributesConfig);
        $this->assertEquals($attributesConfig['id'], new ModelAttribute(name: 'id', type: 'integer', label: 'ID', rules: [['required']]));
        $this->assertEquals($attributesConfig['status'], new ModelAttribute(name: 'status', type: CorrectEnum::class, label: 'Status', rules: [['required']]));
    }

    public function testAttributeLabels()
    {
        $model = new ModelAttributeModelLevel0();
        $attributeLabels = $model->attributeLabels();
        $this->assertIsArray($attributeLabels);
        $this->assertEquals([
            'idFrom0' => 'ID',
            'statusFrom0' => 'Status',
        ], $attributeLabels);

        $model1 = new ModelAttributeModelLevel1();
        $attributeLabels = $model1->attributeLabels();
        $this->assertIsArray($attributeLabels);
        $this->assertEquals([
            'idFrom0' => 'IDFrom0In1',
            'statusFrom0' => 'StatusFrom0In1',
            'idFrom1' => 'ID',
            'statusFrom1' => 'Status',
        ], $attributeLabels);

        $model1 = new ModelAttributeModelLevel2();
        $attributeLabels = $model1->attributeLabels();
        $this->assertIsArray($attributeLabels);
        $this->assertEquals([
            'idFrom0' => 'IDFrom0In2',
            'idFrom1' => 'IDFrom1In2',
            'id' => 'ID',
            'status' => 'Status',
        ], $attributeLabels);
    }

    public function testCreateValidators()
    {
        $model = new ModelAttributeModelLevel0();
        $validators = $model->createValidators();
        $this->assertInstanceOf(ArrayObject::class, $validators);
        $expected = new ArrayObject([
            Validator::createValidator('required', $model, ['idFrom0']),
            Validator::createValidator('required', $model, ['statusFrom0']),
        ]);
        $this->assertEquals($expected, $validators);

        $model1 = new ModelAttributeModelLevel1();
        $validators = $model1->createValidators();
        $this->assertInstanceOf(ArrayObject::class, $validators);
        $expected = new ArrayObject([
            Validator::createValidator('required', $model, ['idFrom0']),
            Validator::createValidator('required', $model, ['statusFrom0']),
            Validator::createValidator('required', $model, ['idFrom1']),
            Validator::createValidator('required', $model, ['statusFrom1']),
        ]);
        $this->assertEquals($expected, $validators);

        $model2 = new ModelAttributeModelLevel2();
        $validators = $model2->createValidators();
        $this->assertInstanceOf(ArrayObject::class, $validators);
        $expected = new ArrayObject([
            Validator::createValidator('required', $model, ['idFrom0']),
            Validator::createValidator('required', $model, ['idFrom1']),
            Validator::createValidator('required', $model, ['id']),
            Validator::createValidator('required', $model, ['status']),
        ]);
        $this->assertEquals($expected, $validators);
    }

    public function testCreateValidatorObject()
    {
        $model = new ModelAttributeValidatorIsObject();
        $validators = $model->createValidators();
        $this->assertInstanceOf(ArrayObject::class, $validators);
        $expected = new ArrayObject([
            Validator::createValidator('required', $model, ['id'])
        ]);
        $this->assertEquals($expected, $validators);
    }

    public function testCreateValidatorInline()
    {
        $model = new ModelAttributeInlineValidator();
        $validators = $model->createValidators();
        $this->assertInstanceOf(ArrayObject::class, $validators);
        $expected = new ArrayObject([
            Validator::createValidator('someFilter', $model, ['id'])
        ]);
        $this->assertEquals($expected, $validators);
    }

    public function testCreateValidatorInvalid()
    {
        $this->expectException(InvalidConfigException::class);
        new ModelAttributeIncorrectValidator()->createValidators();
    }
}
