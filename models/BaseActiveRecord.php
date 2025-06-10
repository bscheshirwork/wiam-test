<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord as YiiDbBaseActiveRecord;

class BaseActiveRecord extends ActiveRecord
{
    use ModelAttributeTrait;

    public static function populateRecord($record, $row): void
    {
        $attributesConfig = static::getAttributesConfig();
        $columns = static::getTableSchema()->columns;
        foreach ($row as $name => $value) {
            if ($attributesConfig[$name]->isEnum) {
                $row[$name] = $attributesConfig[$name]->type::from($value);
            } elseif (isset($columns[$name])) { // phpTypecast resolve \BackedEnum
                $row[$name] = $columns[$name]->phpTypecast($value);
            }
        }

        YiiDbBaseActiveRecord::populateRecord($record, $row);
    }
}
