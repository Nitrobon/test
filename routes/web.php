<?php

use Illuminate\Support\Facades\Route;

Route::get('/create', [\App\Http\Controllers\PokemonController::class, 'create'])->name('pokemons.create');
Route::get('/', [\App\Http\Controllers\PokemonController::class, 'index'])->name('pokemons.index');
Route::get('/show/{id}', [\App\Http\Controllers\PokemonController::class, 'show'])->name('pokemons.show');
Route::post('/create/store', [\App\Http\Controllers\PokemonController::class, 'store'])->name('pokemon.store');
