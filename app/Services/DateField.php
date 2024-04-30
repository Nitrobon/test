<?php

namespace App\Services;

use App\Enums\FieldType;
use DateTime;
use InvalidArgumentException;

class DateField extends Field
{
    public function __construct(string $name, FieldType $type, mixed $value, ?string $format = null) {
        if (!($value instanceof DateTime || strtotime($value) !== false)) {
            throw new InvalidArgumentException("Value for DateField must be a valid date. Given value: " . $value);
        }
        parent::__construct($name, $type, $value, $format);
    }
    public function formatValue(): string
    {
        try {
            $date = new DateTime($this->value);
            return $date->format($this->format ?: 'Y-m-d');
        } catch (\Exception $e) {
            return "Invalid date";
        }
    }
}
