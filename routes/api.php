<?php

use App\Http\Controllers\NpsAccountsController;
use App\Http\Controllers\NpsController;
use Illuminate\Support\Facades\Route;


Route::get('nps', NpsController::class);

Route::get('nps/accounts', NpsAccountsController::class);
