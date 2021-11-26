<?php

use Illuminate\Support\Facades\Route;

Route::get('articles/{article}',[\App\Http\Controllers\ArticleController::class,'show']);
