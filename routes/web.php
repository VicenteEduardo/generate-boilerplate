<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Http\Controllers\SqlUploadController;


Route::get('', [SqlUploadController::class, 'index'])->name('sql.upload');
Route::post('/upload-sql', [SqlUploadController::class, 'process'])->name('sql.process');


Route::resource('configurations', App\Http\Controllers\ConfigurationsController::class);

Route::resource('contacts', App\Http\Controllers\ContactsController::class);

Route::resource('news', App\Http\Controllers\NewsController::class);

Route::resource('services', App\Http\Controllers\ServicesController::class);

Route::resource('slideshows', App\Http\Controllers\SlideshowsController::class);

Route::resource('users', App\Http\Controllers\UsersController::class);
