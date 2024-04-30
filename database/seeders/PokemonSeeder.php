<?php

namespace Database\Seeders;

use App\Enums\FieldType;
use App\Models\Pokemon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pokemonData = [
            [
                'name' => 'Pikachu',
                'fields' => [
                    ['name' => 'Type', 'type' => FieldType::Text->value, 'value' => 'Electric'],
                    ['name' => 'Weight', 'type' => FieldType::Number->value, 'value' => '6'],
                ]
            ],
            [
                'name' => 'Charmander',
                'fields' => [
                    ['name' => 'Type', 'type' => FieldType::Text->value, 'value' => 'Fire'],
                    ['name' => 'Weight', 'type' => FieldType::Number->value, 'value' => '8.5'],
                ]
            ],
            [
                'name' => 'Bulbasaur',
                'fields' => [
                    ['name' => 'Type', 'type' => FieldType::Text->value, 'value' => 'Grass/Poison'],
                    ['name' => 'Weight', 'type' => FieldType::Number->value, 'value' => '6.9'],
                ]
            ],
            [
                'name' => 'Squirtle',
                'fields' => [
                    ['name' => 'Type', 'type' => FieldType::Text->value, 'value' => 'Water'],
                    ['name' => 'Weight', 'type' => FieldType::Number->value, 'value' => '9'],
                ]
            ],
            [
                'name' => 'Jigglypuff',
                'fields' => [
                    ['name' => 'Type', 'type' => FieldType::Text->value, 'value' => 'Normal/Fairy'],
                    ['name' => 'Weight', 'type' => FieldType::Number->value, 'value' => '5.5'],
                ]
            ],
            [
                'name' => 'Meowth',
                'fields' => [
                    ['name' => 'Type', 'type' => FieldType::Text->value, 'value' => 'Normal'],
                    ['name' => 'Weight', 'type' => FieldType::Number->value, 'value' => '4.2'],
                    ['name' => 'catch_time', 'type' => FieldType::Date->value, 'value' => '12.12.2012'],
                ]
            ],
            [
                'name' => 'Psyduck',
                'fields' => [
                    ['name' => 'Type', 'type' => FieldType::Text->value, 'value' => 'Water'],
                    ['name' => 'Weight', 'type' => FieldType::Number->value, 'value' => '19.6'],
                    ['name' => 'HP', 'type' => FieldType::Number->value, 'value' => '6'],
                ]
            ],
        ];

        foreach ($pokemonData as $data) {
            $pokemon = new Pokemon($data['name']);
            $pokemon->createPokemon();

            foreach ($data['fields'] as $field) {
                $pokemon->addField($field);
            }
        }
    }
}
