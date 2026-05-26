<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

// Rota vinculada ao método index do seu controlador
Route::get('/produtos', [ProdutoController::class, 'index']);