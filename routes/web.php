<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('send-email',[EmailController::class,'sendEmail']);
Route::get('contact',[EmailController::class,'contact']);
Route::post('sendContactEmail',[EmailController::class,'sendContactEmail'])->name('contact');