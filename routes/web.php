<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Pages\HomepageController;
use App\Http\Controllers\Pages\QuoteController;
use App\Http\Controllers\Pages\ResultsQuoteController;

Route::get('/', [HomepageController::class, 'index'])->name('page-home');
Route::get('/sale-now-on', [HomepageController::class, 'alt'])->name('page-home-alt');
Route::get('/quote', [QuoteController::class, 'index'])->name('page-quote');
Route::get('/quote/results', [ResultsQuoteController::class, 'index'])->name('page-quotes-index');

