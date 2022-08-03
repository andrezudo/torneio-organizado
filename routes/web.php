<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\ChampionshipController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StatisticController;

Route::get('/home', function(){
    return view('welcome');
});

/*Route::get('/', function(){
    return view('home');
});*/

Route::get('/', [ChampionshipController::class, 'ultimosCampeonatos']);

/*Route::get('/campeonatos', function(){
    return view('campeonatos');
});*/



Route::prefix('/app')->group(function(){
    Route::delete('/championship/{id}', [ChampionshipController::class, 'destroy']);
    Route::put('/update/{id}', [ChampionshipController::class, 'update'])->middleware('auth');
    Route::post('/championship', [ChampionshipController::class, 'store']);
    Route::get('/campeonatos', [ChampionshipController::class, 'campeonatos'])->middleware('auth');
    Route::get('/painel/{id}', [ChampionshipController::class, 'painel'])->middleware('auth');
    Route::get('/iniciar-campeonato/{id}', [ChampionshipController::class, 'iniciar'])->middleware('auth');
    
    //Route::get('/teams', [TeamController::class, 'index'])->middleware('auth');
    Route::get('/teams/{id}', [TeamController::class, 'teams'])->middleware('auth')->name('teams');
    Route::post('/team', [TeamController::class, 'store']);
    Route::delete('/team/{id}', [TeamController::class, 'destroy']);
    Route::put('/update-team/{id}', [TeamController::class, 'update'])->middleware('auth');

    /*Route::get('/players/{id}', function(){
        return view('app.players');
    })->middleware('auth');*/
    Route::get('/players/{id}', [PlayerController::class, 'players'])->middleware('auth')->name('players');
    Route::put('/update-player/{id}', [PlayerController::class, 'update'])->middleware('auth');
    Route::delete('/delete-player/{id}', [PlayerController::class, 'destroy'])->middleware('auth');
    Route::post('/player', [PlayerController::class, 'store'])->middleware('auth');

    Route::get('/gerar-jogos', [GameController::class, 'gerarJogos'])->middleware('auth');
    Route::get('/games/{id}', [GameController::class, 'games'])->middleware('auth')->name('games');
    Route::post('/game', [GameController::class, 'store'])->middleware('auth');

    Route::post('/result', [ResultController::class, 'store'])->middleware('auth');
    Route::put('/update-result/{id}', [ResultController::class, 'update'])->middleware('auth');

    Route::get('/tabela/{id}', [TableController::class, 'tabela'])->middleware('auth')->name('tabela');

    Route::get('/statistics/{id}', [StatisticController::class, 'statistics'])->middleware('auth')->name('statistics');

    Route::get('/tabela', function(){
        return view('app.tabela');
    })->middleware('auth');
    
    Route::get('/jogos', function(){
        return view('app.jogos');
    })->middleware('auth');
    
    Route::get('/rankings', function(){
        return view('app.rankings');
    })->middleware('auth');
});

Route::prefix('/site')->group(function(){

    Route::get('/campeonato/{id}', [ChampionshipController::class, 'campeonato']);
});



/*Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('home');
})->name('home');*/

//Route::middleware(['auth:sanctum', 'verified'])->get('/campeonatos', [ChampionshipController::class, 'campeonatos']);

/*Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');*/