<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DiceController;
use App\Http\Controllers\Game21Controller;
use App\Http\Controllers\Game21ComputerController;
use App\Http\Controllers\YatzyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WelcomeController::class, 'view']);

Route::controller(DiceController::class)->group(function () {
    Route::get('/dice', 'view');
    Route::post('/dice/process', 'process');
});

Route::controller(Game21Controller::class)->group(function () {
    Route::get('/game21', 'view');
    Route::get('/game21/destroy', 'destroy');
    Route::post('/game21/process', 'process');
});

Route::controller(Game21ComputerController::class)->group(function () {
    Route::get('/game21computer', 'view');
    Route::get('/game21computer/destroy', 'destroy');
    Route::get('/game21computer/newround', 'newround');
    Route::post('/game21computer/process', 'process');
});

Route::controller(YatzyController::class)->group(function () {
    Route::get('/yatzy', 'view');
    Route::get('/yatzy/destroy', 'destroy');
    Route::post('/yatzy/process', 'process');
});
