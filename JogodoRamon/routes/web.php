<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\GameController;

Route::get('/', [GameController::class, 'home'])->name('game.home');
// nova rota para /home (resolve 404 ao acessar /home)
Route::get('/home', [GameController::class, 'home'])->name('home');
Route::get('/game/selection', [GameController::class, 'selection'])->name('game.selection');
Route::get('/game/customize', [GameController::class, 'customize'])->name('game.customize');
Route::get('/game/story', [GameController::class, 'story'])->name('game.story');
Route::get('/game/map', [GameController::class, 'map'])->name('game.map');

Route::resource('characters', CharacterController::class);
// assign passive and battle endpoints
Route::post('characters/{id}/assign-passive', [CharacterController::class, 'assignPassive'])->name('characters.assignPassive');
Route::post('characters/{id}/battle', [CharacterController::class, 'battle'])->name('characters.battle');

// Rota temporária para rodar migrations + seed via navegador.
// IMPORTANTE: remova ou proteja esta rota quando terminar.
// Acesse: /setup/migrate?key=SECRET_KEY
Route::get('/setup/migrate', [App\Http\Controllers\GameController::class, 'runMigrations'])->name('setup.migrate');
