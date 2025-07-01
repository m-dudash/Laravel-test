<?php

use App\Http\Controllers\Api\FilmController;
use Illuminate\Support\Facades\Route;

Route::get('films', [FilmController::class, 'index']);
Route::get('films/{id}', [FilmController::class, 'show']);
Route::post('films', [FilmController::class, 'store']);
Route::put('films/{id}', [FilmController::class, 'update']);
Route::delete('films/{id}', [FilmController::class, 'destroy']);
Route::post('films/{id}/publish', [FilmController::class, 'publish']);
Route::get('genres', [FilmController::class, 'genres']);
Route::get('genres/{id}', [FilmController::class, 'filmsByGenre']);
