
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;

Route::get('/produtos', [Controller::class, 'index']);