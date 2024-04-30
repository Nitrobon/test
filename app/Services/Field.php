<?php

namespace App\Services;

use App\Enums\FieldType;

abstract class Field
{

    protected string $name;
    protected FieldType $type;
    protected mixed $value;
    protected ?string $format;

    public function __construct(string $name, FieldType $type, mixed $value, ?string $format = null) {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->format = $format;
    }

    abstract public function formatValue(): mixed;

    public function getName(): string {
        return $this->name;
    }

    public function getType(): FieldType {
        return $this->type;
    }

    public function getValue(): mixed {
        return $this->value;
    }
    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function getFormattedValue(): mixed {
        return $this->formatValue();
    }
}
