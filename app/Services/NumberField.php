<?php

namespace App\Services;

use App\Enums\FieldType;
use InvalidArgumentException;

class NumberField extends Field
{
    public function __construct(string $name, FieldType $type, mixed $value, ?string $format = null) {
        if (!is_numeric($value)) {
            throw new InvalidArgumentException("Value for NumberField must be numeric. Given type: " . gettype($value));
        }
        parent::__construct($name, $type, $value, $format);
        $this->format = $format ?: $this->determineFormat($value);
    }

    public function formatValue(): string {
        return sprintf($this->format, $this->value);
    }

    private function determineFormat($value): string {
        if (str_contains((string)$value, '.')) {
            $decimalPlaces = strlen(substr((string)$value, strpos((string)$value, '.') + 1));
            return "%." . $decimalPlaces . "f";
        }
        return "%.0f";
    }
}

