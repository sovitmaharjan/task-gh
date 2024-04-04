<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientController;


Route::get('/', [ClientController::class, 'index']);
Route::apiResource('client', ClientController::class)->only(['index', 'store']);
