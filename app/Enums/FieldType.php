<?php

namespace App\Enums;

use App\Services\DateField;
use App\Services\Field;
use App\Services\NumberField;
use App\Services\TextField;

enum FieldType: string
{
    case Text = 'text';
    case Number = 'number';
    case Date = 'date';

    public function createField(string $name, mixed $value, ?string $format = null): Field
    {
        switch ($this) {
            case self::Text:
                return new TextField($name, $this, $value);
            case self::Number:
                return new NumberField($name, $this, $value, $format);
            case self::Date:
                return new DateField($name, $this, $value);
        }
    }
}
