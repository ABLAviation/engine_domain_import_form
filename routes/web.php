<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/{user}', [App\Http\Controllers\Controller::class, 'signIn']);

Route::middleware('auth')->group( function(){
    Route::get('/', [App\Http\Controllers\Controller::class, 'index']);
    Route::post('/api/import', [App\Http\Controllers\Controller::class, 'import'])->name('file-import');
});

Route::redirect('/login', 'https://52.149.125.127')->name('login');


