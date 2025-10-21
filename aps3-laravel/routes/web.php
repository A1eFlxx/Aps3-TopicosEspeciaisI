<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rota inicial (opcional, pode manter a default ou apontar para a de produtos)
Route::get('/', function () {
    return redirect('/produtos');
});

// Rotas para PRODUTOS
// GET /produtos -> exibe formulário e lista
Route::get('/produtos', [ProdutoController::class, 'index']);
// POST /produtos -> processa o formulário e salva no banco
Route::post('/produtos', [ProdutoController::class, 'store']);

// Rotas para CATEGORIAS
// GET /categorias -> exibe formulário e lista
Route::get('/categorias', [CategoriaController::class, 'index']);
// POST /categorias -> processa o formulário e salva no banco
Route::post('/categorias', [CategoriaController::class, 'store']);