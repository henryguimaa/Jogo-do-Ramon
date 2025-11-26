<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\GameController;

/*
|--------------------------------------------------------------------------
| Rotas principais do jogo
|--------------------------------------------------------------------------
*/

Route::get('/', [GameController::class, 'home'])->name('game.home');
Route::get('/home', [GameController::class, 'home'])->name('home');

// Fluxo básico do jogo
Route::get('/game/selection', [GameController::class, 'selection'])->name('game.selection');
Route::get('/game/customize', [GameController::class, 'customize'])->name('game.customize');

/*
|--------------------------------------------------------------------------
| Story e Map (Opção 1 — Recebem ID do personagem)
|--------------------------------------------------------------------------
|
| Agora o jogo sabe qual personagem está jogando.
| Exemplo: /game/story/5 → história do personagem ID 5
|
*/

Route::get('/game/story/{id}', [GameController::class, 'story'])->name('game.story');
Route::get('/game/map/{id}', [GameController::class, 'map'])->name('game.map');
Route::get('/game/map/{id}/{area}', [GameController::class, 'enterArea'])->name('game.area');
Route::get('/game/{id}/area/{area}', [GameController::class, 'enterArea'])->name('game.area');



/*
|--------------------------------------------------------------------------
| CRUD de Personagens + Sistema de Batalha
|--------------------------------------------------------------------------
*/

Route::resource('characters', CharacterController::class);

Route::post('characters/{id}/battle', [CharacterController::class, 'battle'])
    ->name('characters.battle');

/*
|--------------------------------------------------------------------------
| Setup (executar migrations pelo navegador)
|--------------------------------------------------------------------------
*/

Route::get('/setup/migrate', [GameController::class, 'runMigrations'])
    ->name('setup.migrate');



    