<?php

use App\Http\Controllers\BattleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->post('battle-strategy', [BattleController::class, 'simulate']);
