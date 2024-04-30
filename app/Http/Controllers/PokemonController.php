<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    /**
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     *
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $perPage = 10;
        $pokemons = Pokemon::getPokemonPage(request('page'), $perPage);

        return view('index', compact('pokemons'));
    }
    /**
     * Форма создания покемона
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('create');
    }

    /**
     * Создание покемона
     *
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'pokemon_name' => ['required','string']
        ]);

        $pokemon = new Pokemon($request->input('pokemon_name'));

        $pokemon->createPokemon();

        $fields = $request->input('fields', []);

        foreach ($fields as $key => $fieldData) {
            $pokemon->addField([
                'name' => $key,
                'type' => $fieldData['type'],
                'value' => $fieldData['value'],
                'format' => $fieldData['format'] ?? null
            ]);
        }

        return redirect()->route('pokemon.create')->with('status', 'Покемон создан успешно!');
    }
    public function show($id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $pokemon = Pokemon::getPokemonById($id);

        if (!$pokemon) {
            abort(404);
        }

        return view('show', compact('pokemon'));
    }
}
