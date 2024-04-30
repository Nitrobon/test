<?php

namespace App\Services;

use App\Enums\FieldType;
use InvalidArgumentException;

class TextField extends Field
{
    public function __construct(string $name, FieldType $type, mixed $value, ?string $format = null) {
        if (!is_string($value)) {
            throw new InvalidArgumentException("Value for TextField must be a string. Given type: " . gettype($value));
        }
        parent::__construct($name, $type, $value, $format);
    }

    public function formatValue(): string
    {
        return htmlspecialchars($this->value, ENT_QUOTES, 'UTF-8');
    }
}
