<?php


use App\Http\Controllers\Pages\LegalController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Pages\HomepageController;
use App\Http\Controllers\Pages\QuoteController;
use App\Http\Controllers\Pages\ResultsQuoteController;
use App\Http\Controllers\Pages\InlineFormController;

Route::get('/', [HomepageController::class, 'index'])->name('page-home');
Route::get('/sale-now-on', [HomepageController::class, 'alt'])->name('page-home-alt');
Route::get('/quote', [QuoteController::class, 'index'])->name('page-quote');
Route::get('/quote/results', [ResultsQuoteController::class, 'index'])->name('page-quotes-index');
Route::post('/thank-you', [InlineFormController::class, 'index'])->name('thank-you');
Route::get('/cookie-policy', [LegalController::class, 'cookiePolicy'])->name('page-cookie-policy');
Route::get('/privacy-policy', [LegalController::class, 'privacyPolicy'])->name('page-privacy-policy');
Route::get('/terms-and-conditions', [LegalController::class, 'termsAndConditions'])->name('page-terms-and-conditions');
