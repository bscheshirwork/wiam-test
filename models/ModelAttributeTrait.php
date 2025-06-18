<?php

namespace app\models;

use ArrayObject;
use ReflectionClass;
use yii\base\InvalidConfigException;
use yii\validators\Validator;

trait ModelAttributeTrait
{
    protected ?array $attributeLabels = null;

    private static array $attributesConfig = [];

    public static function getAttributesConfig(): array
    {
        if (!isset(static::$attributesConfig[static::class])) {
            $reflection = new ReflectionClass(static::class);
            static::$attributesConfig[static::class] = [];
            foreach ($reflection->getAttributes(ModelAttribute::class) as $attributeReflection) {
                $attribute = $attributeReflection->newInstance();
                static::$attributesConfig[static::class][$attribute->name] = $attribute;
            }
        }

        return static::$attributesConfig[static::class];
    }

    final public function rules(): array
    {
        throw new InvalidConfigException('The rules cannot be applied.');
    }

    public function attributeLabels(): array
    {
        return $this->attributeLabels ??= array_column(static::getAttributesConfig(), 'label');
    }

    public function createValidators(): ArrayObject
    {
        $validators = new ArrayObject();
        foreach (static::getAttributesConfig() as $attribute => $config) {
            foreach ($config->rules as $rule) {
                if ($rule instanceof Validator) {
                    $validators->append($rule);
                } elseif (is_array($rule) && isset($rule[0])) { // validator type
                    $validator = Validator::createValidator($rule[0], $this, (array) $attribute, array_slice($rule, 1));
                    $validators->append($validator);
                } else {
                    throw new InvalidConfigException('Invalid validation rule: a rule must specify validator type.');
                }
            }
        }

        return $validators;
    }
}
