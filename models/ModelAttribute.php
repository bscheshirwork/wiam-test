<?php

namespace app\models;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class ModelAttribute
{
    public bool $isEnum;

    public function __construct(
        public string $name,
        public string $type,
        public string $label,
        public array $rules = [],
    ) {
        $this->isEnum = enum_exists($this->type);
    }
}
