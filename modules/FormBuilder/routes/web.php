<?php

use Modules\FormBuilder\Controllers\FormBuilderController;

Route::get('/FormBuilder/js/{path}', [FormBuilderController::class, 'loadJS'])->where('path', '.*');
Route::get('/FormBuilder/css/{path}', [FormBuilderController::class, 'loadCSS'])->where('path', '.*');
