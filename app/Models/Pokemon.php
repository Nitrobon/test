<?php

namespace App\Models;

use App\Enums\FieldType;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class Pokemon
{
    public array $fields = [];
    public $id;
    public string $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function createPokemon(): void
    {
        $this->id = DB::table('pokemons')->insertGetId([
            'name' => $this->name,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * @throws Exception
     */
    public function addField(array $fieldData): void
    {
        if (isset($this->fields[$fieldData['name']])) {
            throw new Exception("Field with name '{$fieldData['name']}' already exists.");
        }

        $fieldType = FieldType::from($fieldData['type']);

        $fields = $fieldType->createField($fieldData['name'], $fieldData['value']);
        DB::table('pokemon_fields')->insert([
            'pokemon_id' => $this->id,
            'field_name' => $fields->getName(),
            'field_type' => $fields->getType(),
            'field_value' => $fields->getValue(),
            'field_format' => $fields->getFormat(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function getFields(): array {
        return $this->fields;
    }

    public function __toString() {
        $info = "Pokemon: {$this->name}\n";
        foreach ($this->fields as $name => $field) {
            $info .= "{$name}: {$field['value']} (Type: {$field['type']})\n";
        }
        return $info;
    }

    /**
     * Получает страницу покемонов из базы данных.
     *
     * @param int|null $page
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public static function getPokemonPage(?int $page = 1, int $perPage = 10): LengthAwarePaginator
    {
        return DB::table('pokemons')
            ->paginate($perPage, ['*'], 'page', $page);
    }

    /**
     * Получает покемона по ID.
     *
     * @param int $id
     * @return object|null
     */
    public static function getPokemonById(int $id): ?object
    {
        $pokemon = DB::table('pokemons')->where('id', $id)->first();

        if ($pokemon) {
            $pokemonInstance = new static($pokemon->name);
            $pokemonInstance->id = $pokemon->id;
            $pokemonInstance->loadFields();
            return $pokemonInstance;
        }

        return $pokemon;
    }

    /**
     * @return void
     */
    public function loadFields(): void
    {
        if (isset($this->id)) {
            $fields = DB::table('pokemon_fields')
                ->where('pokemon_id', $this->id)
                ->get();

            $this->fields = $fields->toArray();
        }
    }
}
